<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Brand</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>

<form action="/laptofy_MVC/public/index.php?controller=brand&action=update"
      method="POST"
      enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= (int)$brand['brand_id']; ?>">

    <table border="0" cellpadding="10" align="center">
        <tr>
            <th colspan="2" style="text-align:center;">Update Brand</th>
        </tr>

        <tr>
            <td>
                <label for="name">Brand Name</label>
            </td>
            <td>
                <input type="text"
                       id="name"
                       name="name"
                       value="<?= htmlspecialchars($brand['name'], ENT_QUOTES); ?>"
                       required>
            </td>
        </tr>

        <tr>
            <td valign="top">Current Images</td>
            <td>
                <?php if (!empty($brand['img'])): ?>
                    <?php foreach (explode(',', $brand['img']) as $image): ?>
                        <img src="/laptofy_MVC/public/img/brand/<?= htmlspecialchars($image, ENT_QUOTES); ?>"
                             width="100"
                             style="margin:5px; border:1px solid #ccc; padding:4px;">
                            <label style="font-size:12px;">
                                <input type="checkbox" name="delete_img[]" value="<?= htmlspecialchars($image, ENT_QUOTES); ?>">
                                Delete
                            </label>
                    <?php endforeach; ?>
                <?php else: ?>
                    <em>No image available</em>
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <td>
                <label for="img">Change Images</label>
            </td>
            <td>
                <input type="file"
                       name="img[]"
                       multiple
                       accept="image/*">
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <button type="submit">Update Brand</button>
                <a href="/laptofy_MVC/public/index.php?controller=brand&action=index"
                   class="btn-link">
                    Back to List
                </a>
            </td>
        </tr>
    </table>

</form>

</body>
</html>