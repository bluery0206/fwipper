<?php

class Dbh {
    protected function conn() {
        $host = "localhost";
        $user = "root";
        $pwd = "";
        $dbname = "twitter_db";

        $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
        $pdo = new PDO($dsn, $user, $pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo;
    }
}