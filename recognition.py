import easyocr
import os
import time


#pip install easyocr
#pip install --force-reinstall -v "Pillow==9.5.0"
#python3 recognition.py


#распознание текста на картинке
def TextRecognition(nameDirFileImage,nameDirFileText):
    reader = easyocr.Reader(["ru","en"],gpu=False)
    result = reader.readtext(nameDirFileImage,detail=0,paragraph=True)

    print(nameDirFileImage+" "+nameDirFileText)

    with open(nameDirFileText,"w") as file:
        for line in result:
            file.write(f"{line}\n\n")

    #return result
    return f"\n {nameDirFileText}"


#поиска картинок в папке
def UpdateDir():

    try:

        #список уже обработанных файлов
        listHandleFile = list()

        nameDirImage = "uploads"
        nameDirText = "text"
        
        while(True):
            time.sleep(0.2)

            #проверяет папку с картинками и берет любую на распознание текста
            for nameFile in os.listdir(nameDirImage):
                if nameFile[nameFile.rfind(".") + 1:] in ['jpg', 'jpeg', 'png']:

                    #состояние разрешает обработать файл
                    stateHandle = True

                    #проверяет список обработанных файлов
                    for nameHandleFile in listHandleFile:
                        #если среди обработанных файлов есть выбранный
                        if nameHandleFile == nameFile:
                            #запрещает обработку выбранного файла
                            stateHandle = False

                    #если есть разрешение на обработку файла
                    if(stateHandle == True):
                        TextRecognition(nameDirImage+"/"+nameFile,nameDirText+"/"+nameFile+".txt")
                        #записывать имя файла в список уже обработанных файлов
                        listHandleFile.insert(len(listHandleFile),nameFile)
                        print(listHandleFile)
                        #очищает папки и список 
                        CleanFile(listHandleFile,nameDirImage,nameDirText)
    except Exception:
        print("except" + Exception)


def CleanFile(listHandleFile,nameDirImage,nameDirText):
    if(len(listHandleFile)>9):
        # for nameHandleFile in listHandleFile:
        #     os.remove(nameDirImage+"/"+nameHandleFile)
        #     os.remove(nameDirText+"/"+nameHandleFile+".txt")
        listHandleFile.clear()
        for file in os.listdir(nameDirImage):
            os.remove(os.path.join(nameDirImage,file))
        for file in os.listdir(nameDirText):
            os.remove(os.path.join(nameDirText,file))


def main():
    UpdateDir()

if __name__ == "__main__":
    main()

