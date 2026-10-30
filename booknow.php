<?php
// Include header.php which starts session and checks login
include 'header.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name        = $_POST['name'];
    $phoneno     = $_POST['phoneno'];
    $email       = $_POST['email'];
    $checkin     = $_POST['checkin'];
    $checkin_time= $_POST['checkin_time'];
    $checkout    = $_POST['checkout'];
    $checkout_time= $_POST['checkout_time'];
    $roomtype    = $_POST['roomtype'];
    $noofroom    = $_POST['noofroom'];
    $totalprice  = $_POST['totalprice'];

    $con = mysqli_connect("localhost", "root", "", "sahabhotel");
    if (!$con) {
        die("<script>alert('Database Connection Failed');</script>");
    }

    $sql = "INSERT INTO book (name, phoneno, email, checkin, checkin_time, checkout, checkout_time, roomtype, noofroom, totalprice) VALUES (
        '$name','$phoneno','$email','$checkin','$checkin_time','$checkout','$checkout_time','$roomtype','$noofroom','$totalprice'
    )";

    $res = mysqli_query($con, $sql);

    if ($res) {
        echo "<script>
                alert('Booking Successfully Saved!');
                window.location.href = window.location.pathname;
              </script>";
    } else {
        echo "<script>alert('Error: Booking Not Saved');</script>";
    }

    mysqli_close($con);
}
?>

<div class="book-form">
    <h2>Book a Room</h2>

    <form method="POST">
        <div class="form-row">
            <!-- LEFT COLUMN: 5 fields -->
            <div class="form-col">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($username); ?>" required>

                <label>Phone No:</label>
                <input type="text" name="phoneno" value="<?php echo htmlspecialchars($phone); ?>" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Room Type:</label>
                <select name="roomtype" id="roomtype" onchange="calculatePrice()">
                    <option value="Non AC">Non AC</option>
                    <option value="AC">AC</option>
                </select>

                <label>Check-in Date:</label>
                <input type="date" name="checkin" required>
            </div>

            <!-- RIGHT COLUMN: 5 fields -->
            <div class="form-col">
                <label>Check-in Time:</label>
                <input type="time" name="checkin_time">

                <label>Checkout Date:</label>
                <input type="date" name="checkout" required>

                <label>Checkout Time:</label>
                <input type="time" name="checkout_time">

                <label>Number of Rooms:</label>
                <input type="number" id="noofroom" name="noofroom" min="1" onkeyup="calculatePrice()" onchange="calculatePrice()" required>

                <label>Total Price:</label>
                <input type="text" id="totalprice" name="totalprice" readonly>
            </div>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-save">SAVE BOOKING</button>
            <button type="reset" class="btn-clear">CLEAR</button>
        </div>
    </form>
</div>

<style>
.book-form {
    max-width: 900px;
    margin: 30px auto;
    padding: 25px;
    background:#fff;
    border-radius:10px;
    box-shadow:0 0 12px rgba(0,0,0,0.2);
}
.book-form h2 {
    text-align:center;
    margin-bottom:20px;
}
.form-row {
    display:flex;
    gap:40px;
    flex-wrap:wrap;
}
.form-col {
    flex:1 1 45%;
    display:flex;
    flex-direction:column;
}
.form-col label {
    margin-top:10px;
    font-weight:bold;
}
.form-col input, .form-col select {
    padding:10px;
    margin-top:5px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:14px;
}
.form-buttons {
    display:flex;
    justify-content:center;
    gap:20px;
    margin-top:25px;
}
.btn-save {
    padding:12px 25px;
    border:none;
    border-radius:5px;
    font-size:15px;
    background:#28a745;
    color:white;
    cursor:pointer;
}
.btn-save:hover { background:#218838; }
.btn-clear {
    padding:12px 25px;
    border:none;
    border-radius:5px;
    font-size:15px;
    background:#6c757d;
    color:white;
    cursor:pointer;
}
.btn-clear:hover { background:#5a6268; }

/* Responsive: stack on smaller screens */
@media screen and (max-width:768px){
    .form-row {
        flex-direction:column;
    }
    .form-col {
        width:100%;
    }
}
</style>

<script>
function calculatePrice() {
    var roomType = document.getElementById("roomtype").value;
    var numRooms = document.getElementById("noofroom").value;
    var price = (roomType == "AC") ? 2000 : 1500;
    var total = price * numRooms;
    document.getElementById("totalprice").value = total;
}
</script>

<?php include 'footer.php'; ?>
