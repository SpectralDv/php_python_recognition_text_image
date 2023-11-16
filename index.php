

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
        //echo "Загрузка файла на сервер не удалась";
        echo "Error download file in server";
        die(); //or throw exception...
    }

    //Проверка что это картинка
    if (!getimagesize($_FILES["filename"]["tmp_name"]))
    {
        //echo "Это не картинка...";
        echo "It's not image";
        die(); //or throw exception...
    }

    // $unicFile = "unic.txt";
    // $strunic = file_get_contents($unicFile);
    // $unic = (int)$strunic + 1;
    // file_put_contents($unicFile, (string)$unic);

    //уникальный идентификатор подмешивается в имя файла
    $nameFile = date("Y-m-d-H-i-s") . $_FILES['filename']['name'];
    $nameDirFile = 'uploads/' . $nameFile;

    if (move_uploaded_file($_FILES['filename']['tmp_name'], $nameDirFile))
    {
        //echo "Файл корректен и был успешно загружен.\n";
        echo "File correct and success download" ;

        //активирует обработку изображения
        $stateReadText = true;
    }
    else
    {
        //echo "Возможная атака с помощью файловой загрузки!\n";
        echo "Attack file download " . $_FILES['filename']['tmp_name'] . " " . $nameDirFile;
    }
    
    //проверяет папку с txt файлом
    $nameDirText = "text";
    $nameDirFileText = $nameDirText."/".$nameFile . ".txt";
    while($stateReadText)
    {
        //проверка папки
        if(!is_dir($nameDirText))
        {
            //mkdir($nameDirText, 0777, true);
            //выходит из цикла если папки нет
            break;
        }

        //проверка файла
        if(file_exists($nameDirFileText))
        {
            //читает файл, выводит
            echo "<br>"."<img src = " . $nameDirFile . " width=300 height=300/>"."<br>";
            echo "<iframe src=" . $nameDirFileText . "></iframe>";
            //удаляет картинку и файл с текстом
            //unlink($nameDirFile); 
            //unlink($nameDirFileText); 
            
            //выходит из цикла
            break;
        }
        else
        {
            //ждет пока файл будет создан
        }
    }

?>

</body>
</html>