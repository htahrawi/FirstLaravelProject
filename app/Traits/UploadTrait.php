<?php 
namespace App\Traits;

Trait UploadTrait 
{
    protected function saveImage($folder,$word,$image){
        $ex = $image->getClientOriginalExtension();
        $image_name = $word.'-'.time().'.'.$ex;
        $path = 'images/'.$folder;
        $image->move($path,$image_name);
        return $image_name;
    }
}
