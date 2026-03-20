<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/person-profile.css">
</head>
<body>
<div class="page-container">

    <form action="/laptofy_MVC/public/person-profile-update" method="POST">
        <table class="register-table" align="center">
            <thead>
                <tr>
                    <th colspan="2">
                        <h2>My Profile</h2>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="fullname"
                               value="<?= htmlspecialchars($person['fullname']) ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email"
                               value="<?= htmlspecialchars($person['email']) ?>" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">Update Profile</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <br>
    <form action="/laptofy_MVC/public/person-change-password" method="POST">
        <table class="register-table" align="center">
            <thead>
                <tr>
                    <th colspan="2">
                        <h2>Change Password</h2>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Old Password</td>
                    <td>
                        <input type="password" name="old_password"
                               placeholder="Enter old password" required>
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password"
                               placeholder="Enter new password" required>
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password"
                               placeholder="Confirm new password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">Change Password</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <table align="center">
        <tr>
            <td align="center">
                <a href="/laptofy_MVC/public/home">
                    <button type="button">Back to Home</button>
                </a>
                <a href="/laptofy_MVC/public/wishlist">
                    <button type="button">My Wishlist</button>
                </a>
                <a href="/laptofy_MVC/public/person-logout">
                    <button type="button">Logout</button>
                </a>
            </td>
        </tr>
    </table>

</div>
</body>
</html>