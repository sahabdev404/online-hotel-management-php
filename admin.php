<?php
session_start();
// DB connection
$con = mysqli_connect("localhost","root","","sahabhotel");
if(!$con){ die("<script>alert('Database Connection Failed');</script>"); }

$section = isset($_GET['section']) ? $_GET['section'] : 'insert';

/* ---------------- INSERT ---------------- */
if(isset($_POST['insert_booking'])){
    $name = $_POST['name']; $phoneno = $_POST['phoneno']; $email = $_POST['email'];
    $checkin = $_POST['checkin']; $checkin_time = $_POST['checkin_time'];
    $checkout = $_POST['checkout']; $checkout_time = $_POST['checkout_time'];
    $roomtype = $_POST['roomtype']; $noofroom = $_POST['noofroom']; $totalprice = $_POST['totalprice'];

    $sql = "INSERT INTO book VALUES('$name','$phoneno','$email','$checkin','$checkin_time','$checkout','$checkout_time','$roomtype','$noofroom','$totalprice')";
    $res = mysqli_query($con,$sql);
    if($res){ echo "<script>alert('Booking Successfully Saved!'); window.location='?section=insert';</script>"; }
    else{ echo "<script>alert('Error: Booking Not Saved');</script>"; }
}

/* ---------------- SEARCH & UPDATE ---------------- */
$showForm = false;
$row = null;
if(isset($_POST['search_booking'])){
    $phoneno = $_POST['phoneno'];
    $res = mysqli_query($con,"SELECT * FROM book WHERE phoneno='$phoneno'");
    if(mysqli_num_rows($res)>0){ $row=mysqli_fetch_assoc($res); $showForm=true; }
    else{ echo "<script>alert('No Record Found');</script>"; }
}

