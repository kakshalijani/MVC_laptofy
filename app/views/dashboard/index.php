<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/style.css">
</head>
<body>

<table border="0" align="center" cellpadding="10">
    <tr>
        <td align="center" colspan="2">
            <h1>Welcome to the Dashboard</h1>
            <p>Use the buttons below to manage your brands and products.</p>
        </td>
    </tr>

    <tr>
        <th colspan="2" style="text-align:center;">Add Data</th>
    </tr>

    <tr>
        <td>
            <a href="/laptofy_MVC/public/index.php?controller=brand&action=create">
                <button>Add Brand</button>
            </a>
        </td>
        <td>
            <a href="/laptofy_MVC/public/index.php?controller=product&action=create">
                <button>Add Product</button>
            </a>
        </td>
    </tr>

    <tr>
        <td colspan="2"><hr></td>
    </tr>

    <tr>
        <th colspan="2" style="text-align:center;">View Data</th>
    </tr>

    <tr>
        <td>
            <a href="/laptofy_MVC/public/index.php?controller=brand&action=index">
                <button>View Brands</button>
            </a>
        </td>
        <td>
            <a href="/laptofy_MVC/public/index.php?controller=product&action=index">
                <button>View Products</button>
            </a>
        </td>
    </tr>

</table>

</body>
</html>