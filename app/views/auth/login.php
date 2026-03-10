<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Login | Laptofy</title>
                    <link rel="stylesheet" href="css/login.css">
        </head>

    <body>

        <div class="login-wrapper">

            <form action="/laptofy_MVC/public/authenticate" method="POST">
                <table class="login-table" align="center">

                    <thead>
                        <tr>
                            <th colspan="2">
                                <h2>Admin Login</h2>
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
                            <td colspan="2" align="center">
                                <button type="submit">Login</button>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </form>

        </div>
    </body>
</html>