<?php
session_start(); // ✅ Start session first

// Check if session is set
if (!isset($_SESSION['id'])) {
      header('Location:/error');
    exit();
}

// DB connection
include __DIR__ . '/../database/conn.php';

if (isset($_POST['save'])) {
    $id =  $_POST['tenant_id'];
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
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    //keepimage
    // Get the uploaded image name
    $image_name = $_FILES['my_img']['name'];

    // Extract the file extension
    $tmp = explode(".", $image_name);
    $extension = end($tmp);

    // Generate a unique filename
    $newfile_name = round(microtime(true)) . '.' . $extension;

    // Define the upload path
    $uploadDir = __DIR__ . '/../imageuploads/'; // absolute path to imageuploads folder
    $uploadpath = $uploadDir . $newfile_name;


    // Move the uploaded file to the desired folder
    if (move_uploaded_file($_FILES['my_img']['tmp_name'], $uploadpath)) {
        echo "Image uploaded successfully to " . $uploadpath;
    } else {
        echo "Image upload failed.";
    }


    $sqliUpdate = mysqli_query($conn, "
    UPDATE tenants SET 
        first_name = '$firstName',
        last_name = '$lastName',
        email = '$email',
        phone = '$phone',
        property = '$property',
        rent = '$rent',
        status = '$status',
        lease_start = '$leaseStart',
        lease_end = '$leaseEnd',
        notification_sms = '$notificationSms',
        notification_email = '$notificationEmail',
        notes = '$notes',
        categories = '$category',
        image_path = '$newfile_name'
    WHERE id = '$id'
");



    if ($sqliUpdate) {
        header("Location: /homepage"); // ✅ Correct syntax
        exit(); // Always good to call exit after a header redirect
    } else {
        echo "failed";
    }
}
