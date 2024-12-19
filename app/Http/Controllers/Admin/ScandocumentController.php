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
use App\Models\Scandocument;
use App\Models\State;
use App\Models\User;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use setasign\Fpdi\Fpdi;

class ScandocumentController extends Controller
{

    public function create(Request $request)
    {
        $userId = $request->query('userId');
        $company = User::where('id', $userId)->first();
        $CompanyID = $company->CompanyID;
        $BatchNo = Company::where('COmpanyID', $CompanyID)->first()->BatchNo;
        $referer = $request->headers->get('referer');
        $lastSegment = $referer;
        abort_if(Gate::denies('cas_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $country = Country::all();
        $city = City::all();
        $state = State::all();
        $roles = Role::pluck('title', 'id');
        return view('admin.scandoc.create', compact('roles', 'city', 'state', 'country', 'lastSegment', 'userId', 'CompanyID', 'BatchNo'));
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

        $admin = new Scandocument();

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
        $pdfsPath = str_replace(' ', '_', $CompanyData->FirmName) . '_' . $CompanyData->ClientCode;
        // return $pdf->download('images.pdf');
        $directory = 'public/' . $pdfsPath . '/' . $request->UserID;
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
        $pdfPath = $pdfsPath . '/' . $request->UserID . '/' . date('dmYHis') . '_' . $request->BatchNo . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        $localPath = storage_path("app/public/{$pdfPath}");
        $fpdi = new Fpdi();
        $pageCount = $fpdi->setSourceFile($localPath);
        // Provide download link
        $downloadUrl = route('download.file', ['user_id' => $request->UserID, 'filename' => basename($pdfPath)]);

        $admin->Title = $request->Title;
        $admin->BatchNo = date('dmYHis') . '_' . $request->UserID;
        $admin->CompanyID = $request->CompanyID;
        $admin->UserID = $request->UserID;
        $admin->PageCount = $pageCount;
        $admin->Remarks = $request->Remarks;
        $admin->DocumentURL = $downloadUrl;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('clients'), $imageName); // Save to 'public/uploads'
            $admin->image = $imageName;
        }
        $admin->save();

        if ($request->lastSegment) {
            return redirect($request->lastSegment)->with(['status-success' => "New Scan Document Added."]);
        } else {
            $lastBackUrl = 'admin.cas.index';
        }
        return redirect()->route($lastBackUrl)->with(['status-success' => "New Scan Document Added."]);
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
}
