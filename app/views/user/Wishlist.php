<!DOCTYPE html>
<html>
<head>
    <title>My Wishlist</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/user.css">
</head>
<body>
<div class="page-container">

    <table align="center" width="800" border="1">

        <thead>
            <tr>
                <th colspan="5">
                    <h2>My Wishlist</h2>
                </th>
            </tr>
            
            <tr>
                <th colspan="5">
                    Total items: <?= $totalWishlist ?>
                </th>
            </tr>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Details</th>
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

                        <td align="center">
                            <form method="POST" action="/laptofy_MVC/public/wishlist-remove">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to remove this product from wishlist?')">
                                    Remove </button>
                            </form>
                        </td>

                    </tr>
                    
                <?php endwhile; ?>

            <?php else: ?>
                <tr>
                    <td colspan="5" align="center">
                        <p style="color:#fff; font-size:18px; padding:20px;">
                            Your wishlist is empty!
                        </p>
                    </td>
                </tr>
                
            <?php endif; ?>
                <tr>
                <th colspan="5" align="right">
                    <a href="/laptofy_MVC/public/home"><button type="button">Back to Products</button></a>
                    <a href="/laptofy_MVC/public/person-logout"><button type="button">Logout</button></a>
                </th>
            </tr>
        </tbody>

    </table>

</div>
</body>
</html>