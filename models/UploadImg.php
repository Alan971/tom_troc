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
                                        return $imgNameUniq;
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
	    if(@file_exists($file) && $file !=BOOK_IMG_PATH && $file != ICON_USER_PATH) {
	        if(@unlink($file)) {
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
        if($iconName = $this->uploadImage($postImgRub, $path)) {
            // suppression de l'ancien fichier
            if($this->deleteFile($owner->getIcon())) {
                // modif bdd
                if($user->setIcon($idUser, $iconName)) {
                    return "";
                }
            }
            else {
                $this->deleteFile(ICON_USER_PATH . $iconName);
            }
        }
        return "une erreur est survenue";
    }
        /**
     * creation et remplacement de l'image du livre
     * @param string
     * @return bool
     */
    public function setBookImage($postImgRub, $path, $idBook) : string {

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($idBook);
        // chargement de la nouvelle image
        if($imageName = $this->uploadImage($postImgRub, $path)) {
            // suppression de l'ancien fichier
            if($this->deleteFile($book->getImage())) {
                // modif bdd
                if($bookManager->setBookImage($idBook, $imageName)) {
                    return "";
                }
            }
            else {
                $this->deleteFile(BOOK_IMG_PATH . $imageName);
            }
        }
        return "une erreur est survenue";
    }
    
}

