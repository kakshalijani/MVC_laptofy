<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Brand</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>

<form action="/laptofy_MVC/public/index.php?controller=brand&action=store"
      method="POST"
      enctype="multipart/form-data">

    <table border="0" cellpadding="10" align="center">
        <tr>
            <th colspan="2" style="text-align:center;">Create New Brand</th>
        </tr>

        <tr>
            <td>
                <label for="name">Brand Name</label>
            </td>
            <td>
                <input type="text"
                       id="name"
                       name="name"
                       required
                       placeholder="Enter brand name">
            </td>
        </tr>

        <tr>
            <td>
                <label for="img">Brand Images</label>
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
                <div class="btn-center">
                    <button type="submit">Insert</button>

                    <a href="/laptofy_MVC/public/index.php?controller=brand&action=index"
                       class="btn-link">
                       <button type="button">Display List</button>
                    </a>
                </div>
            </td>
        </tr>
    </table>

</form>

</body>
</html>