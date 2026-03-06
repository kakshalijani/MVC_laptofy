<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand List</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>

<body>



<table border="1" align="center" cellpadding="8" cellspacing="0">

<thead>
<tr>
    <th>Name</th>
    <th>Images</th>
    <th>View</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>
</thead>

<tbody>

<?php if (!empty($brands)): ?>

    <?php foreach ($brands as $row): ?>

        <tr>

            <td>
                <?= htmlspecialchars($row['name']) ?>
            </td>

            <td>

                <?php if (!empty($row['img'])): ?>

                    <?php foreach (explode(',', $row['img']) as $image): ?>

                        <img 
                        src="/laptofy_MVC/public/img/brand/<?= htmlspecialchars(trim($image)) ?>" 
                        width="80"
                        style="margin:4px;border:1px solid #ccc;padding:3px;">

                    <?php endforeach; ?>

                <?php else: ?>

                    <em>No Image</em>

                <?php endif; ?>

            </td>

            <td>
                <a href="/laptofy_MVC/public/index.php?controller=brand&action=show&id=<?= (int)$row['brand_id'] ?>">
                    <button>View</button>
                </a>
            </td>

            <td>
                <a href="/laptofy_MVC/public/index.php?controller=brand&action=edit&id=<?= (int)$row['brand_id'] ?>">
                    <button>Edit</button>
                </a>
            </td>

            <td>
                <a href="/laptofy_MVC/public/index.php?controller=brand&action=delete&id=<?= (int)$row['brand_id'] ?>"
                onclick="return confirm('Are you sure you want to delete this brand?')">
                    <button>Delete</button>
                </a>
            </td>

        </tr>

    <?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="5" align="center">No brands found</td>
</tr>

<?php endif; ?>

</tbody>

<tfoot>

<tr>

<td colspan="5" align="center">

<a href="/laptofy_MVC/public/index.php?controller=brand&action=create">
<button>Add New Brand</button>
</a>

<a href="/laptofy_MVC/public/index.php?controller=product&action=index">
<button>View Products</button>
</a>

<a href="/laptofy_MVC/public/index.php?controller=dashboard&action=index">
<button>Dashboard</button>
</a>

</td>

</tr>

</tfoot>

</table>

</body>
</html>