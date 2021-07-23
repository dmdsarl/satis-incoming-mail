<?php
namespace Satis\Incomingmail\Traits;


trait Attachment
{

    function base64SaveImg($base64_img, $link_store, $add_name = "")
    {
        $extension = explode('/', mime_content_type($base64_img))[1];
        $safeName = $add_name . time() . '.' . $extension;
        $base64_image = $base64_img;
        $data = substr($base64_image, strpos($base64_image, ',') + 1);
        $data = base64_decode($data);
        file_put_contents(public_path("storage") . "/" . $link_store . $safeName, $data);

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
