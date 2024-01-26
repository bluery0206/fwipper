<?php

class SignupContr extends Signup {
    private $name;
    private $uid;
    private $email;
    private $month;
    private $day;
    private $year;
    private $pwd;

    public function __construct($name, $uid, $email, $month, $day, $year, $pwd) {
        $this->name     = $name;
        $this->uid      = $uid;
        $this->email    = $email;
        $this->month    = $month;
        $this->day      = $day;
        $this->year     = $year;
        $this->pwd      = $pwd;
    }
    
    public function signupUser() {
        $check = true;
        $err = "";

        if ($this->emptyName()) {
            $check = false;
            $err .= "nameError=Please specify your name.&";
        } else if ($this->invalidName()) {
            $check = false;
            $err .= "nameError=You can only use characters from a to z and dash(-).&";
        }

        if ($this->emptyUid()) {
            $check = false;
            $err .= "uidError=Please specify your username.&";
        } else if ($this->invalidUid()) {
            $check = false;
            $err .= "uidError=Invalid username.&";
        } else if ($this->shortUid()) {
            $check = false;
            $err .= "uidError=Username must be at least 8 characters long.&";
        }

        if ($this->emptyEmail()) {
            $check = false;
            $err .= "emailError=Please specify your email.&";
        } else if ($this->invalidEmail()) {
            $check = false;
            $err .= "emailError=Invalid email format.&";
        }

        if ($this->emptyPwd()) {
            $check = false;
            $err .= "pwdError=Please specify your password.&";
        } else if ($this->shortPwd()) {
            $check = false;
            $err .= "pwdError=Passwords must be at least 8 characters long.&";
        }
        
        if ($check != true) {
            header("location: ../index.php?" . $err);
            exit();
        }
        else { 
            $this->insertUser($this->name, $this->uid, $this->email, $this->month, $this->day, $this->year, $this->pwd);
        }
    }
    
    private function emptyName() {
        $res = false;

        if (empty($this->name)) {
            $res = true;
        }

        return $res;
    }

    private function emptyUid() {
        $res = false;

        if (empty($this->uid)) {
            $res = true;
        }

        return $res;
    }

    private function emptyEmail() {
        $res = false;

        if (empty($this->email)) {
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

    private function invalidName() {
        $res = false;

        $pattern = '/^[a-zA-Z- ]+$/';

        if (!preg_match($pattern, $this->name)) {
            $res = true;
        }

        return $res;
    }

    private function invalidUid() {
        $res = false;

        $pattern = '/^[a-zA-Z-_.@]+$/';

        if (!preg_match($pattern, $this->uid)) {
            $res = true;
        }

        return $res;
    }

    private function invalidEmail() {
        $res = false;

        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';

        if (!preg_match($pattern, $this->email)) {
            $res = true;
        }

        return $res;
    }

    private function shortUid() {
        $res = false;

        if (strlen($this->uid) < 8) {
            $res = true;
        }

        return $res;
    }

    private function shortPwd() {
        $res = false;

        if (strlen($this->pwd) < 8) {
            $res = true;
        }

        return $res;
    } 

    public function fetchUid($uid) {
        return $this->getUserId($uid);
    }

    public function fetchBday($uid) {
        return $this->getUserBday($uid);
    }
}