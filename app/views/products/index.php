<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Products</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>

<table border="1" align="center">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
            <th>Status</th>
            <th>Brand</th>
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
                    <?php 
                    $img= explode(",", $row['img']); 
                    foreach($img as $imges): 
                    ?>
                        <img src="/laptofy_MVC/public/img/<?= htmlspecialchars($imges); ?>" width="50" style="margin-right:5px;">
                    <?php endforeach; ?>
                </td>
                <td><?= htmlspecialchars($row['price']); ?></td>
                <td><?= htmlspecialchars($row['status']); ?></td>
              
                    <td><?php echo $row['brand_id']; ?></td>
                      <td>
                    <a href="index.php?action=delete&id=<?= $row['id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this item?')">
                        Delete
                    </a>
                </td>
                <td>
                    <a href="edit.php?action=edit&id=<?= $row['id']; ?>">
                        Update
                    </a>
                </td>
                <td>
                    <a href="show.php?action=show&id=<?= $row['id']; ?>">
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
                <a href="create.php?action=create">
                    <button type="button">Add New Product</button>
                </a>            </td>
        </tr>
    </tfoot>
</table>

</body>
</html>