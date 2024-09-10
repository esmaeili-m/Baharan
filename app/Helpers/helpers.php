<?php

if (!function_exists('upload_file')) {
    function upload_file($file,$type) {
        $file_name=$file->getClientOriginalName();
        $directory=$type.'/'. date('Y-m-d');
        $file->storeAs($directory,$file_name,'public_path');
        return 'uploads/'.$directory.'/'.$file_name;
    }
}
