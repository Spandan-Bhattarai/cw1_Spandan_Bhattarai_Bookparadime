<?php
// Include connection file 
require_once 'connect.php';

// Get form data
$email = $_POST['email'];
$password = $_POST['password']; 

// Fetch user data
$sql = "SELECT * FROM users WHERE email='$email'";
$user = $conn->query($sql)->fetch_assoc();

// Verify password
if (password_verify($password, $user['password'])) {

  // Check if admin
  if ($user['is_admin'] == 1) {
    // Set admin cookie
    setcookie('user_type', 'admin', time() + 3600);
    header('Location: admin-dashbaord.php');
  } else {  
    // Set regular user cookie 
    setcookie('user_type', 'user', time() + 3600);
    header('Location: home.php'); 
  }
  
  exit();

} else {
  echo "Invalid credentials";
}

?>