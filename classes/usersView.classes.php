<?php

class Usersview extends Users{
    public function showWhoToFollow($user_id) {
        return $this->getWhoToFollow($user_id);
    }
}