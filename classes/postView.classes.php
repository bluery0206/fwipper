<?php

class PostView extends Post {
    public function showUserPost($userId) {
        return $this->getUserPosts($userId);
    }

    public function reformatPostDate($postFullDate) {
        $postFullDate = strtotime($postFullDate);
        $postYear = date("Y", $postFullDate);

        $currYear = date("Y");

        if ($postYear < $currYear) {
            return date("M j, Y", $postFullDate);
        }

        return date("M j", $postFullDate);
    }

    public function fetchForYouPosts() {
        return $this->getForYouPosts();
    }
}