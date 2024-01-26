<?php

class ProfileView extends Profile {
	private $uid;

	public function __construct($uid){
		$this->uid = $uid;
	}

	public function fetchProfilePicture() {
		return $this->getProfilePicture($this->uid) ;
	}

	public function fetchCoverPicture() {
		return $this->getCoverPicture($this->uid) ;
	}

	public function fetchName() {
		return $this->getName($this->uid);
	}

	public function fetchUid() {
		return $this->getUid($this->uid);
	}

	public function fetchBio() {
		return $this->getBio($this->uid);
	}

	public function fetchBday() {
		return $this->getBday($this->uid);
	}

	public function showBday() {
		return $this->getShowBday($this->uid);
	}

	public function fetchRegDate() {
		return $this->getRegDate($this->uid);
	}

	public function fetchLoc() {
		return $this->getLoc($this->uid);
	}

	public function fetchWeb() {
		return $this->getWeb($this->uid);
	}

	public function fetchFollowers() {
		return $this->getFollowers($this->uid);
	}

	public function fetchFollowing() {
		return $this->getFollowing($this->uid);
	}
}