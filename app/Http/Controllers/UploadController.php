<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload_image_tinymc(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $directory = $request->type.'/'. time();
            $imageName = $image->getClientOriginalName();
            $image->storeAs($directory .'/',$imageName,'public_path');
            $response= asset('/').'uploads/'.$directory.'/'.$imageName;
            return response()->json(['location' => $response]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
