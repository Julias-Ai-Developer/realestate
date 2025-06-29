<?php
session_start(); // ✅ Start session first

// Check if session is set
if (!isset($_SESSION['id'])) {
      header('Location:/error');
    exit();
}

// Sanitize session variables
$userName = htmlspecialchars($_SESSION['username']);
$userRole = htmlspecialchars($_SESSION['role']);

// DB connection
include __DIR__ . '/../database/conn.php';


if (isset($_POST['save'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName    = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $property   = mysqli_real_escape_string($conn, $_POST['property']);
    $rent   = mysqli_real_escape_string($conn, $_POST['rent']);
    $status   = mysqli_real_escape_string($conn, $_POST['status']);
    $leaseStart   = mysqli_real_escape_string($conn, $_POST['leaseStart']);
    $leaseEnd   = mysqli_real_escape_string($conn, $_POST['leaseEnd']);
    $notificationSms   = mysqli_real_escape_string($conn, $_POST['notificationSms']);
    $notificationEmail   = mysqli_real_escape_string($conn, $_POST['notificationEmail']);
    $notes   = mysqli_real_escape_string($conn, $_POST['notes']);
    $category = mysqli_real_escape_string($conn ,$_POST['category']);
    $added_by = $userName;
//keepimage
  // Get the uploaded image name
$image_name = $_FILES['my_img']['name'];

// Extract the file extension
$tmp = explode(".", $image_name);
$extension = end($tmp);

// Generate a unique filename
$newfile_name = round(microtime(true)) . '.' . $extension;

// Define the upload path
$uploadpath ="./imageuploads/" . $newfile_name;

// Move the uploaded file to the desired folder
if (move_uploaded_file($_FILES['my_img']['tmp_name'], $uploadpath)) {
    echo "Image uploaded successfully to " . $uploadpath;
} else {
    echo "Image upload failed.";
}


    $sqlInsert = mysqli_query($conn ,"INSERT INTO tenants ( `first_name`, `last_name` , `email` , `phone` , `property` , `rent` , `status` , `lease_start` , `lease_end` , `notification_sms` , `notification_email`  , `notes` , `categories` , `image_path` , `added_by`) 
vALUES(  '$firstName', '$lastName' , '$email' , '$phone' , '$property' , '$rent' , '$status' , '$leaseStart' , '$leaseEnd' , '$notificationSms' , '$notificationEmail' , '$notes' , '$category' , '$newfile_name' , '$added_by')");
if ($sqlInsert) {
    header("Location: /homepage");
    exit(); // Prevent further script execution
} else {
    echo "Failed to insert data.";
}


}
