<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Products</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>

<table border="1" align="center" cellpadding="8">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Images</th>
            <th>Price</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Update</th>
            <th>View</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($products) && mysqli_num_rows($products) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($products)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>

                    <td>
                        <?php if (!empty($row['img'])): ?>
                            <?php
                                $images = explode(",", $row['img']);
                                foreach ($images as $image):
                            ?>
                                <img src="/laptofy_MVC/public/img/<?= htmlspecialchars($image); ?>"
                                     width="60"
                                     style="margin-right:6px; border:1px solid #ccc; padding:3px;">
                            <?php endforeach; ?>
                        <?php else: ?>
                            <em>No image</em>
                        <?php endif; ?>
                    </td>

                    <td><?= htmlspecialchars($row['price']); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                    

                    <td>
                        <a href="/laptofy_MVC/public/index.php?controller=product&action=delete&id=<?= (int)$row['id']; ?>"
                           onclick="return confirm('Are you sure you want to delete this product?')">
                           <button type="button">Delete</button>
                        </a>
                    </td>

                    <td>
                        <a href="/laptofy_MVC/public/index.php?controller=product&action=edit&id=<?= (int)$row['id']; ?>">
                            <button type="button">Edit</button>

                        </a>
                    </td>

                    <td>
                        <a href="/laptofy_MVC/public/index.php?controller=product&action=show&id=<?= (int)$row['id']; ?>">
                           <button type="button">View</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="9" align="center">No products found</td>
            </tr>
        <?php endif; ?>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="9" align="center">
                <a href="/laptofy_MVC/public/index.php?controller=product&action=create">
                    <button type="button">Add New Product</button>
                </a>

                <a href="/laptofy_MVC/public/index.php?controller=brand&action=index">
                    <button type="button">View Brands</button>
                </a>

                <a href="/laptofy_MVC/public/index.php?controller=dashboard&action=index">
                    <button type="button">Go to Dashboard</button>
                </a>
            </td>
        </tr>
    </tfoot>
</table>

</body>
</html>