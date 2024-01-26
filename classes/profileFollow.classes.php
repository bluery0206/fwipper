<?php

class ProfileFollow extends Dbh {
    private $followedId;
    private $followerId;
    
    public function __construct(int $followedId, int $followerId) {
        $this->followedId = $followedId;
        $this->followerId = $followerId;
    }

    public function follow() {
        if ($this->followed()) {
            $this->removeFollow();
        } 
        else {
            $this->insertFollow();
        }
    }

    public function countFollowers() {
        $sql = "SELECT COUNT(followedId) AS followers FROM twt_follows WHERE followedId = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->followerId]);
            // var_dump($stmt->fetch());
            return $stmt->fetch()->followers;
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    public function countFollowing() {
        $sql = "SELECT COUNT(followerId) AS following FROM twt_follows WHERE followerId = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->followerId]);
            // var_dump($stmt->fetch());
            return $stmt->fetch()->following;
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    private function insertFollow() {
        $sql = "INSERT INTO twt_follows(followedId, followerId) VALUES(?, ?)";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->followedId, $this->followerId]);
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    public function followed() {
        $sql = "SELECT followedId FROM twt_follows WHERE followedId = ? && followerId = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->followedId, $this->followerId]);

            if ($stmt->rowCount() != 0) {
                return true;
            }
            else {
                return;
            }
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    private function removeFollow() {
        $sql = "DELETE FROM twt_follows WHERE followedId = ? && followerId = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->followedId, $this->followerId]);
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }
}