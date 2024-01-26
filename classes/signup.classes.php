<?php

class Signup extends Dbh {
    protected function insertUser($name, $uid, $email, $month, $day, $year, $pwd) {
        $check = true;
        $err = "";

        if ($this->uidExist($uid)) {
            $check = false;
            $err .= "uidError=That username is taken.&";
        }

        if ($this->emailExist($email)) {
            $check = false;
            $err .= "emailError=That email is taken.&";
        }

        if ($check == false) {
            header("location: ../index.php?". $err);
            exit();
        }
        else {
            $bday = $year . "-" . $month . "-" . $day;

            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

            $sql = "INSERT INTO twt_users(name, uid, email, bday, pwd) VALUES(?, ?, ?, ?, ?);";
            $stmt = $this->conn()->prepare($sql);
            try {
                $stmt->execute([$name, $uid, $email, $bday, $hashedPwd]);
                $stmt = null;
            } catch (PDOException $e) {
                echo "Error => " . $e->getMessage();
                die();
            }
        }
    }

    private function uidExist($uid) {
        $sql = "SELECT * FROM twt_users WHERE uid = ?";
        $stmt = $this->conn()->prepare($sql);

        try {
            $stmt->execute([$uid]);
        } catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }

        $res = $stmt->fetch();

        $check = false;
        if (!empty($res->uid)) {
            $check = true;
        }

        $stmt = null;

        return $check;
    }

    private function emailExist($email) {
        $sql = "SELECT * FROM twt_users WHERE email = ?";
        $stmt = $this->conn()->prepare($sql);

        try {
            $stmt->execute([$email]);
        } catch (PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }

        $res = $stmt->fetch();

        $check = false;
        if (!empty($res->email)) {
            $check = true;
        }

        $stmt = null;

        return $check;
    }
    
    protected function getUserId($uid) {
        $sql = "SELECT user_id FROM twt_users WHERE uid = ?";
        
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$uid]);

        $res = $stmt->fetch();

        $stmt = null;

        return $res->user_id;
    }
    
    protected function getUserBday($uid) {
        $sql = "SELECT bday FROM twt_users WHERE uid = ?";
        
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$uid]);

        $res = $stmt->fetch();

        $stmt = null;

        return $res->bday;
    }
}