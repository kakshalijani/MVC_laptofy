<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>

<body>

<form action="/laptofy_MVC/public/index.php?controller=product&action=update"
      method="POST"
      enctype="multipart/form-data">

    <!-- Hidden Product ID -->
    <input type="hidden" name="id" value="<?= (int)$product['id']; ?>">

    <table border="1" align="center" cellpadding="10">

        <tr>
            <th colspan="2" align="center">
                <h1>Update Product</h1>
            </th>
        </tr>

        <tr>
            <td><label for="name">Name</label></td>
            <td>
                <input type="text" id="name" name="name"
                       value="<?= htmlspecialchars($product['name']); ?>" required>
            </td>
        </tr>

        <tr>
            <td><label for="description">Description</label></td>
            <td>
                <textarea id="description" name="description" rows="3" required><?= htmlspecialchars($product['description']); ?></textarea>
            </td>
        </tr>

        <tr>
            <td>Current Image</td>
            <td>
                <?php if (!empty($product['img'])): ?>
                    <?php foreach (explode(',', $product['img']) as $image): ?>
                        <img src="/laptofy_MVC/public/img/product/<?= htmlspecialchars($image); ?>"
                             width="100"
                             style="margin-right:8px; border:1px solid #ccc; padding:4px;">
                             <label style="font-size:12px;">
                                <input type="checkbox" name="delete_img[]" value="<?= htmlspecialchars($image); ?>">
                                Delete
                             </label>
                    <?php endforeach; ?>
                <?php else: ?>
                    <em>No image available</em>
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <td><label for="img">Change Image</label></td>
            <td>
                <input type="file" id="img" name="img[]" multiple>
            </td>
        </tr>

        <tr>
            <td><label for="price">Price</label></td>
            <td>
                <input type="number" id="price" name="price"
                       step="0.01"
                       value="<?= htmlspecialchars($product['price']); ?>" required>
            </td>
        </tr>

        <tr>
            <td><label for="status">Status</label></td>
            <td>
                <select id="status" name="status" required>
                    <option value="active" <?= ($product['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?= ($product['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </td>
        </tr>

        <tr>
            <td><label for="brand_id">Brand</label></td>
            <td>
                <select id="brand_id" name="brand_id" required>
                    <?php while ($brand = mysqli_fetch_assoc($brands)): ?>
                        <option value="<?= (int)$brand['brand_id']; ?>"
                            <?= ($brand['brand_id'] == $product['brand_id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($brand['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Update">
                <a href="/laptofy_MVC/public/index.php?controller=product&action=index">
                    <button type="button">Back to List</button>
                </a>
            </td>
        </tr>

    </table>

</form>

</body>
</html>