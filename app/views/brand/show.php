<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Brand</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>

<table border="1" align="center" cellpadding="10" cellspacing="0">
    <tr>
        <th>Brand ID</th>
        <td><?= (int)$brand['brand_id']; ?></td>
    </tr>

    <tr>
        <th>Brand Name</th>
        <td><?= htmlspecialchars($brand['name'], ENT_QUOTES); ?></td>
    </tr>

    <tr>
        <th>Brand Images</th>
        <td>
            <?php if (!empty($brand['img'])): ?>
                <?php foreach (explode(',', $brand['img']) as $image): ?>
                    <img src="/laptofy_MVC/public/img/<?= htmlspecialchars($image, ENT_QUOTES); ?>"
                         width="100"
                         style="margin:6px; border:1px solid #ccc; padding:4px;">
                <?php endforeach; ?>
            <?php else: ?>
                <em>No image available</em>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <a href="/laptofy_MVC/public/index.php?controller=brand&action=index" class="btn-link">
                <button type="button">Back to Brand List</button>
            </a>
</table>

<br>
</body>
</html>