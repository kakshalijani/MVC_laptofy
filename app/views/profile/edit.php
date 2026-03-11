<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Profile</title>
            <link rel="stylesheet" href="/laptofy_MVC/css/edit.css">
    </head>

<body>
    <div class="container">
        <?php $pageTitle = "Edit Profile"; ?>
        <h2>Edit Profile</h2>

    <form action="/laptofy_MVC/public/profileupdate" method="POST" enctype="multipart/form-data">
    <table border="0" align="center" cellpadding="10">
        <tr>
            <td><label>First Name</label></td>
            <td>
                <input type="text" name="first_name" value="<?php echo $_SESSION['user']['first_name']; ?>" required>
            </td>
        </tr>

        <tr>
            <td><label>Last Name</label></td>
            <td>
                <input type="text" name="last_name" value="<?php echo $_SESSION['user']['last_name']; ?>" required>
            </td>
        </tr>

        <tr>
            <td><label>Email</label></td>
            <td>
                <input type="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>" required>
            </td>
        </tr>
        <tr>
            <td><lable>old password</lable></td>
            <td>
                <input type="password" name="old_password">
            </td>
        </tr>    
        <tr>
            <td><label>New Password</label></td>
            <td>
                <input type="password" name="new_password">
            </td>
        </tr>

        <tr>
            <td><label>Current Profile Image</label></td>
            <td>
                <img src="/laptofy_MVC/public/uploads/<?php echo $_SESSION['user']['profile'] ?? 'default.JPG'; ?>" width="80">
            </td>
        </tr>

        <tr>
            <td><label>Upload New Image</label></td>
            <td>
                <input type="file" name="profile">
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
            <button type="submit">Update Profile</button>
                <a href="/laptofy_MVC/public/dashboard">
                <button type="button">Go to Dashboard</button>
                </a>
            </td>
        </tr>

    </table>

</form>

</div>

</body>
</html>