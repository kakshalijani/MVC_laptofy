<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Products</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>

<table border="1" align="center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
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
                <td><?= htmlspecialchars($row['id']); ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td>
                    <img src="../public/img/<?= htmlspecialchars($row['img']); ?>" width="100" alt="<?= htmlspecialchars($row['name']); ?>">
                </td>
                <td><?= htmlspecialchars($row['price']); ?></td>
                <td><?= htmlspecialchars($row['status']); ?></td>
                <td>
                    <a href="index.php?action=delete&id=<?= $row['id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this item?')">
                        Delete
                    </a>
                </td>
                <td>
                    <a href="index.php?action=edit&id=<?= $row['id']; ?>">
                        Update
                    </a>
                </td>
                <td>
                    <a href="index.php?action=show&id=<?= $row['id']; ?>">
                        View
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="9" align="center">No records found</td>
        </tr>
    <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9" align="center">
                <a href="index.php?action=create" class="my-button-style">Add New Product</a>
            </td>
        </tr>
    </tfoot>
</table>

</body>
</html>