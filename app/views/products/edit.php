<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Record</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>

<body>

    <form action="index.php?action=update" method="POST" enctype="multipart/form-data">
        <table border="1" align="center">

            <tr>
                <td colspan="2" align="center">
                    <h1>Update Record</h1>
                </td>
            </tr>

            <!-- ID (readonly) -->
            <tr>
                <td>ID</td>
                <td>
                    <input type="text" name="id" value="<?= $product['id']; ?>" readonly>
                </td>
            </tr>

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
                        <option value="Active" <?= ($product['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                        <option value="Inactive" <?= ($product['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
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