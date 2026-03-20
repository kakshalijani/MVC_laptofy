<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>person-register</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/person-profile.css">
</head>
<body>
    <div class="page-container">
        <form action="/laptofy_MVC/public/person-register-store" method="POST">
            <table class="register-table" align="center">
                <thead>
                    <tr>
                        <th colspan="2">
                            <h2>person registation</h2>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="fullname" required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" required></td>
                
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="confirm_password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button type="submit">Register</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <table align="center" class="register-table">
            <tr>
                <td align="center">
                    <a href="/laptofy_MVC/public/person-login">
                        <button>login</button>
                    <a href="/laptofy_MVC/public/home"><button>Home</button></a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>