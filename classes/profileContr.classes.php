  <?php

 class ProfileContr extends Profile {
    public function defaultProfile($name, $bday, $user_id) {
        $cvp = "../media/default/default_cover_picture.png";
        $pfp = "../media/default/default_profile_picture.jpg";

        if (!$folder = $this->createFolder()) {
            header("location: ../subpages/profiles.php?profile&nameError=An error occured.&");
        };

        $this->setProfile($cvp, $pfp, $name, $bday, $folder, $user_id);
    }

    public function updateProfile($cvp, $pfp, $name, $bio, $loc, $web, $showBday, $user_id) {
        $check = true;
        $err = "";

        // pfp error handlers

        $def_pfp = "../media/default/default_profile_picture.jpg";

        $user_def_pfp = $this->fetchDefPfp($user_id);

        if (empty($user_def_pfp)) {
            $user_def_pfp = $def_pfp;
        }
        
        if (!file_exists($user_def_pfp)) {
            $user_def_pfp = $def_pfp;
        }

        if (!empty($pfp['name'])) {
            if ($def_pfp != $user_def_pfp) {
                unlink($user_def_pfp);
            }
            $new_prof_path = $this->uploadImg($pfp, $user_id);
        }
        else {
            $new_prof_path = $user_def_pfp;
        }


        // cvp error handlers

        $def_cvp = "../media/default/default_cover_picture.png";

        $user_def_cvp = $this->fetchDefCvp($user_id);

        if (empty($user_def_cvp)) {
            $user_def_cvp = $def_cvp;
        }
        
        if (!file_exists($user_def_cvp)) {
            $user_def_cvp = $def_cvp;
        }

        if (!empty($cvp['name'])) {
            if ($def_cvp != $user_def_cvp) {
                unlink($user_def_cvp);
            }
            $new_cvp_path = $this->uploadImg($cvp, $user_id);
        }
        else {
            $new_cvp_path = $user_def_cvp;
        }


        if ($this->emptyName($name)) {
            $check = false;
            $err .= "nameError=Please specify your name.&";
        } else if ($this->invalidName($name)) {
            $check = false;
            $err .= "nameError=You can only use characters from a to z and dash(-).&";
        }

        if (!$check) {
            header ("location: ../subpages/profile.php?" . $err);
            exit();
        } else {
            $this->setNewProfile($new_cvp_path, $new_prof_path, $name, $bio, $loc, $web, $this->showBday($showBday), $user_id);
        } 
    }

    private function showBday($showBday) {
        if (empty($showBday)) {
            $showBday = 0;
        }
        
        return $showBday;
    }
    
    private function emptyName($name) {
        $res = false;

        if (empty($name)) {
            $res = true;
        }

        return $res;
    }

    private function invalidName($name) {
        $res = false;

        $pattern = '/^[a-zA-Z- ]+$/';

        if (!preg_match($pattern, $name)) {
            $res = true;
        }

        return $res;
    }
    
    private function uploadImg($img, $user_id) {
        $img_name       = $img['name'];
        $img_type       = $img['type'];
        $img_tmp_name   = $img['tmp_name'];
        $img_error      = $img['error'];
        $img_size       = $img['size'];

        if (empty($img_size)) {
            return "";
        }

        if ($img_error != 0) {
            header("location: ../subpages/profile.php?profile&" . $img_error);
            exit();
        }

        if ($this->invalidImgType($img_type)) {
            header("location: ../subpages/profile.php?profile&nameError=Invalid img type.");
            exit();
        }

        if ($this->invalidImgSize($img_size)) {
            header("location: ../subpages/profile.php?profile&nameError=Image size too big.");
            exit();
        }

        $img_info = explode(".", $img_name);
        $img_extension = strtolower(end($img_info));
        $img_dir = $this->fetchFolder($user_id);
        $img_new_name = "IMG" . $user_id . date("YmdHis"). "." . $img_extension;
        $img_path = $img_dir . $img_new_name;

        if (!move_uploaded_file($img_tmp_name, $img_path)) {
            header("location: ../subpages/profile.php?profile&" . $img_error);
            exit();
        }

        return $img_path;
    }

    private function invalidImgSize($img_size) {
        $res = false;
        
        if ($img_size < 100000) {
            $res = true;
        }

        return $res;    
    }

    private function invalidImgType($img_type) {
        $res = false;

        $allowed = ["image/png", "image/jpg", "image/jpeg"];

        if (!in_array($img_type, $allowed)) {
            $res = true;
        }

        return $res;
    }

    private function createFolder() {
        $folderPath = "../media/" . uniqid("", true) . "/";

        if (file_exists($folderPath)) {
            $folderPath = "..media/" . uniqid("", true) . "/";
        }

        mkdir($folderPath, 0777, true);

        return $folderPath;
    }

    private function fetchFolder($user_id) {
        return $this->getFolder($user_id);
    }

    private function fetchDefPfp($user_id) {
        return $this->getDefPfp($user_id);
    }

    private function fetchDefCvp($user_id) {
        return $this->getDefCvp($user_id);
    }
 }