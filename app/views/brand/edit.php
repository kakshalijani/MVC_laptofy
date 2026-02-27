<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Brand</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>
    <h2>Update Brand</h2>
    <form action="/laptofy_MVC/public/index.php?controller=brand&action=update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $brand['brand_id']; ?>">
        
        <label for="name">Brand Name:</label>
        <input type="text" id="name" name="name" value="<?= $brand['name']; ?>" required><br><br>

        <label for="img">Current Image:</label><br>
        <?php if (!empty($brand['img'])): ?>
            <?php 
            $images = explode(",", $brand['img']); 
            foreach($images as $image): 
            ?>
                <img src="/laptofy_MVC/public/img/<?= htmlspecialchars($image); ?>" width="100" style="margin-right:5px;">
            <?php endforeach; ?>
        <?php else: ?>
            No image available.
        <?php endif; ?><br><br>

        <label for="img">Change Image:</label>
        <input type="file" name="img[]" multiple><br><br>

        <button type="submit">Update Brand</button>
    </form>
</body>
</html>