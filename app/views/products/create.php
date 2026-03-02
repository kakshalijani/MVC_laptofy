<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptofy | Add New Laptop</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>

<div class="container">

    <form action="/laptofy_MVC/public/index.php?controller=product&action=store"
          method="POST"
          enctype="multipart/form-data">

        <table align="center" border="1" cellpadding="10">
            <thead>
                <tr>
                    <th colspan="2" align="center">
                        <h1>LAPTOFY – ADD PRODUCT</h1>
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><label for="name">Product Name</label></td>
                    <td>
                        <input type="text" id="name" name="name" required>
                    </td>
                </tr>

                <tr>
                    <td><label for="description">Description</label></td>
                    <td>
                        <textarea id="description" name="description" rows="3" required></textarea>
                    </td>
                </tr>

                <tr>
                    <td><label for="img">Product Image</label></td>
                    <td>
                        <input type="file" id="img" name="img[]" multiple required>
                    </td>
                </tr>

                <tr>
                    <td><label for="price">Price</label></td>
                    <td>
                        <input type="number" id="price" name="price" step="0.01" required>
                    </td>
                </tr>

                <tr>
                    <td><label for="status">Status</label></td>
                    <td>
                        <select id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label for="brand_id">Brand</label></td>
                    <td>
                        <select id="brand_id" name="brand_id" required>
                            <option value="">Select Brand</option>
                            <?php foreach ($brands as $brand): ?>
                                <option value="<?= (int)$brand['brand_id']; ?>">
                                    <?= htmlspecialchars($brand['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <div class="btn-center">
                            <input type="submit" value="Insert">
                            <a href="/laptofy_MVC/public/index.php?controller=product&action=index">
                                <button type="button">Display List</button>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </form>

</div>

</body>
</html>