<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Brand</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>
    <h2>View Brand Details</h2>
    <table border="1" align="center">
        <tr>
            <th>Brand ID</th>
            <td><?= $brand['brand_id']; ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?= htmlspecialchars($brand['name']); ?></td>
        </tr>
        
        <tr>
            <th>Image</th>
            <td><?php if (!empty($brand['img'])): ?>
                <?php 
                $images = explode(",", $brand['img']); 
                foreach($images as $image): 
                ?>
                    <img src="/laptofy_MVC/public/img/<?= htmlspecialchars($image); ?>" width="100" style="margin-right:5px;">
                <?php endforeach; ?>
            <?php else: ?>
                No image available.
            <?php endif; ?></td>
        </tr>
        

    </table>

    <a href="/laptofy_MVC/public/index.php?controller=brand&action=index">Back to Brands List</a>

</body>
</html>