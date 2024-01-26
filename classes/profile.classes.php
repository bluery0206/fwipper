 <?php

 class Profile extends Dbh {
    protected function setProfile($cvp, $pfp, $name, $bday, $folder, $user_id) {
        $sql = "INSERT INTO twt_profiles(cvp, pfp, name, bday, folder, user_id) VALUES(?, ?, ?, ?, ?, ?);";
        $stmt = $this->conn()->prepare($sql);

        try {
            $stmt->execute([$cvp, $pfp, $name, $bday, $folder, $user_id]);
            $stmt = null;
        }
        catch(PDOException $e) {
            echo "Error =>  ". $e->getMessage();
            die();
        }
    }

    protected function setNewProfile($cvp, $pfp, $name, $bio, $loc, $web, $showBday, $user_id) {
        $sql = "UPDATE twt_profiles
                SET 
                    cvp = ?, 
                    pfp = ?, 
                    name = ?, 
                    bio = ?, 
                    loc = ?, 
                    web = ?,
                    showBday = ?
                WHERE user_id = ?;";
        $stmt = $this->conn()->prepare($sql);

        try {
            $stmt->execute([$cvp, $pfp, $name, $bio, $loc, $web, $showBday, $user_id]);
            $stmt = null;
        } catch (PDOException $e) {
            echo "Error =>  " . $e->getMessage();
            die();
        }
    }

    protected function getProfilePicture($user_id){
        $sql = "SELECT pfp FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $pfp = $res->pfp;

            $stmt = null;

            return $pfp;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    protected function getCoverPicture($user_id){
        $sql = "SELECT cvp FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $cvp = $res->cvp;

            $stmt = null;

            return $cvp;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    protected function getName($user_id){
        $sql = "SELECT name FROM twt_users WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $name = $res->name;

            $stmt = null;

            return $name;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    protected function getUid($user_id){
        $sql = "SELECT uid FROM twt_users WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $uid = $res->uid;

            $stmt = null;

            return $uid;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    protected function getBio($user_id){
        $sql = "SELECT bio FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $bio = $res->bio;

            $stmt = null;

            return $bio;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    protected function getBday($user_id){
        $sql = "SELECT bday FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $bday = $res->bday;

            $stmt = null;

            return $bday;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    protected function getShowBday($user_id){
        $sql = "SELECT showBday FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $showBday = $res->showBday;

            $stmt = null;

            return $showBday;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }
 
    protected function getRegDate($user_id){
        $sql = "SELECT reg_date FROM twt_users WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $reg_date = $res->reg_date;

            $stmt = null;

            return $reg_date;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    protected function getLoc($user_id){
        $sql = "SELECT loc FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $loc = $res->loc;

            $stmt = null;

            return $loc;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    protected function getWeb($user_id){
        $sql = "SELECT web FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $web = $res->web;

            $stmt = null;

            return $web;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    protected function getFolder($user_id){
        $sql = "SELECT folder FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $folder = $res->folder;

            $stmt = null;

            return $folder;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    protected function getDefPfp($user_id){
        $sql = "SELECT pfp FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $pfp = $res->pfp;

            $stmt = null;

            return $pfp;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }
        
    protected function getDefCvp($user_id){
        $sql = "SELECT cvp FROM twt_profiles WHERE user_id = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$user_id]);

            $res = $stmt->fetch();

            $cvp = $res->cvp;

            $stmt = null;

            return $cvp;
        }
        catch(PDOException $e) { 
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    public function getFollowers($uid) {
        $sql = "SELECT followerId FROM twt_follows WHERE followedId = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$uid]);

            return $stmt->fetchAll();
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }

    public function getFollowing($uid) {
        $sql = "SELECT followedId FROM twt_follows WHERE followerId = ?";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute([$uid]);

            return $stmt->fetchAll();
        }
        catch(PDOException $e) {
            echo "Error => " . $e->getMessage();
            die();
        }
    }
 }