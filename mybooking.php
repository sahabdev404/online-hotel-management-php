<?php
include 'header.php'; // session start and check

$username = $_SESSION['username'];
$phone    = $_SESSION['phone'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "sahabhotel");
if (!$con) {
    die("<script>alert('Database Connection Failed');</script>");
}

// Handle cancel request based on phoneno + roomtype
if (isset($_GET['cancel_roomtype'])) {
    $cancel_roomtype = $_GET['cancel_roomtype'];

    // Delete booking(s) that match this phone number AND roomtype
    $del_sql = "DELETE FROM `book` WHERE `phoneno`='$phone' AND `roomtype`='$cancel_roomtype'";
    mysqli_query($con, $del_sql);

    echo "<script>alert('Booking cancelled successfully!'); window.location='mybooking.php';</script>";
    exit();
}

// Fetch bookings for this user from book table
$booking_query = mysqli_query($con, "SELECT * FROM `book` WHERE `phoneno`='$phone'");
if(!$booking_query){
    die("Error in booking query: " . mysqli_error($con));
}
?>

<h2 style="text-align:center; margin-bottom:20px;">My Bookings</h2>

<?php if(mysqli_num_rows($booking_query) > 0): ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:center;">
        <thead style="background:#4a80f5; color:white;">
            <tr>
                <th>Name</th>
                <th>Phone No</th>
                <th>Email</th>
                <th>Room Type</th>
                <th>Check-in</th>
                <th>Check-in Time</th>
                <th>Checkout</th>
                <th>Checkout Time</th>
                <th>No. of Rooms</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($booking_query)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phoneno']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['roomtype']); ?></td>
                    <td><?php echo htmlspecialchars($row['checkin']); ?></td>
                    <td><?php echo htmlspecialchars($row['checkin_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['checkout']); ?></td>
                    <td><?php echo htmlspecialchars($row['checkout_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['noofroom']); ?></td>
                    <td><?php echo htmlspecialchars($row['totalprice']); ?></td>
                    <td>
                        <a href="mybooking.php?cancel_roomtype=<?php echo urlencode($row['roomtype']); ?>" 
                           onclick="return confirm('Are you sure you want to cancel this booking?');"
                           style="color:red; text-decoration:none;">Cancel</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p style="text-align:center; font-size:16px; color:#555;">You have no bookings yet.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>

<?php
mysqli_close($con);
?>
