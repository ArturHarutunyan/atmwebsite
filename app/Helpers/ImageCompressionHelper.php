<?php

if (!function_exists('resize_image')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function  resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        switch (exif_imagetype($file)) {
            case IMAGETYPE_PNG:
                $imageTmp=imagecreatefrompng($file);
                break;
            case IMAGETYPE_JPEG:
                $imageTmp=imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_GIF:
                $imageTmp=imagecreatefromgif($file);
                break;
            /*case IMAGETYPE_BMP:
                $imageTmp=imagecreatefrombmp($file);
                break;*/
            // Defaults to PNG
            default:
                $imageTmp=imagecreatefrompng($file);
                break;
        }
        if ($w>$width && $h>$height) {
            return $imageTmp;
        }
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $imageTmp, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        return $dst;
    }
}
