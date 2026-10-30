<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "sahabhotel";

$conn = new mysqli($host, $user, $pass, $db);

$msg = "";

// Registration
if(isset($_POST['register'])){
    $name     = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone    = $_POST['phone'];
    $email    = $_POST['email'];

    $sql = "INSERT INTO user (name, username, password, phone, email)
            VALUES ('$name', '$username', '$password', '$phone', '$email')";

    if($conn->query($sql)){
        echo "<script>alert('Account created successfully!');</script>";
    }
}

// Login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];  // session এ username
        $_SESSION['phone']    = $row['phone'];     // session এ phone

        echo "<script>
                alert('Login Successful!');
                window.location='userpage.php';
              </script>";
        exit();
    } else {
        $msg = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>User Login/Register</title>

<style>
body{
    margin:0;
    background:#e9eef5;
    font-family:Arial;
}

.wrapper{
    width:400px;
    background:white;
    padding:30px;
    margin:70px auto;
    border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
    color:#333;
    margin-bottom:20px;
}

input{
    width:93%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:15px;
}

button{
    width:100%;
    padding:12px;
    background:#4a80f5;
    color:white;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
    margin-top:5px;
}
button:hover{
    background:#3a6fe0;
}

.toggle{
    text-align:center;
    margin-top:12px;
    color:#4a80f5;
    cursor:pointer;
    font-size:14px;
}
.toggle:hover{
    text-decoration:underline;
}

.msg{
    text-align:center;
    color:red;
    margin-bottom:10px;
}

#registerForm{ display:none; }
</style>

<script>
function showRegister(){
    document.getElementById("loginForm").style.display="none";
    document.getElementById("registerForm").style.display="block";
}
function showLogin(){
    document.getElementById("registerForm").style.display="none";
    document.getElementById("loginForm").style.display="block";
}
</script>
</head>
<body>

<div class="wrapper">

<p class="msg"><?php echo $msg; ?></p>

<!-- Login Form -->
<div id="loginForm">
    <h2>User Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button name="login">Login</button>
    </form>

    <div class="toggle" onclick="showRegister()">Create Account</div>
</div>

<!-- Registration Form -->
<div id="registerForm">
    <h2>Create Account</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="email" name="email" placeholder="Email" required>

        <button name="register">Register</button>
    </form>

    <div class="toggle" onclick="showLogin()">Already have an account?</div>
</div>

</div>

</body>
</html>
