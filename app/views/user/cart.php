<!DOCTYPE html>
<html>
<head>
    <title>My Cart - Laptofy</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/user.css">
</head>
<body>

<nav class="navbar">
    <div class="navbar-brand">
        <a href="/laptofy_MVC/public/home">🛒 Laptofy</a>
    </div>
    <div class="navbar-links">
        <a href="/laptofy_MVC/public/home">Home</a>
        <a href="/laptofy_MVC/public/wishlist">My Wishlist</a>
        <a href="/laptofy_MVC/public/cart">🛒 Cart (<?= $totalItems ?>)</a>
        <a href="/laptofy_MVC/public/person-profile">My Profile</a>
        <a href="/laptofy_MVC/public/person-logout" class="navbar-btn">Logout</a>
    </div>
</nav>

<div class="page-container">
    <table align="center" width="900">
        <thead>
            <tr>
                <th colspan="7"><h2>My Cart</h2></th>
            </tr>
            <tr>
                <th colspan="7">Total Items: <?= $totalItems ?></th>
            </tr>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($cartItems->num_rows > 0): ?>
                <?php while($item = $cartItems->fetch_assoc()): ?>
                    <?php $images = explode(',', $item['img']); ?>
                    <tr>
                        <td align="center">
                            <img src="/laptofy_MVC/public/img/product/<?= htmlspecialchars($images[0]) ?>"
                                 width="80" height="80"
                                 style="border-radius:8px; object-fit:cover;">
                        </td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>₹<?= htmlspecialchars($item['price']) ?></td>
                        <td align="center">

                        <form method="POST" action="/laptofy_MVC/public/cart-decrease" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button type="submit" class="qty-btn">−</button>
                            </form>

                            <span class="qty-count"><?= $item['quantity'] ?></span>


                            <form method="POST" action="/laptofy_MVC/public/cart-increase" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button type="submit" class="qty-btn">+</button>
                            </form>
                        </td>
                        <td>₹<?= number_format($item['subtotal'], 2) ?></td>
                        <td>
                            <form method="POST" action="/laptofy_MVC/public/cart-remove">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button type="submit" class="btn-delete"
                                        onclick="return confirm('Remove this item?')">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="4" align="right"><strong>Total:</strong></td>
                    <td><strong>₹<?= number_format($totalPrice, 2) ?></strong></td>
                    <td></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="6" align="center">
                        <p style="color:#fff; padding:20px; font-size:18px;">
                            Your cart is empty!
                            <a href="/laptofy_MVC/public/home" style="color:#06b6d4;">Shop Now</a>
                        </p>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>