
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php</title>
    <style>
      body{
          background-color: #212121;
      }
    </style>
</head>

<body>

<?php

    //var_dump($_FILES);

    if(!is_uploaded_file($_FILES['filename']['tmp_name']))
    {
        //echo "�������� ����� �� ������ �� �������";
        echo "Error download file in server";
        die(); //or throw exception...
    }

    //�������� ��� ��� ��������
    if (!getimagesize($_FILES["filename"]["tmp_name"]))
    {
        //echo "��� �� ��������...";
        echo "It's not image";
        die(); //or throw exception...
    }

    //$uploaddir = '/var/www/php/uploads/';
    //$uploaddir = __DIR__.'/uploads/';
    //$uploadfile = $uploaddir . basename($_FILES['filename']['name']);
    //$uploadfile = __DIR__.'/uploads/'.$_FILES['filename']['name'];
    //$uploadfile = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$_FILES['filename']['name'];
    $uploadfile = 'uploads/' . $_FILES['filename']['name'];

    if (move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile))
    {
        //echo "���� ��������� � ��� ������� ��������.\n";
        echo "File correct and success download";
    }
    else
    {
        //echo "��������� ����� � ������� �������� ��������!\n";
        echo "Attack file download " . $_FILES['filename']['tmp_name'] . " " . $uploadfile;
        echo "<br><img src = " . $uploadfile . " width=300 height=300/>";
    }

?>


<!-- <?php
    $pathimage = "uploads/" . $_FILES['filename']['name'];
    if($pathimage != null)
    {
        echo "<br><img src = " . $pathimage . " width=300 height=300/>";
    }
?> -->

</body>
</html>

