<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/laptofy_MVC/public/css/layout.css">
</head>

<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>

        <a href="/laptofy_MVC/dashboard">Dashboard</a>
        <a href="/laptofy_MVC/addproduct">Add Product</a>
        <a href="/laptofy_MVC/addbrand">Add Brand</a>
        <a href="/laptofy_MVC/logout">Logout</a>
    </div>

    <div class="main">

        <div class="topbar">

            <div class="profile-menu">
                <img
                    src="/laptofy_MVC/public/uploads/<?php echo htmlspecialchars($_SESSION['user']['profile'] ?? 'default.jpg', ENT_QUOTES); ?>"
                    alt="Profile"
                    class="profile-icon"
                    onclick="toggleMenu()">

                <div id="dropdown" class="dropdown">
                    <a href="/laptofy_MVC/profile">Edit Profile</a>
                    <a href="/laptofy_MVC/logout">Logout</a>
                </div>
            </div>

        </div>

        <div class="content">

            <?php
            if (isset($view)) {
                require $view;
            }
            ?>

        </div>

    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById("dropdown");
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }

        document.addEventListener('click', function(event) {
            var menu = document.getElementById("dropdown");
            var icon = document.querySelector('.profile-icon');
            if (menu && icon && !icon.contains(event.target) && !menu.contains(event.target)) {
                menu.style.display = "none";
            }
        });
    </script>

</body>
</html>