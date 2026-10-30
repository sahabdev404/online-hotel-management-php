<?php
// admin_login.php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "sahabhotel";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

$msg = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $_SESSION['admin'] = $username;
        header("Location: admin.php");
        exit();
    } else {
        $msg = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body{
            background: #b8bed3ff;
            margin: 0;
            font-family: Arial;
        }
        .box{
            width: 350px;
            background: #fff;
            padding: 25px;
            margin: 100px auto;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.2);
        }
        h2{
            text-align: center;
            margin-bottom: 20px;
        }
        input{
            width: 98%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
        button{
            width: 60%;
            padding: 10px;
             margin: 10px 69px 0;
            background: #001761ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover{
            background: #555;
        }
        .msg{
            text-align: center;
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Admin Login</h2>

    <?php if($msg != "") echo "<p class='msg'>$msg</p>"; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
        
    </form>
</div>
</body>
</html>
