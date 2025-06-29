<?php
session_start(); // ✅ Start session first

// Check if session is set
if (!isset($_SESSION['id'])) {
      header('Location:/error');
    exit();
}

// DB connection
include __DIR__ . '/../database/conn.php';
    if(isset($_POST['delete'])){
        $id = $_POST['tenant_id'];
        $current_time_stamp = date('Y:m:d H:m:s');

        $sql_delete = mysqli_query($conn,"UPDATE tenants SET deleted_at = '$current_time_stamp' WHERE id = $id");
        if($sql_delete){
            header('Location:/homepage');
        }
else{
    echo "failed";
}

    }