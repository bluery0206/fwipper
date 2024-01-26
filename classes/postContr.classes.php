<?php

class PostContr extends Post {
    private $file;
    private $caption;
    private $userId;

    public function __construct($caption, $file, $userId) {
        $this->caption = $caption;
        $this->file = $file;
        $this->userId = $userId;
    }

    public function post(){
        $fileFullPath = null;

        if ($this->emptyCaption() && $this->emptyFile()) {
            header("location: ../subpages/home.php?emptyInputs=There's nothing to post.");
            exit();
        }

        if (!$this->emptyFile()) {
            if (!$this->verifyFile()) {
                header("location: ../subpages/home.php?verifyFile=There was an error moving the file. The post cannot published.");
                exit();
            }

            $fileFullPath = $this->fileFullPath();
        }

        if ($this->captionAboveCharacterLimit()) {
            header("location: ../subpages/home.php?captionAboveCharacterLimit=Caption has exceeded the 100 characters limit.");
            exit();
        }

        $this->insertPost($this->caption, $fileFullPath, $this->userId);
    }

    public function verifyFile() {
        $check  = true;
        $err    = "";

        if($this->fileAboveSizeLimit()) {
            $check  = false;
            $err   .= "fileAboveSizeLimit=File size too big.";
        }

        if ($this->invalidFileTypes()) {
            $check  = false;
            $err .= "Invalid file type.";
        }

        if($check == true) {
            if ($this->relocateFile()) {
                return true;
            } 
        } 
        else {
            header("location: ../subpages/home.php?" . $err);
            exit();
        }
    }

    private function emptyFile() {
        if (empty($this->file['name'])) {
            return true;
        } 
        else {
            return false;
        }
    }

    private function emptyCaption() {
        if (empty($this->caption)) {
            return true;
        } 
        else {
            return false;
        }
    }

    private function captionAboveCharacterLimit() {
        if(strlen($this->caption) > 100) {
            return true;
        }
        else {
            return false;
        }
    }

    private function fileAboveSizeLimit() {
        if($this->file['size'] > 5000000) {
            return true;
        }
        else {
            return false;
        }
    }

    private function fileFullPath() {
        $fileInfo       = explode(".", basename($this->file['name']));
        $fileExtension  = strtolower(end($fileInfo));
        $fileDir        = $this->getFolder($this->userId)->folder;
        $fileNewName    = "UPLOAD" . $this->userId . date("YmdHis") . "." . $fileExtension;
        $fileFullPath   = htmlspecialchars($fileDir . $fileNewName);

        return $fileFullPath;
    }

    private function invalidFileTypes() {
        $fileInfo = explode(".", $this->file['name']);
        $fileExtension = strtolower(end($fileInfo));

        $unallowed = ["py", "c", "php", "js", "sql"];

        if (in_array($fileExtension, $unallowed)) {
            return true;
        }
        else {
            return false;
        }
    }

    private function relocateFile() {
        if(move_uploaded_file($this->file['tmp_name'], $this->fileFullPath())) {
            return true;
        }
        else {
            return false;
        }
    }

    public function deletePost($postId) {
        $filePath = $this->getFile($postId, $this->userId);

        if (!empty($filePath)) {
            if (file_exists($filePath)) {
                if (!unlink($filePath)) {
                    header("location: ../subpages/profile.php?profile&errDelete=There was an error deleting the post");
                    exit();
                }
            }
        }


        if (!$this->removePost($postId, $this->userId)) {
            header("location: ../subpages/profile.php?profile&tweets&errDelete=There was an error deleting the post");
            exit();
        }
    }
}