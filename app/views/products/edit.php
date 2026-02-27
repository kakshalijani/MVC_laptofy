<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Record</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>

<body>

    <form action="/laptofy_MV/public/index.php?controller=product&action=update" method="POST" enctype="multipart/form-data">
        <table border="1" align="center">

            <tr>
                <td colspan="2" align="center">
                    <h1>Update Record</h1>
                </td>
            </tr>

            <!-- ID (readonly) -->
            

            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="name" value="<?= $product['name']; ?>" required>
                </td>
            </tr>

            <tr>
                <td>Description</td>
                <td>
                    <input type="text" name="description" value="<?= $product['description']; ?>" required>
                </td>
            </tr>

            <tr>
                <td>Current Image</td>
                <td>
                    <img src="/laptofy_MVC/public/img/<?= $product['img']; ?>" width="100">
                </td>
            </tr>

            <tr>
                <td>Change Image</td>
                <td>
                    <input type="file" name="img">
                </td>
            </tr>

            <tr>
                <td>Price</td>
                <td>
                    <input type="text" name="price" value="<?= $product['price']; ?>" required>
                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                    <select name="status" required>
                        <option value="active" <?= ($product['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?= ($product['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </td>
            </tr>
            <tr>
    <td>Brand</td>
    <td>
        <select name="brand_id" required>
            <?php while ($brand = mysqli_fetch_assoc($brands)): ?>
                <option value="<?= $brand['brand_id']; ?>"
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
                    <a href="index.php?action=index">
                        <button type="button">Display</button>
                    </a>
                </td>
            </tr>

        </table>
    </form>

</body>

</html>