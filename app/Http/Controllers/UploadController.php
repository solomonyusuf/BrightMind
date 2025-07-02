<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController
{
    public static function UploadFile(Request $request)
    {
        $client = $request?->image->getClientOriginalExtension();

        if ($client == 'pdf' || $client == 'doc' || $client == 'jpg' || $client == 'png' || $client == 'jpeg'  || $client == 'avif') {
            $file = asset('uploads/'. uniqid() . time() . '.' . $request->image->getClientOriginalName());
            $request->image->move(public_path('uploads'), $file);

            return $file;
        }
    }
}