if(isset($_POST['update_booking'])){
    $name=$_POST['name']; $phoneno=$_POST['phoneno']; $email=$_POST['email'];
    $checkin=$_POST['checkin']; $checkin_time=$_POST['checkin_time'];
    $checkout=$_POST['checkout']; $checkout_time=$_POST['checkout_time'];
    $roomtype=$_POST['roomtype']; $noofroom=$_POST['noofroom']; $totalprice=$_POST['totalprice'];
    $old_phoneno=$_POST['old_phoneno'];

    $res=mysqli_query($con,"UPDATE book SET 
        name='$name', phoneno='$phoneno', email='$email', checkin='$checkin',
        checkin_time='$checkin_time', checkout='$checkout', checkout_time='$checkout_time',
        roomtype='$roomtype', noofroom='$noofroom', totalprice='$totalprice' WHERE phoneno='$old_phoneno'");
    if($res){ echo "<script>alert('Booking Updated Successfully!'); window.location='?section=update';</script>"; exit; }
    else{ echo "<script>alert('Update Failed!'); $showForm=true; </script>"; }
}

/* ---------------- DELETE ---------------- */
$showData=false;
$data=null;
if(isset($_POST['search_delete'])){
    $phoneno=$_POST['phoneno'];
    $res=mysqli_query($con,"SELECT * FROM book WHERE phoneno='$phoneno'");
    if(mysqli_num_rows($res)>0){ $data=mysqli_fetch_assoc($res); $showData=true; }
    else{ echo "<script>alert('No Record Found');</script>"; }
}
if(isset($_POST['delete_booking'])){
    $phoneno=$_POST['phoneno'];
    $res=mysqli_query($con,"DELETE FROM book WHERE phoneno='$phoneno'");
    if(mysqli_affected_rows($con)>0){ echo "<script>alert('Record Deleted Successfully!'); window.location='?section=delete';</script>"; }
    else{ echo "<script>alert('Delete Failed');</script>"; }
}

/* ---------------- ALL BOOKINGS ---------------- */
$search_sql="SELECT * FROM book";
if(isset($_POST['search_all']) && !empty($_POST['search_term'])){
    $term=$_POST['search_term'];
    $search_sql="SELECT * FROM book WHERE name LIKE '%$term%' OR phoneno LIKE '%$term%'";
}
$allBookings=mysqli_query($con,$search_sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body{ margin:0; font-family:Arial,sans-serif; background:#f0f0f0;}
        /* Sidebar */
        .sidebar{ width:220px; background:#333; height:100vh; position:fixed; color:white; display:flex; flex-direction:column;}
        .sidebar h2{ text-align:center; padding:20px 0; margin:0; background:#000;}
        .sidebar a{ padding:15px 20px; color:#ccc; text-decoration:none; display:block; transition:0.3s;}
        .sidebar a:hover{ background:#555; color:white; }
        /* Main content */
        .main{ margin-left:220px; padding:30px;}
        .card{ background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 12px rgba(0,0,0,0.2); margin-bottom:20px;}
        .row{ display:flex; gap:25px; justify-content:space-between;}
        .col{ width:50%;}
        input, select{ width:100%; padding:8px; margin:6px 0 15px 0; border:1px solid #aaa; border-radius:5px; font-size:14px; background:#f8f8f8;}
        .btn{ padding:12px; width:48%; border:none; cursor:pointer; border-radius:5px; font-size:15px;}
        .btn-save{ background:#28a745; color:white;}
        .btn-clear{ background:#6c757d; color:white;}
        .btn-save:hover{ background:#218838;}
        .btn-clear:hover{ background:#5a6268;}
        .btn-delete{ background:red; color:white; width:100%; margin-top:10px; padding:10px; border:none; border-radius:5px;}
        table{ border-collapse:collapse; width:100%; margin-top:15px;}
        th, td{ border:1px solid #333; padding:10px; text-align:left;}
        th{ background:#333; color:white;}
        h2, h3{margin-top:0;}
    </style>
</head>
<body>
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="?section=insert">Insert Booking</a>
    <a href="?section=all">All Bookings</a>
    <a href="?section=update">Search & Update</a>
    <a href="?section=delete">Delete Booking</a>
    <a href="?section=logout">Logout</a>
</div>

<div class="main">

<?php if($section=='insert'){ ?>
<div class="card">
<h2>Insert Booking</h2>
<form method="POST">
    <div class="row">
        <div class="col">
            <label>Name:</label><input name="name" required>
            <label>Phone No:</label><input name="phoneno" required>
            <label>Email:</label><input type="email" name="email" required>
            <label>Room Type:</label>
            <select name="roomtype" id="roomtype_insert" onchange="calculatePrice('insert')">
                <option value="Non AC">Non AC</option>
                <option value="AC">AC</option>
            </select>
        </div>
        <div class="col">
            <label>Check-in Date:</label><input type="date" name="checkin" required>
            <label>Check-in Time:</label><input type="time" name="checkin_time">
            <label>Checkout Date:</label><input type="date" name="checkout" required>
            <label>Checkout Time:</label><input type="time" name="checkout_time">
        </div>
    </div>
    <div class="row">
        <div class="col"><label>No. of Rooms:</label><input type="number" id="noofroom_insert" name="noofroom" min="1" value="1" onchange="calculatePrice('insert')" onkeyup="calculatePrice('insert')" required></div>
        <div class="col"><label>Total Price:</label><input type="text" id="totalprice_insert" name="totalprice" readonly></div>
    </div>
    <div class="row" style="justify-content:center;">
        <button type="submit" name="insert_booking" class="btn btn-save">SAVE BOOKING</button>
        <button type="reset" class="btn btn-clear">CLEAR</button>
    </div>
</form>
</div>
<?php } ?>

<?php if($section=='all'){ ?>
<div class="card">
<h2>All Bookings</h2>
<form method="POST" style="margin-bottom:15px;">
    <input type="text" name="search_term" placeholder="Search by Name or Phone">
    <button type="submit" name="search_all" class="btn btn-save" style="width:auto;">SEARCH</button>
</form>
<table>
<tr><th>Name</th><th>Phone</th><th>Email</th><th>Check-in</th><th>Check-out</th><th>Room Type</th><th>No. Rooms</th><th>Total Price</th></tr>
<?php while($row=mysqli_fetch_assoc($allBookings)){ ?>
<tr>
<td><?= $row['name'];?></td>
<td><?= $row['phoneno'];?></td>
<td><?= $row['email'];?></td>
<td><?= $row['checkin'].' '.$row['checkin_time'];?></td>
<td><?= $row['checkout'].' '.$row['checkout_time'];?></td>
<td><?= $row['roomtype'];?></td>
<td><?= $row['noofroom'];?></td>
<td><?= $row['totalprice'];?></td>
</tr>
<?php } ?>
</table>
</div>
<?php } ?>

<?php if($section=='update'){ ?>
<div class="card">
<h2>Search & Update Booking</h2>
<form method="POST">
<label>Phone No to Search:</label>
<input type="text" name="phoneno" required>
<br><br>
<button type="submit" name="search_booking" class="btn btn-save">SEARCH</button>
</form>

<?php if($showForm){ ?>
<form method="POST" style="margin-top:20px;">
<label>Name:</label><input type="text" name="name" value="<?= $row['name']; ?>">
<label>Phone No:</label>
<input type="text" name="phoneno" value="<?= $row['phoneno']; ?>">
<input type="hidden" name="old_phoneno" value="<?= $row['phoneno']; ?>">
<label>Email:</label><input type="email" name="email" value="<?= $row['email']; ?>">
<label>Check-in Date:</label><input type="date" name="checkin" value="<?= $row['checkin']; ?>">
<label>Check-in Time:</label><input type="time" name="checkin_time" value="<?= $row['checkin_time']; ?>">
<label>Checkout Date:</label><input type="date" name="checkout" value="<?= $row['checkout']; ?>">
<label>Checkout Time:</label><input type="time" name="checkout_time" value="<?= $row['checkout_time']; ?>">
<label>Room Type:</label>
<select name="roomtype" id="roomtype_update" onchange="calculatePrice('update')">
<option value="Non AC" <?= ($row['roomtype']=='Non AC')?'selected':'';?>>Non AC</option>
<option value="AC" <?= ($row['roomtype']=='AC')?'selected':'';?>>AC</option>
</select>
<label>No. of Rooms:</label>
<input type="number" name="noofroom" id="noofroom_update" value="<?= $row['noofroom'];?>" onkeyup="calculatePrice('update')" onchange="calculatePrice('update')">
<label>Total Price:</label>
<input type="text" name="totalprice" id="totalprice_update" value="<?= $row['totalprice'];?>" readonly>
<br>
<button type="submit" name="update_booking" class="btn btn-save">UPDATE BOOKING</button>
</form>
<?php } ?>
</div>
<?php } ?>

<?php if($section=='delete'){ ?>
<div class="card">
<h2>Search Booking To Delete</h2>
<form method="POST">
<input type="text" name="phoneno" placeholder="Enter Phone Number" required>
<br><br>
<button type="submit" name="search_delete" class="btn btn-save">SEARCH</button>
</form>

<?php if($showData){ ?>
<div style="margin-top:20px;">
<h3>Booking Details</h3>
<table>
<tr><th>Name</th><td><?= $data['name'];?></td></tr>
<tr><th>Phone</th><td><?= $data['phoneno'];?></td></tr>
<tr><th>Email</th><td><?= $data['email'];?></td></tr>
<tr><th>Check-in</th><td><?= $data['checkin'].' ('.$data['checkin_time'].')';?></td></tr>
<tr><th>Check-out</th><td><?= $data['checkout'].' ('.$data['checkout_time'].')';?></td></tr>
<tr><th>Room Type</th><td><?= $data['roomtype'];?></td></tr>
<tr><th>No. of Rooms</th><td><?= $data['noofroom'];?></td></tr>
<tr><th>Total Price</th><td><?= $data['totalprice'];?></td></tr>
</table>
<form method="POST">
<input type="hidden" name="phoneno" value="<?= $data['phoneno'];?>">
<button type="submit" name="delete_booking" class="btn btn-delete">CONFIRM DELETE</button>
</form>
</div>
<?php } ?>
</div>
<?php } ?>

<?php 
if ($section == 'logout') {
    session_unset();
    session_destroy();
    echo "<script>
            alert('Logged Out');
            window.location='index.html';
          </script>";
    exit();
}
?>

</div>

<script>
function calculatePrice(section){
    let roomType = document.getElementById("roomtype_"+section).value;
    let numRooms = document.getElementById("noofroom_"+section).value;
    let price = (roomType=="AC")?2000:1500;
    document.getElementById("totalprice_"+section).value = price*numRooms;
}
</script>

</body>
</html>
