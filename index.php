

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php</title>
    <style>
      body{
          background-color: #222222;
          color: #888888;
      }
    </style>
</head>

<body>

    <!-- <form action="upload.php" method="post" enctype="multipart/form-data"> -->
    <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="filename" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>

<?php   

    $stateReadText = false;

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

    // $unicFile = "unic.txt";
    // $strunic = file_get_contents($unicFile);
    // $unic = (int)$strunic + 1;
    // file_put_contents($unicFile, (string)$unic);

    //���������� ������������� ������������� � ��� �����
    $nameFile = date("Y-m-d-H-i-s") . $_FILES['filename']['name'];
    $nameDirFile = 'uploads/' . $nameFile;

    if (move_uploaded_file($_FILES['filename']['tmp_name'], $nameDirFile))
    {
        //echo "���� ��������� � ��� ������� ��������.\n";
        echo "File correct and success download" ;

        //���������� ��������� �����������
        $stateReadText = true;
    }
    else
    {
        //echo "��������� ����� � ������� �������� ��������!\n";
        echo "Attack file download " . $_FILES['filename']['tmp_name'] . " " . $nameDirFile;
    }
    
    //��������� ����� � txt ������
    $nameDirText = "text";
    $nameDirFileText = $nameDirText."/".$nameFile . ".txt";
    while($stateReadText)
    {
        //�������� �����
        if(!is_dir($nameDirText))
        {
            //mkdir($nameDirText, 0777, true);
            //������� �� ����� ���� ����� ���
            break;
        }

        //�������� �����
        if(file_exists($nameDirFileText))
        {
            //������ ����, �������
            echo "<br>"."<img src = " . $nameDirFile . " width=300 height=300/>"."<br>";
            echo "<iframe src=" . $nameDirFileText . "></iframe>";
            //������� �������� � ���� � �������
            //unlink($nameDirFile); 
            //unlink($nameDirFileText); 
            
            //������� �� �����
            break;
        }
        else
        {
            //���� ���� ���� ����� ������
        }
    }

?>

</body>
</html>