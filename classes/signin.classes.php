<?php

class Signin extends Dbh {
    protected function getUser($ui, $pwd) {
        $sql = "SELECT * FROM twt_users WHERE uid = ? OR email = ?";
        $stmt = $this->conn()->prepare($sql);

        try {
            $stmt->execute([$ui, $ui]);
        } catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }

        $user = $stmt->fetch();

        if (empty($user)) {
            header("location: ../index.php?signinUiError=User does not exist.");
            exit();
        }

        if (!password_verify($pwd, $user->pwd)) {
            header("location: ../index.php?signinPwdError=Wrong password.");
            exit();
        }

        session_start();
        $_SESSION['login'] = $user->user_id;
        header("location: ../subpages/home.php?error=none");
        exit();
    }
}