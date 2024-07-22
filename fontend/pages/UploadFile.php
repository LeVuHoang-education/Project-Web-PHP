<?php
function Uploads($file, $targetDir)
{
    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        echo "File là hình ảnh - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File không phải là hình ảnh.";
        $uploadOk = 0;
    }

    if ($file["size"] > 500000) {
        echo "File quá lớn.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Chỉ chấp nhận file JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
    }

    if($uploadOk == 0){
        echo "Upload không thành công.";
    }

    else {
        if(move_uploaded_file($file["tmp_name"], $targetFile)){
            echo "File ". htmlspecialchars(basename($file["name"])). " đã được upload.";
            return $targetFile ;
        }else {
            echo "Có lỗi xảy ra khi upload file.";
            return false;
        }   
    }
}
