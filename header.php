<?php
// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if(!isset($_SESSION['username'])){
    header("Location: userlogin.php");
    exit();
}

$username = $_SESSION['username'];
$phone    = $_SESSION['phone'];  // session থেকে phone
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sahab Hotel</title>
<style>
body { 
    margin:0; 
    font-family: Arial, sans-serif; 
    background:#f4f4f4; 
}

/* Navbar */
.navbar { 
    background:#1a1a1a; 
    color:white; 
    display:flex; 
    justify-content:space-between; 
    align-items:center; 
    padding:0 20px; 
    height:60px;
}

.navbar a { 
    color:white; 
    text-decoration:none; 
    padding:14px 20px; 
    display:block; 
}

.navbar a:hover { 
    background:#555; 
    border-radius:4px; 
}

.nav-left, .nav-right { 
    display:flex; 
    align-items:center; 
    gap:10px; /* spacing between username/phone and logout */
}

.navbar .brand { 
    font-weight:bold; 
    color:#4a80f5; 
    padding-right:20px; 
    font-size:16px; 
}

.navbar .username { 
    color:#ffcc00; 
    padding:14px 20px; 
}

/* Main container */
.container { 
    padding:20px; 
    max-width:1200px; 
    margin:0 auto; 
    box-sizing:border-box;
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="nav-left">
        <span class="brand">Sahab Online Hotel Booking</span>
        <a href="userpage.php">Home</a>
        <a href="about.php">About</a>
        <a href="booknow.php">Book Now</a>
        <a href="mybooking.php">My Booking</a>
    </div>
    <div class="nav-right">
        <span class="username">Hello, <?php echo htmlspecialchars($username); ?> | Phone: <?php echo htmlspecialchars($phone); ?></span>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- Main content container starts -->
<div class="container">
