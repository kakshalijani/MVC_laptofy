<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Laptofy</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/about.css">
</head>
<body>

<nav class="navbar">
    <div class="navbar-brand">
        <a href="/laptofy_MVC/public/home">🛒 Laptofy</a>
    </div>
    <div class="navbar-links">
        <a href="/laptofy_MVC/public/home">Home</a>
        <a href="/laptofy_MVC/public/about" class="active">About Us</a>
        <?php if(Person::check()): ?>
            <a href="/laptofy_MVC/public/wishlist">My Wishlist</a>
            <a href="/laptofy_MVC/public/person-profile">My Profile</a>
            <a href="/laptofy_MVC/public/person-logout" class="navbar-btn">Logout</a>
        <?php else: ?>
            <a href="/laptofy_MVC/public/person-login" class="navbar-btn">Login</a>
            <a href="/laptofy_MVC/public/person-register" class="navbar-btn">Register</a>
        <?php endif; ?>
    </div>
</nav>

<section class="hero">
    <div class="hero-content">
        <h1>About <span class="highlight">Laptofy</span></h1>
        <p>Your trusted destination for premium laptops and computing solutions since 2020.</p>
    </div>
</section>

<section class="section">
    <div class="section-container">
        <div class="section-badge">Our Story</div>
        <h2>How We Started</h2>
        <p>Laptofy was founded in 2020 with a simple mission — to make premium laptops accessible to everyone. What started as a small shop in Bhavnager, Gujarat has grown into one of India's most trusted laptop retailers. We believe technology should empower people, not overwhelm them.</p>
        <p>Today we serve thousands of customers across India, offering the best brands at the most competitive prices with unmatched customer support.</p>
    </div>
</section>

<section class="section alt">
    <div class="section-container">
        <div class="section-badge">Why Us</div>
        <h2>Why Choose Laptofy?</h2>
        <div class="cards-grid">
            <div class="feature-card">
                <div class="feature-icon">🏆</div>
                <h3>Best Prices</h3>
                <p>We offer the most competitive prices in the market with no hidden charges or fees.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">✅</div>
                <h3>Genuine Products</h3>
                <p>Every laptop we sell is 100% genuine with full manufacturer warranty included.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🚚</div>
                <h3>Fast Delivery</h3>
                <p>Get your laptop delivered to your doorstep within 2-3 business days anywhere in India.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🛠️</div>
                <h3>After Sales Support</h3>
                <p>Our expert team is available 7 days a week to help you with any issues or queries.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="section-container">
        <div class="section-badge">Our Values</div>
        <h2>What We Stand For</h2>
        <div class="values-grid">
            <div class="value-item">
                <span class="value-icon">💡</span>
                <h3>Innovation</h3>
                <p>We stay ahead of technology trends to bring you the latest and greatest laptops.</p>
            </div>
            <div class="value-item">
                <span class="value-icon">🤝</span>
                <h3>Trust</h3>
                <p>We build long-term relationships with our customers based on honesty and transparency.</p>
            </div>
            <div class="value-item">
                <span class="value-icon">🌟</span>
                <h3>Excellence</h3>
                <p>We never compromise on quality — from the products we sell to the service we provide.</p>
            </div>
            <div class="value-item">
                <span class="value-icon">🌍</span>
                <h3>Community</h3>
                <p>We are proud to serve and give back to the communities we operate in across India.</p>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="section-container">
        <div class="section-badge">Get In Touch</div>
        <h2>Contact Us</h2>
        <div class="contact-grid">
            <div class="contact-item">
                <span class="contact-icon">📧</span>
                <h3>Email</h3>
                <p>support@laptofy.com</p>
            </div>
            <div class="contact-item">
                <span class="contact-icon">📞</span>
                <h3>Phone</h3>
                <p>+91 98765 43210</p>
            </div>
            <div class="contact-item">
                <span class="contact-icon">📍</span>
                <h3>Address</h3>
                <p>Bhavnager, Gujarat, India</p>
            </div>
            <div class="contact-item">
                <span class="contact-icon">🕐</span>
                <h3>Working Hours</h3>
                <p>Mon - Sat: 9AM - 8PM</p>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-brand">
            <h3>🛒 Laptofy</h3>
            <p>Your one stop shop for the best laptops at the best prices.</p>
        </div>
        <div class="footer-links">
            <h4>Quick Links</h4>
            <a href="/laptofy_MVC/public/home">Home</a>
            <a href="/laptofy_MVC/public/about">About Us</a>
            <?php if(Person::check()): ?>
                <a href="/laptofy_MVC/public/wishlist">My Wishlist</a>
                <a href="/laptofy_MVC/public/person-logout">Logout</a>
            <?php else: ?>
                <a href="/laptofy_MVC/public/person-login">Login</a>
                <a href="/laptofy_MVC/public/person-register">Register</a>
            <?php endif; ?>
        </div>
        <div class="footer-contact">
            <h4>Contact Us</h4>
            <p>📧 support@laptofy.com</p>
            <p>📞 +91 98765 43210</p>
            <p>📍 Bhavnager, Gujarat, India</p>
        </div>
        <div class="footer-social">
            <h4>Follow Us</h4>
            <div class="social-links">
                <a href="#" title="Facebook">FB</a>
                <a href="#" title="Instagram">IG</a>
                <a href="#" title="Twitter">TW</a>
                <a href="#" title="YouTube">YT</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© <?= date('Y') ?> Laptofy. All rights reserved.</p>
    </div>
</footer>

</body>
</html>