<!DOCTYPE html>
<html lang="en">
<head>
    <title>Smart Laptop. Smart Shopping</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>

<form action="index.php?action=store" method="POST" enctype="multipart/form-data">
    <table border="1" align="center">

        <tr>
            <td colspan="2" align="center">
                <h1>LAPTOFY</h1>
            </td>
        </tr>

        <tr>
            <td>Enter Name</td>
            <td><input type="text" name="name" required></td>
        </tr>

        <tr>
            <td>Enter Description</td>
            <td><input type="text" name="description" required></td>
        </tr>

        <tr>
            <td>Select Image</td>
            <td><input type="file" name="image" required></td>
        </tr>

        <tr>
            <td>Enter Price</td>
            <td><input type="text" name="price" required></td>
        </tr>

        <tr>
            <td>Status</td>
            <td>
                <select name="status" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Insert">
                <a href="index.php?action=index">
                    <button type="button">Display</button>
                </a>
            </td>
        </tr>

    </table>
</form>

</body>
</html>