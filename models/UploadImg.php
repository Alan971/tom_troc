<?php
class UploadImg {

    /**
     * téléchargement d'un fichier image l'utilisateur.
     * @param string
     * @param string
     * @return string
     */ 
	public function uploadImage($postImgRub, $path) : ?string {

        $tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
		define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
        define('HEIGHT_MAX', 800);   // Hauteur max de l'image en pixels
        define('MAX_SIZE', 5000000);    // Taille max en octets du fichier
        if(!empty($_POST)) {
            if($_FILES[$postImgRub]['name'] != "" || !empty($_FILES[$postImgRub]) ) {
                if(!empty($_FILES[$postImgRub]['tmp_name'])) {
                    $fileTmp = $_FILES[$postImgRub]['tmp_name']; 
                    $extension = strtolower(pathinfo($_FILES[$postImgRub]['name'], PATHINFO_EXTENSION)); 
                    if(in_array($extension, $tabExt)) {
                        $imgNameUniq = md5(uniqid()) .'.'. $extension;
                        $infosImg = getimagesize($fileTmp);
                        // On verifie le type de l'image
                        if($infosImg[2] >= 1 && $infosImg[2] <= 14) {
                            // On verifie les dimensions et taille de l'image
                            if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES[$postImgRub]['tmp_name']) <= MAX_SIZE)) {
                                // Parcours du tableau d'erreurs
                                if(isset($_FILES[$postImgRub]['error']) && UPLOAD_ERR_OK === $_FILES[$postImgRub]['error']) {
                                    if(move_uploaded_file($fileTmp, $path . $imgNameUniq)) {
                                        return $path . $imgNameUniq;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return false;
	}

    /**
     * suppression l'icon de l'utilisateur.
     * @param string
     * @return bool
     */
	public function deleteFile($file) : bool {
		$fileInfo = "";
	    if(@file_exists($file)) {
	        $fileInfo = pathinfo($file);
	        if(@unlink($file)) {
	            $txt = "Fichier : ".$fileInfo['basename']." effac&eacute; .";
                return true;
	        }
            return false;
	    }
	    return true;
	}

    /**
     * creation et remplacement de l'icon de l'utilisateur.
     * @param string
     * @return bool
     */
    public function setUserIcon($postImgRub, $path, $idUser) : string {

        $user = new UserManager();
        $owner = $user->getUserById($idUser);
        // chargement de la nouvelle image
        if($fullPath = $this->uploadImage($postImgRub, $path)) {
            // suppression de l'ancien fichier
            if($this->deleteFile($owner->getIcon())) {
                // modif bdd
                $user = new UserManager();
                if($user->setIcon($idUser, $fullPath)) {
                    return "";
                }
            }
            else {
                $this->deleteFile($fullPath);
            }
        }
        return "une erreur est survenue";
    }
}

