<!DOCTYPE html>
<html>
<head>
    <title>My Wishlist</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/wishlist.css">
</head>
<body>
<nav class="navbar">
    <div class="navbar-brand">
        <a href="/laptofy_MVC/public/home">🛒 Laptofy</a>
    </div>
    <div class="navbar-links">
        <a href="/laptofy_MVC/public/home">Home</a>
        <a href="/laptofy_MVC/public/about">About Us</a>
        <?php if(Person::check()): ?> <!-- ✅ fixed Person::check() -->
            <a href="/laptofy_MVC/public/wishlist">My Wishlist</a>
            <a href="/laptofy_MVC/public/cart">🛒 Cart</a> <!-- ✅ ADDED -->
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
    <table align="center" width="900" border="1">
        <thead>
            <tr>
                <th colspan="6">
                    <h2>My Wishlist</h2>
                </th>
            </tr>
            <tr>
                <th colspan="6">
                    Total items: <?= $totalWishlist ?>
                </th>
            </tr>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Details</th>
                <th>Cart</th> <!-- ✅ ADDED column -->
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if($wishlist->num_rows > 0): ?>
                <?php while($item = $wishlist->fetch_assoc()): ?>
                    <?php $images = explode(',', $item['img']); ?>
                    <tr>
                        <td align="center">
                            <?php foreach($images as $img): ?>
                                <img src="/laptofy_MVC/public/img/product/<?= htmlspecialchars($img) ?>"
                                     alt="<?= htmlspecialchars($item['name']) ?>"
                                     width="80" height="80"
                                     style="border-radius:8px; object-fit:cover; margin:2px;">
                            <?php endforeach; ?>
                        </td>

                        <td align="center">
                            <?= htmlspecialchars($item['name']) ?>
                        </td>

                        <td align="center">
                            ₹<?= htmlspecialchars($item['price']) ?>
                        </td>

                        <td align="center">
                            <a href="/laptofy_MVC/public/show/<?= $item['product_id'] ?>">
                                <button type="button">View Details</button>
                            </a>
                        </td>

                        <!-- ✅ ADDED - Cart button column -->
                        <td align="center">
                            <form method="POST" action="/laptofy_MVC/public/cart-add">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button type="submit" class="cart-btn">Add to Cart</button>
                            </form>
                        </td>

                        <td align="center">
                            <!-- ✅ FIXED - Remove button outside cart form -->
                            <form method="POST" action="/laptofy_MVC/public/wishlist-remove">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to remove this product from wishlist?')">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>

            <?php else: ?>
                <tr>
                    <td colspan="6" align="center">
                        <p style="color:#fff; font-size:18px; padding:20px;">
                            Your wishlist is empty!
                        </p>
                    </td>
                </tr>
            <?php endif; ?>

            <tr>
                <th colspan="6" align="right">
                    <a href="/laptofy_MVC/public/home">
                        <button type="button">Back to Products</button>
                    </a>
                    <a href="/laptofy_MVC/public/person-logout">
                        <button type="button">Logout</button>
                    </a>
                </th>
            </tr>
        </tbody>
    </table>
</div>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-brand">
            <h3>🛒 Laptofy</h3>
            <p>Your one stop shop for the best laptops at the best prices.</p>
        </div>
        <div class="footer-links">
            <h4>Quick Links</h4>
            <a href="/laptofy_MVC/public/home">Home</a>
            <?php if(Person::check()): ?> <!-- ✅ fixed -->
                <a href="/laptofy_MVC/public/wishlist">My Wishlist</a>
                <a href="/laptofy_MVC/public/cart">My Cart</a> <!-- ✅ ADDED -->
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