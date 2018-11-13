<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 13.11.18
 * Time: 2:04
 */

namespace App\Services;


interface ImageServiceInterface
{
    function saveImageAndGetName($imageFile, $path, $entityId);

    function replaceImageAndGetName($imageFile, $path, $entityId, $oldImageToRemove);
}