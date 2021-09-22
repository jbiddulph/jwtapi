<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function handleUploads(Request $request)
    {
        $pathToFile = $request->file('image')->store('images/venues', 'public');
        
        return $pathToFile;
    }
}
