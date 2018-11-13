<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 13.11.18
 * Time: 2:06
 */

namespace App\Services;


use Intervention\Image\Facades\Image;

class InterventionImageService implements ImageServiceInterface
{
    function saveImageAndGetName($imageFile, $path, $entityId)
    {
        if($imageFile) {
            $lastId = $entityId + 1;
            //save image
            $filename = $lastId . '.' . $imageFile->getClientOriginalExtension();
            Image::make($imageFile)->resize(250, 250)->save(public_path('images/uploads/' . $path . '/' . $filename));

            return $filename;
        } else {
            return 'default.jpg';
        }
    }

    function replaceImageAndGetName($newImageFile, $path, $entityId, $oldImageName)
    {
        if (!$newImageFile) {
            return $oldImageName;
        }

        //remove old image
        if ($oldImageName != 'default.jpg') {
            if (file_exists(public_path('/images/uploads/' . $path . '/' . $oldImageName))) {
                unlink(public_path('images/uploads/' . $path . '/' . $oldImageName));
            }
        }

        return $this->saveImageAndGetName($newImageFile, $path, $entityId);
    }
}