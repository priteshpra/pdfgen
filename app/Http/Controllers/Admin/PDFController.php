<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use PDF; // Import the facade
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function generatePDF()
    {
        // List of image URLs or paths
        $images = [
            public_path('images/image1.jpg'),
            public_path('images/image2.jpg'),
            public_path('images/image3.jpg'),
        ];

        $pdf = PDF::loadView('pdf.images', compact('images'));

        return $pdf->download('images.pdf'); // This will download the generated PDF
    }

    public function showUploadForm()
    {
        return view('pdf.upload-images');
    }

    public function handleImageUpload(Request $request)
    {
        // Validate the uploaded images
        $request->validate([
            'images.*' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Store the uploaded images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $imagePaths[] = $path;
            }
        }
        // Generate PDF
        $pdf = PDF::loadView('pdf.images', compact('imagePaths'));

        // Download the PDF
        return $pdf->download('images.pdf');
    }

    public function downloadFile($user_id, $filename)
    {
        $path = storage_path("app/public/pdfs/{$user_id}/{$filename}");

        // Check if the file exists
        if (file_exists($path)) {
            // Return the file as a download response
            return response()->download($path);
        } else {
            // If the file doesn't exist, return a 404 response
            abort(404, 'File not found.');
        }
    }
}
