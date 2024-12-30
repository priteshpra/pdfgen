<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCAsRequest;
use App\Http\Requests\UpdateCAsRequest;
use App\Models\Role;
use App\Models\CAs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScanDocRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserPhotoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Notification;
use App\Models\OtherDocument;
use App\Models\State;
use App\Models\User;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use setasign\Fpdi\Fpdi;
use App\Services\FcmNotificationService;

class OtherdocumentController extends Controller
{
    protected $fcmNotificationService;
    public function __construct(FcmNotificationService $fcmNotificationService)
    {
        $this->fcmNotificationService = $fcmNotificationService;
    }

    public function create(Request $request)
    {
        $userId = $request->query('userId');
        $company = User::where('id', $userId)->first();
        $CompanyID = $company->CompanyID;
        $BatchNo = Company::where('CompanyID', $CompanyID)->first()->BatchNo;
        $referer = $request->headers->get('referer');
        $lastSegment = $referer;

        abort_if(Gate::denies('cas_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $country = Country::all();
        $city = City::all();
        $state = State::all();
        $roles = Role::pluck('title', 'id');
        return view('admin.otherdoc.create', compact('roles', 'city', 'state', 'country', 'lastSegment', 'userId', 'CompanyID', 'BatchNo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Title' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,svg|max:5048',
        ]);

        $admin = new OtherDocument();

        $imagePaths = [];
        if ($request->hasFile('images')) {
            $imageCount = count($request->file('images'));
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Generate PDF
        $pdf = PDF::loadView('pdf.images', compact('imagePaths'));
        // dd($pdf);
        // Download the PDF
        $CompanyData = Company::find($request->CompanyID);
        $UsersData = User::where('CompanyID', $request->CompanyID)->first();
        $pdfsPath = str_replace(' ', '_', $CompanyData->FirmName) . '_' . $CompanyData->ClientCode;
        // return $pdf->download('images.pdf');
        $directory = 'public/' . $pdfsPath . '/' . $request->UserID;
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
        $dateBatch = date('dmYHis') . '_' . $request->BatchNo;
        $pdfPath = $pdfsPath . '/' . $request->UserID . '/' . $dateBatch . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        $localPath = storage_path("app/public/{$pdfPath}");
        $fpdi = new Fpdi();
        $pageCount = $fpdi->setSourceFile($localPath);
        // Provide download link
        $downloadUrl = route('download.file', ['user_id' => $request->UserID, 'filename' => basename($pdfPath)]);

        $admin->Title = $request->Title;
        $admin->BatchNo = $dateBatch;
        $admin->CompanyID = $request->CompanyID;
        $admin->UserID = $request->UserID;
        $admin->PageCount = $pageCount;
        $admin->Remarks = $request->Remarks;
        $admin->DocumentURL =  basename($pdfPath);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('clients'), $imageName); // Save to 'public/uploads'
            $admin->image = $imageName;
        }
        $admin->save();

        $notifiArray = ['UserID' => $request->UserID, 'Description' => $UsersData->FirstName . ' ' . $UsersData->LastName  . ' has uploaded ' . basename($pdfPath) . ' document on ' . date('d/m/Y h:i:s') . ' and approx ' . $imageCount . ' Images.', 'TypeID' => 0];
        $this->addNotificationData($notifiArray);

        // Notification firebase
        $newData  = json_encode(array('documentLink' => $downloadUrl));
        $body = array('receiver_id' => $request->UserID, 'title' => 'Your document has been uploaded successfully!', 'message' => 'Your document ' . basename($pdfPath) . ' uploaded successfully!', 'data' => $newData, 'content_available' => true);
        $sendNotification = $this->fcmNotificationService->sendFcmNotification($body);
        // $notifData = json_decode($sendNotification->getContent(), true);
        // if (isset($notifData['status']) && $notifData['status'] == true) {
        //     return $sendNotification->getContent();
        // } else {
        //     return $sendNotification->getContent();
        // }
        // End Notification firebase

        if ($request->lastSegment) {
            return redirect($request->lastSegment)->with(['status-success' => "New Document Added."]);
        } else {
            $lastBackUrl = 'admin.cas.index';
        }
        return redirect()->route($lastBackUrl)->with(['status-success' => "New Document Added."]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CAs $user)
    {
        abort_if(Gate::denies('cas_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user->delete();
        return redirect()->back()->with(['status-success' => "User Deleted"]);
    }

    /**
     * add notification Table.
     */
    public function addNotificationData($request)
    {

        try {
            $notification = new Notification();
            // add notification details
            $notification->UserID = $request['UserID'];
            $notification->Description = $request['Description'];
            $notification->TypeID = $request['TypeID'];
            $notification->save();

            // Return a response
            return response()->json(['status' => true, 'message' => 'CAS created successfully', 'data' => []], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }
}
