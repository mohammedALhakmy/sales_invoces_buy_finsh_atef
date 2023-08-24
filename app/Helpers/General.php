<?php

use Illuminate\Support\Facades\Config;


function upload_image($folder,$image){
    $extention = strtolower($image->extension());
    $fileName = time().rand(100,999).".".$extention;
    $image->getClientOriginalName = $fileName;
    $image->move($folder,$fileName);
    return $fileName;
}
