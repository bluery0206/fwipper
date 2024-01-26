<?php

class Users extends Dbh {
    protected function getWhoToFollow($user_id) {
        $sql = "SELECT twt_profiles.name, uid, pfp, twt_profiles.user_id FROM twt_users INNER JOIN twt_profiles ON twt_users.user_id = twt_profiles.user_id WHERE NOT twt_users.user_id = ?";

        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$user_id]);

        return $stmt->fetchAll();
    }
}