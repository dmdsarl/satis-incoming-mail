<?php
namespace Satis\Incomingmail\Traits;


use Illuminate\Support\Facades\File;

trait Attachment
{

    function base64SaveImg($base64_img, $link_store, $add_name = "")
    {
        $extension = explode('/', mime_content_type($base64_img))[1];
        $safeName = $add_name . time() . '.' . $extension;
        $base64_image = $base64_img;
        $data = substr($base64_image, strpos($base64_image, ',') + 1);
        $data = base64_decode($data);
        $path = public_path("storage") . "/" . $link_store;
        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        file_put_contents($path . $safeName, $data);

        return ["ext" => $extension, "link" =>  "/storage/" . $link_store . $safeName];
    }

    function jsonImageLink($image_link)
    {
        $link = $image_link;
        $pos_point = strrpos( $link,".");
        $cropped = substr($link, 0, $pos_point)."-cropped". substr($link, $pos_point, strlen($link));
        return json_encode(["original"=>$link,"cropped"=>$cropped]);
    }



}
