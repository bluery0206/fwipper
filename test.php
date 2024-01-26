<form action="test.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="upload">Upload</button>
</form>

<?php
if (isset($_POST["upload"])) {
    $filename = $_FILES['file']; 
    $img_type = $filename['type'];
    $name = $filename['name'];
    $size = $filename['size'];
    $error = $filename['error'];
    $tmp_name = $filename['tmp_name'];


    $fileInfo       = explode(".", $name);
    $fileExtension  = strtolower(end($fileInfo));
    $fileDir        = "../media/default/";
    $fileNewName    = "UPLOAD" . date("YmdHis") . "." . $fileExtension;
    $fileFullPath   = $fileDir . $fileNewName;

    echo "<br>" . $fileFullPath . "<br>";
    echo "<br>" . basename($_FILES['file']['name']) . "<br>";
    
    print_r ($_FILES['file']);
    echo "<br>";
    var_dump  ($_FILES['file']);
    echo "<br>";
    echo $filename["type"];

    $allowed = ["image/png", "image/jpg", "image/jpeg"];

    if (!in_array($img_type, $allowed)) {
        $res = false;
    }

// echo $img_type;
}
?>
















<?php



// echo uniqid();

// class ProfileContr {
// // Properties
// private $cover_picture_path;
// private $profile_picture_path;
// private $default_bio;
// private $default_website;

// // Constructor
// public function __construct() {
// // Initialize default values in the constructor
// $this->cover_picture_path = "path";
// $this->profile_picture_path = "path";
// $this->default_bio = "default empty bio message";
// $this->default_website = "default empty website message";
// }

// // Other methods...

// public function setProfile($name, $bday) {
// // // Use the initialized properties in other methods as needed
// // $this->insertProfile(
// // $this->profile_picture_path,
// // $this->cover_picture_path,
// // $name,
// // $bday,
// // $this->default_bio,
// }}