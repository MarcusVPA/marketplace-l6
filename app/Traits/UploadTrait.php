<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait UploadTrait {

    private function imageUpload($images, $imageColumn = null) // Request $request
    {
        //$images = $request->file('photos');
        $uploadedImages = [];
        if(is_array($images)) { // if(!is_null($imageColumn)) {
            foreach($images as $image){
                $uploadedImages[] = [$imageColumn=>$image->store('products','public')];
            }
        } else {
            $uploadedImages = $images->store('logo','public');
        }
        /*foreach($images as $image){
            if(!is_null($imageColumn)) {
                $uploadedImages[] = [$imageColumn=>$image->store('products','public')];
            } else {
                $uploadedImages = $image;
            }
        }*/
        return $uploadedImages;
    }
}