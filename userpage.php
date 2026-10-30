<?php include 'header.php'; ?>

<h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
<p>This is your dashboard. You can manage your bookings and explore hotel services.</p>

<div class="room-cards">
    <!-- Non-AC Room Card -->
    <div class="card">
        <img src="images/nonac.jpg" alt="Non-AC Room">
        <h3>Non-AC Room</h3>
    </div>

    <!-- AC Room Card -->
    <div class="card">
        <img src="images/ac1.jpg" alt="AC Room">
        <h3>AC Room</h3>
    </div>
</div>

<style>
.room-cards {
    display: flex;
    gap: 20px;
    margin-top: 20px;
    justify-content: center;
}

.card {
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    width: 450px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.card h3 {
    margin: 10px 0;
    font-size: 18px;
    color: #333;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
</style>

<?php include 'footer.php'; ?>
