<?php

if (0 < $_FILES['file']['error']) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
} else {
    $fileName = $_FILES['file']['name'];
    $filetype = $_FILES['file']['type'];
    $fileName = strtolower($fileName);
    $filetype = strtolower($filetype);
    $striped = strip_tags($fileName);

    //check if contain php and kill it
    $pos = str_contains($fileName, 'php');
    if ($pos === true) {
        die('error 1');
    }
    //check double file type (image with comment)
     else if (substr_count($filetype, '/') > 1) {
        die('error 2');
    }
    else if ($fileName != $striped) {
        die('error 3');
    }

    else if (isimage($_FILES['file']["type"]) && $_FILES['file']['size'] < 1000000) {
        if (is_dir("uploads/image/" . explode("/", $_FILES['file']['type'])[1])) {
            if (is_dir("uploads/image/" . explode("/", $_FILES['file']['type'])[1] . "/" . (date('Y-m-d')))) {
            } else {
                mkdir("uploads/image/" . explode("/", $_FILES['file']['type'])[1] . "/" . (date('Y-m-d')));
            }
        } else {
            mkdir("uploads/image/" . explode("/", $_FILES['file']['type'])[1]);
            mkdir("uploads/image/" . explode("/", $_FILES['file']['type'])[1] . "/" . (date('Y-m-d')));
        }
        move_uploaded_file($_FILES['file']['tmp_name'], "uploads/image/" . explode("/", $_FILES['file']['type'])[1] . "/" . (date('Y-m-d')) . "/" . hash("sha256", $_FILES['file']['name']) . strrchr($fileName, '.'));
        //
        $fh = fopen("status.log", "a+");
        fwrite($fh, "uploads/image/" . explode("/", $_FILES['file']['type'])[1] . "/" . (date('Y-m-d')) . "/" . hash("sha256", $_FILES['file']['name']) . strrchr($fileName, '.') . "***" . time() . "\n");
        //
    } else if (explode("/", $_FILES['file']['type'])[0] === "audio" && $_FILES['file']['size'] < 10000000) {
        if (is_dir("uploads/audio/" . explode("/", $_FILES['file']['type'])[1])) {
            if (is_dir("uploads/audio/" . explode("/", $_FILES['file']['type'])[1] . "/" . (date('Y-m-d')))) {
            } else {
                mkdir("uploads/audio/" . explode("/", $_FILES['file']['type'])[1] . "/" . (date('Y-m-d')));
            }
        } else {
            mkdir("uploads/audio/" . explode("/", $_FILES['file']['type'])[1]);
            mkdir("uploads/audio/" . explode("/", $_FILES['file']['type'])[1] . "/" . (date('Y-m-d')));
        }
        move_uploaded_file($_FILES['file']['tmp_name'], "uploads/audio/" . explode("/", $_FILES['file']['type'])[1] . "/" . (date('Y-m-d')) . "/" . hash("sha256", $_FILES['file']['name']) . strrchr($fileName, '.'));
        //
        $fh = fopen("status.log", "a+");
        fwrite($fh, "uploads/audio/" . explode("/", $_FILES['file']['type'])[1] . "/" . (date('Y-m-d')) . "/" . hash("sha256", $_FILES['file']['name']) . strrchr($fileName, '.') . "***" . time() . "\n");
        //
    } else {
        echo "Invalid input";
    }
    checkExpiration();
}

function isimage($tmp_name)
{
    $type = $tmp_name;

    $extensions = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/jfif', 'image/png', 'image/bmp', 'image/dib', 'image/gif');
    if (in_array($type, $extensions)) {
        return true;
    } else {
        return false;
    }
}

function checkExpiration (){
    $pathArr = [];
    $timeArr = [];

    $fh = fopen("status.log", "r");
    while($line = fgets($fh)){
        $line = trim($line);
        if (isset($line[0]) && $line[0] == 'u'){
            $exploded = explode("***", $line);
            $pathArr[] = $exploded[0];
            $timeArr[] = $exploded[1];
        }
    }
    for ($i = 0; $i < count($pathArr); ++$i){
        if (time() - $timeArr[$i] > 84600){
            unlink($pathArr[$i]);
            array_splice($pathArr, $i, 1);
            array_splice($timeArr, $i, 1);
        }
    }
    $fh2 = fopen("status.log", "w");
    for ($i = 0; $i < count($pathArr); ++$i){
        fwrite($fh2, $pathArr[$i]."***".$timeArr[$i]."\n");
    }
}