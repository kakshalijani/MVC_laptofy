<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Login</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/user.css">
</head>
<body>
<div class="page-container">
        <form action="/laptofy_MVC/public/person-authenticate" method="POST"> 
            <table class="login-table" align="center" border="1">

            <thead>
                <tr>
                    <th colspan="2" align="center">
                        <h2>User Login</h2>
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email" required>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="cenetr">
                        <button type="submit">Login</button>
                    </td>

                </tr>
            </tbody>
            </table>
        </form>
        <table align="center" border="1" class="login-table">
            <tr>
                <td align="center" >
                    <a href="/laptofy_MVC/public/person-register">
                            <button>register</button>
                </td>
                <td align="center">
                        </a>
                        <a href="/laptofy_MVC/public/home"><button>Home</button></a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>