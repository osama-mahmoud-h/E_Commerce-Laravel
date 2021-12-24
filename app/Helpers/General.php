<?php

function uploadImg($folder,$img){
    $img->store('/',$folder);
    $fileName=$img->hashName();
    $path='imgs/'.$folder .'/'.$fileName;
    return $path;
  }