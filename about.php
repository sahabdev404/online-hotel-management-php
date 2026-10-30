<?php include 'header.php'; ?>

<section style="min-height:calc(100vh - 80px); 
                max-width:1000px; 
                margin:0 auto 0; 
                padding:20px 30px 0; 
                background:#fff; 
                border-radius:10px; 
                box-shadow:0 4px 20px rgba(0,0,0,0.1); 
                display:flex; 
                flex-wrap:wrap; 
                gap:40px; 
                align-items:flex-start; 
                justify-content:space-between;
                box-sizing:border-box;">

    <!-- Left column: About + Location -->
    <div style="flex:1 1 500px; min-width:300px;">
        <h1 style="color:#4a80f5; margin-bottom:20px;">About Sahab Hotel</h1>
        <p style="line-height:1.6;">
            Welcome to <strong>Sahab Online Hotel</strong>! We provide top-class hospitality with modern amenities and comfortable rooms. 
            Our goal is to make your stay memorable and enjoyable.
        </p>

        <h2 style="margin-top:25px; color:#333;">Location</h2>
        <p style="line-height:1.6;">
            Our hotel is located in the heart of the city, easily accessible from all major landmarks.<br>
            <strong>Address:</strong> 123 Main Street, City Name, Country.
        </p>
    </div>

    <!-- Right column: Contact Form -->
    <div style="flex:1 1 400px; min-width:300px; display:flex; flex-direction:column; gap:20px; margin-top:0;">
        <form method="POST" action="contact_process.php" style="display:flex; flex-direction:column; gap:12px; background:#f4f4f4; padding:20px; border-radius:8px; box-sizing:border-box;">
            <h2 style="margin:0 0 10px 0; color:#333;">Contact Us</h2>
            <input type="text" name="name" placeholder="Your Name" required style="width:100%; padding:12px; border-radius:6px; border:1px solid #ccc; box-sizing:border-box;">
            <input type="email" name="email" placeholder="Your Email" required style="width:100%; padding:12px; border-radius:6px; border:1px solid #ccc; box-sizing:border-box;">
            <textarea name="message" placeholder="Your Message" required rows="5" style="width:100%; padding:12px; border-radius:6px; border:1px solid #ccc; box-sizing:border-box;"></textarea>
            <button type="submit" style="padding:12px 20px; background:#4a80f5; color:white; border:none; border-radius:6px; cursor:pointer; font-size:16px;">Send Message</button>
        </form>
    </div>

</section>

<?php include 'footer.php'; ?>
