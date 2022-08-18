<?php

if (!empty($_FILES)){
    if (is_uploaded_file($_FILES['myFile']['tmp_name'])) {

        $srcpath = $_FILES['myFile']['tmp_name'];
        $targetPath = "uploads/temp/" . $_FILES['myFile']['name'];

        if (move_uploaded_file($srcpath, $targetPath)){ ?>
            <!-- <img src="<?php echo $targetPath; ?>" width="200" height="200"/> -->
            <a href="<?php echo $targetPath; ?>">First</a>

            <?php
        }
    }
    if (isset($_FILES['myFile2']) && is_uploaded_file($_FILES['myFile2']['tmp_name'])) {

        $srcpath = $_FILES['myFile2']['tmp_name'];
        $targetPath = "uploads/temp/" . $_FILES['myFile2']['name'];

        if (move_uploaded_file($srcpath, $targetPath)){ ?>
            <!-- <img src="<?php echo $targetPath; ?>" width="200" height="200"/> -->
            <a href="<?php echo $targetPath; ?>">Second</a>

            <?php
        }
    }
    if (isset($_FILES['myFile3']) && is_uploaded_file($_FILES['myFile3']['tmp_name'])) {

        $srcpath = $_FILES['myFile3']['tmp_name'];
        $targetPath = "uploads/temp/" . $_FILES['myFile3']['name'];

        if (move_uploaded_file($srcpath, $targetPath)){ ?>
            <!-- <img src="<?php echo $targetPath; ?>" width="200" height="200"/> -->
            <a href="<?php echo $targetPath; ?>">Third</a>

            <?php
        }
    }
}?>