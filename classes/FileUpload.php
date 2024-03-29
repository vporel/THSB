<?php
require_once __DIR__."/FileUploadException.php";
class FileUpload
{

    /**
     * @param string $key
     * @param string $destinationFolder A partir du dossier public
     * @param array $extensions Tableau des extensions acceptées (en minuscule)
     * 
     * @return string "" si l'upload échoue. Sinon, le basename(fileName+extension) du fichier après le téléversement
     */
    public static function upload(string $key, $destinationFolder, $extensions = [])
    {
        if(isset($_FILES[$key]["name"]) && $_FILES[$key]["name"] != ""){ 
            $fileName = $_FILES[$key]["name"];
            $pathinfo = pathinfo($fileName);
            $extension = strtolower($pathinfo["extension"]);
            if(count($extensions) == 0 || in_array($extension, $extensions)){
                $filePath = $destinationFolder."/".$fileName;
                $newFilePath = self::newFilePath($filePath);
                if(!file_exists($destinationFolder))
                    mkdir($destinationFolder, 0777, true);
                if(move_uploaded_file($_FILES[$key]["tmp_name"], $newFilePath)){
                    return pathinfo($newFilePath)["basename"];
                }
            }else{
                throw new FileUploadException(FileUploadException::WRONG_EXTENSION, $extension);
            }
        }else{
            throw new FileUploadException(FileUploadException::FILE_NOT_RECEIVED, $key);
        }
        return "";
    }

    /**
     * Function appelée pour le renommage du fichier si un autre du même nom existe déjà
     */
    private static function newFilePath($filePath){
        if(file_exists($filePath)){
            //On réessaye avec en incrémentant le compteur
            $pathinfo = pathinfo($filePath);
            $parts = explode("--", $pathinfo["filename"]);
            $lastElement = end($parts);
            if((int) $lastElement > 0){
                array_pop($parts);
                $newName = implode("--", $parts)."--".((int) $lastElement+1);
            }else{
                $newName = $pathinfo["filename"]."--2";
            }
            $updatedFilePath = $pathinfo["dirname"]."/".$newName.".".$pathinfo["extension"];
            return self::newFilePath($updatedFilePath);
        }else{
            return $filePath;
        }
    }
}