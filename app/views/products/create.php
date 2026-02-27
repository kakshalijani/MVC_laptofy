<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laptofy | Add New Laptop</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>

<div class="container">
    <form action="index.php?action=store" method="POST" enctype="multipart/form-data">
        <table align="center" border="1">
            <thead>
                <tr>
                    <th colspan="2" align="center">
                        <h1>LAPTOFY - ADD PRODUCT</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
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
                    <td><input type="file" name="img[]" multiple required></td>
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
                        <div class="btn-center">
                            <input type="submit" value="Insert">
                            <a href="index.php?action=index">
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