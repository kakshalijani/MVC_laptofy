<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Product Details</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>

<table border="1" align="center" cellpadding="10">
    <tr>
        <th colspan="2" align="center">PRODUCT DETAILS</th>
    </tr>

    <tr>
        <th>Name</th>
        <td><?= htmlspecialchars($product['name']); ?></td>
    </tr>

    <tr>
        <th>Description</th>
        <td><?= htmlspecialchars($product['description']); ?></td>
    </tr>

    <tr>
        <th>Images</th>
        <td>
            <?php if (!empty($product['img'])): ?>
                <?php
                    $images = explode(',', $product['img']);
                    foreach ($images as $img):
                ?>
                    <img src="/laptofy_MVC/public/img/<?= htmlspecialchars($img); ?>"
                         width="120"
                         height="120"
                         style="border-radius:8px; object-fit:cover; margin-right:8px; border:1px solid #ccc;">
                <?php endforeach; ?>
            <?php else: ?>
                <em>No Image Available</em>
            <?php endif; ?>
        </td>
    </tr>

    <tr>
        <th>Price</th>
        <td><?= htmlspecialchars($product['price']); ?></td>
    </tr>

    <tr>
        <th>Status</th>
        <td><?= htmlspecialchars($product['status']); ?></td>
    </tr>

    <tr>
        <td colspan="2" align="center">
            <a href="/laptofy_MVC/public/index.php?controller=product&action=index">
                <button type="button">Back to Products</button>
            </a>
        </td>
    </tr>
</table>

</body>
</html>