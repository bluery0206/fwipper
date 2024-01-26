<?php

class PostRetweet extends Dbh {
    private $postId;
    private $posterId;
    private $retweeterId;
    
    public function __construct(int $postId, int $posterId, int $retweeterId) {
        $this->postId = $postId;
        $this->posterId = $posterId;
        $this->retweeterId = $retweeterId;
    }

    public function retweetPost() {
        if ($this->isRetweeted()) {
            $this->unRetweet();
        } 
        else {
            $this->insertRetweet();
        }
    }

    public function countRetweet() {
        $sql = "SELECT COUNT(retweetId) AS retweets FROM twt_retweets WHERE postId = ? && posterId = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->postId, $this->posterId]);
            // var_dump($stmt->fetch());
            return $stmt->fetch()->retweets;
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    private function insertRetweet() {
        $sql = "INSERT INTO twt_retweets(postId, retweeterId, posterId) VALUES(?, ?, ?)";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->postId, $this->retweeterId, $this->posterId]);
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    public function isRetweeted() {
        $sql = "SELECT retweeterId FROM twt_retweets WHERE postId = ? && retweeterId = ? && posterId = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->postId, $this->retweeterId, $this->posterId]);

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

    public function unRetweet() {
        $sql = "DELETE FROM twt_retweets WHERE postId = ? && retweeterId = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->postId, $this->retweeterId]);
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }
}