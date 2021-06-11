<?php
include '../includes/connect.php';
$user_id = $_SESSION['user_id'];

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}


$name = htmlspecialchars($_POST['name']);
$username = htmlspecialchars($_POST['username']);
$password =  htmlspecialchars($_POST['password']);
$phone = $_POST['phone'];
$email = htmlspecialchars($_POST['email']);
$address = htmlspecialchars($_POST['address']);
$sql = "UPDATE users SET name = '$name', username = '$username', password='$password', contact=$phone, email='$email', address='$address', image='$target_file' WHERE id = $user_id;";
if($con->query($sql)==true){
	$_SESSION['name'] = $name;
}
header("location: ../details.php");
?>