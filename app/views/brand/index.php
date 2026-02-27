<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand List</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>
    <h2>Brand List</h2>
    <a href="/laptofy_MVC/public/index.php?controller=brand&action=create">Create New Brand</a><br><br>
    <table border="1" align="center">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($brand) && mysqli_num_rows($brand) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($brand)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?php if (!empty($row['img'])): ?>
                            <?php 
                            $images = explode(",", $row['img']); 
                            foreach($images as $image): 
                            ?>
                                <img src="/laptofy_MVC/public/img/<?= htmlspecialchars($image); ?>" width="100" style="margin-right:5px;">
                            <?php endforeach; ?>
                        <?php else: ?>
                            No image available.
                        <?php endif; ?></td>
                        <td>
                            <a href="/laptofy_MVC/brand/view?id=<?= $row['brand_id']; ?>">View</a> |
                            <a href="/laptofy_MVC/brand/update?id=<?= $row['brand_id']; ?>">Edit</a> |
                            <a href="/laptofy_MVC/brand/delete?id=<?= $row['brand_id']; ?>"
                               onclick="return confirm('Are you sure you want to delete this brand?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No brands found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>