<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempImage;
use Image;


class TempImageController extends Controller
{
    public function create(Request $request)
    {
        $image = $request->file('image'); // Use file() method to get the uploaded file
        if (!empty($image)) {
            $ext = $image->getClientOriginalExtension(); // Corrected method name
            $newName = time() . '.' . $ext;

            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            $image->move(public_path('temp'), $newName); // Corrected folder path
            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'message' => 'Image uploaded successfully!',
            ]);

            //Generate Thumbnail //
            $sourcePath=public_path().'/temp/'. $newName;
            $destPath=public_path().'/temp/thumb/'. $newName;
            $image=Image::make($sourcePath);
            $image->fit(300,275);
            $image->save($destPath);

            return response()->json([
                'status' => true,
                'message' => 'Successfully image uploaded!',
                'image_id'=>$tempImage->id,
                'imagePath'=>asset('/temp/thumb/'.$newName),
            ]);
        }
        
        else
         {
            return response()->json([
                'status' => false,
                'message' => 'No image uploaded!',
            ]);
        }
    }
}
