<?php

class SigninContr extends Signin {
    private $ui;
    private $pwd;

    public function __construct($ui, $pwd) {
        $this->ui      = $ui;
        $this->pwd      = $pwd;
    }
    
    public function signinUser() {
        $check = true;
        $err = "";

        if ($this->emptyUi()) {
            $check = false;
            $err .= "signinUiError=Please specify your username.&";
        }

        if ($this->emptyPwd()) {
            $check = false;
            $err .= "signinPwdError=Please specify your password.&";
        } 
        
        if ($check != true) {
            header("location: ../index.php?" . $err);
            exit();
        }
        else { 
            $this->getUser($this->ui, $this->pwd);
        }
    }
    
    private function emptyUi() {
        $res = false;

        if (empty($this->ui)) {
            $res = true;
        }

        return $res;
    }

    private function emptyPwd() {
        $res = false;

        if (empty($this->pwd)) {
            $res = true;
        }

        return $res;
    }
}