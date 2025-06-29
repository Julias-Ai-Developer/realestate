<?php
// Set session cookie to expire after 1 hour (3600 seconds)
ini_set('session.gc_maxlifetime', 3600);
ini_set('session.cookie_lifetime', 3600);

session_start();

include __DIR__ . '/../database/conn.php';
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $usersql  = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND  deleted_at IS NULL LIMIT 1");
    // var_dump($usersql);
    // exit;
    if ($usersql && mysqli_num_rows($usersql) > 0){
        $user = mysqli_fetch_assoc($usersql);
    $id =  $user['id'];
    $username = $user['user_name'];
    $user_email = $user['email'];
    $user_password = $user['password'];
    $user_role = $user['role'];

    if ( $user_password === $password) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['user_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['role'] = $user['role'];
      
        $_SESSION['success'] = "Login successful! Welcome back.";
    header('Location: /tenants/view');
    exit();
  } else {
    header('Location: /homepage?error=login_failed');
    exit();
}
 }
  else {
    header('Location: /homepage?error=login_failed');
    exit();
  }
} else {
    echo "failed to fetch data";
}
