<!DOCTYPE html>
<html>
<head>
    <title>Our Products</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/user.css">
</head>
<body>

<nav class="navbar">
    <div class="navbar-brand">
        <a href="/laptofy_MVC/public/home">🛒 Laptofy</a>
    </div>

    <div class="navbar-links">
        <a href="/laptofy_MVC/public/home">Home</a>
        <a href="/laptofy_MVC/public/about">About Us</a>

        <?php if(Person::check()): ?>
            <a href="/laptofy_MVC/public/wishlist">My Wishlist</a>
            <a href="/laptofy_MVC/public/cart">🛒 Cart</a> 
            <a href="/laptofy_MVC/public/person-profile">My Profile</a>
            <span class="navbar-name">Hi, <?= $_SESSION['Person']['fullname'] ?>!</span>
            <a href="/laptofy_MVC/public/person-logout" class="navbar-btn">Logout</a>
        <?php else: ?>
            <a href="/laptofy_MVC/public/person-login" class="navbar-btn">Login</a>
            <a href="/laptofy_MVC/public/person-register" class="navbar-btn">Register</a>
        <?php endif; ?>
    </div>
</nav>

<div class="page-container">

    <h2>All Products</h2>

    <input type="text" id="search" placeholder="Search product">

    <select id="brandFilter">
        <option value="">All Brands</option>
        <?php while($brand = $brands->fetch_assoc()): ?>
            <option value="<?= $brand['brand_id'] ?>"><?= $brand['name'] ?></option>
        <?php endwhile; ?>
    </select>

    <select id="priceFilter">
        <option value="">All Price</option>
        <option value="10000-20000">₹10,000 - ₹20,000</option>
        <option value="30000-40000">₹30,000 - ₹40,000</option>
        <option value="50000-60000">₹50,000 - ₹60,000</option>
        <option value="70000-80000">₹70,000 - ₹80,000</option>
        <option value="90000-100000">₹90,000 - ₹1,00,000</option>
    </select>

    <button id="searchBtn">Search</button>
    <a href="/laptofy_MVC/public/home"><button>Reset</button></a>

    <div id="productContainer">
        <?php while($product = $products->fetch_assoc()): ?>
            <?php $images = explode(',', $product['img']); ?>
            <div class="card">
                <div class="card-images">
                    <?php foreach($images as $img): ?>
                        <img src="/laptofy_MVC/public/img/product/<?= $img ?>" alt="<?= $product['name'] ?>">
                    <?php endforeach; ?>
                </div>
                <h3><?= $product['name'] ?></h3>
                <p>₹<?= $product['price'] ?></p>
                <a href="/laptofy_MVC/public/show/<?= $product['id'] ?>">View Details</a>

                <?php if(Person::check()): ?>

                    <form method="POST" action="/laptofy_MVC/public/wishlist-add">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <button type="submit">Wishlist</button>
                    </form>


                    <form method="POST" action="/laptofy_MVC/public/cart-add">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <button type="submit" class="cart-btn">Add to Cart</button>
                    </form>

                <?php else: ?>
                    <a href="/laptofy_MVC/public/person-login">
                        <button type="button">Login to Wishlist</button>
                    </a>
                    <a href="/laptofy_MVC/public/person-login">
                        <button type="button">Login to Cart</button>
                    </a>
                <?php endif; ?>

            </div>
        <?php endwhile; ?>
    </div>

    <div class="pagination" id="mainPagination" style="display:flex;">
        <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <a href="/laptofy_MVC/public/Home?page=<?= $i ?>"
               class="<?= $i == $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

</div>

<script src="/laptofy_MVC/public/js/product-filter.js"></script>

<footer class="footer">
    <div class="footer-container">

        <div class="footer-brand">
            <h3>🛒 Laptofy</h3>
            <p>Your one stop shop for the best laptops at the best prices.</p>
        </div>

        <div class="footer-links">
            <h4>Quick Links</h4>
            <a href="/laptofy_MVC/public/home">Home</a>
            <?php if(Person::check()): ?>
                <a href="/laptofy_MVC/public/wishlist">My Wishlist</a>
                <a href="/laptofy_MVC/public/cart">My Cart</a> 
                <a href="/laptofy_MVC/public/person-profile">My Profile</a>
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