<?php

if (!function_exists('upload_file')) {
    function upload_file($file,$type) {
        $file_name=$file->getClientOriginalName();
        $directory=$type.'/'. date('Y-m-d');
        $file->storeAs($directory,$file_name,'public_path');
        return 'uploads/'.$directory.'/'.$file_name;
    }
}
if (!function_exists('create_log')) {
    function create_log($operation,$user_id,$model,$message=null) {
        \App\Models\Logs::create([
           'operation' => $operation,
           'user_id' => $user_id,
           'model' => $model,
           'message' => $message,
        ]);
    }
}
