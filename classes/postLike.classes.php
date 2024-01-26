<?php

class PostLike extends Dbh {
    private $postId;
    private $userIdPoster;
    private $userIdLiker;
    
    public function __construct(int $postId, int $userIdPoster, int $userIdLiker) {
        $this->postId = $postId;
        $this->userIdPoster = $userIdPoster;
        $this->userIdLiker = $userIdLiker;
    }

    public function likePost() {
        if ($this->isLiked()) {
            $this->removeLike();
        } 
        else {
            $this->insertLike();
        }
    }

    public function countLike() {
        $sql = "SELECT COUNT(likeId) AS likes FROM twt_likes WHERE postId = ? && userIdPoster = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->postId, $this->userIdPoster]);
            // var_dump($stmt->fetch());
            return $stmt->fetch()->likes;
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    private function insertLike() {
        $sql = "INSERT INTO twt_likes(postId, userIdLiker, userIdPoster) VALUES(?, ?, ?)";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->postId, $this->userIdLiker, $this->userIdPoster]);
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    public function isLiked() {
        $sql = "SELECT userIdLiker FROM twt_likes WHERE postId = ? && userIdLiker = ? && userIdPoster = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->postId, $this->userIdLiker, $this->userIdPoster]);

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

    public function removeLike() {
        $sql = "DELETE FROM twt_likes WHERE postId = ? && userIdLiker = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$this->postId, $this->userIdLiker]);
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }
}