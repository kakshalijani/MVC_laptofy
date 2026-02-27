<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Brand</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>
    <h2>Create New Brand</h2>
    <form action="/laptofy_MVC/public/index.php?controller=brand&action=store" method="POST" enctype="multipart/form-data">
        <label for="name">Brand Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="img">Image:</label>
        <input type="file" name="img[]" multiple><br><br>

        <button type="submit">Create Brand</button>
    </form>
</body>
</html>