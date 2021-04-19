<?php

use Illuminate\Support\Str;

if (!function_exists("uploadImageBase64")) {
    /**
     *  @param $object ["imageDataBase","imageRequest","path"]
     *  @param $extension
     *  @copyright chú ý hàm sẽ xóa ảnh đưa vào database và tạo ảnh mới
     * 
     */
    function uploadImageBase64($object, $extension = "jpg")
    {
        if (is_file("public/{$object["imageDatabase"]}")) {
            unlink("public/{$object["imageDatabase"]}");
        }
        $dataImage = explode(",", $object["imageRequest"]);
        $file = $object["path"] . "/" . time() . "_" . Str::slug($object["imageName"]) . "." . $extension;
        file_put_contents("public/" . $file, base64_decode($dataImage[1]));
        return $file;
    }
}

if (!function_exists("assetFtp")) {
    function assetFtp($project, $url)
    {
        return env("DOMAIN_FTP") . "/" . $project . "/" . $url;
    }
}
