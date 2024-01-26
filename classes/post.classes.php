<?php

class Post extends Dbh {
    protected function getFolder($userId) {
        $sql = "SELECT folder FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        if(!$stmt->execute([$userId])) {
            header("location: ../subpages/home.php?stmtError");
            exit();
        }

        return $stmt->fetch();
    }

    protected function insertPost($caption, $fileFullPath, $userId) {
        $sql = "INSERT INTO twt_posts(caption, filePath, userId) VALUES(?, ?, ?)";
        $stmt = $this->conn()->prepare($sql);

        if(!$stmt->execute([$caption, $fileFullPath, $userId])) {
            header("location: ../subpages/home.php?stmtError");
            exit();
        }

        return $stmt;
    }

    protected function getForYouPosts() {
        $sql = "SELECT * FROM twt_posts ORDER BY postDate DESC";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    protected function getUserPosts(int $userId) {
        $sql = "SELECT twt_posts.*  FROM twt_posts WHERE userId = ?
                UNION ALL
                SELECT twt_posts.* FROM twt_posts LEFT JOIN twt_retweets ON twt_posts.userId = twt_retweets.posterId 
                WHERE retweeterId = ? ORDER BY postDate DESC";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$userId, $userId]);

        return $stmt->fetchAll();
    }

    protected function removePost($postId, $userId) {
        $sql = "DELETE FROM twt_posts WHERE userId = ? && postId = ?";
        $stmt = $this->conn()->prepare($sql);
        
        if ($stmt->execute([$userId, $postId])) {
            return true;
        }
        else {
            return false;
        }
    }

    protected function getFile($postId, $userId) {
        $sql = "SELECT filePath FROM twt_posts WHERE postId = ? && userId = ?";
        $stmt = $this->conn()->prepare($sql);

        try {
            $stmt->execute([$postId, $userId]);
        }
        catch(PDOException $e) {
            print("Error => " . $e->getMessage());
            die();
        }

        return $stmt->fetch()->filePath;
    }
}