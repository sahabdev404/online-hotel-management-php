<?php
session_start();
session_destroy();
?>

<script>
    alert("Logged Out!"); // Popup message
    window.location.href = "index.html"; // Redirect
</script>
