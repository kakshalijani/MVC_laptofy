<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Product Details</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>

<table border="1" align="center">
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
        <th>Image</th>
        <td>
            <?php if (!empty($product['image'])): ?>
                <img src="../uploads/<?= htmlspecialchars($product['image']); ?>"
                     width="120" height="120"
                     style="border-radius:8px;object-fit:cover;">
            <?php else: ?>
                No Image
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
            <a href="index.php?action=index">
                <button>Back</button>
            </a>
        </td>
    </tr>
</table>

</body>
</html>