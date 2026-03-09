<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
<link rel="stylesheet" href="/laptofy_MVC/css/layout.css">
</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

<h2>Admin Panel</h2>

<a href="index.php?controller=dashboard&action=index">Dashboard</a>

<a href="index.php?controller=product&action=create">Add Product</a>

<a href="index.php?controller=brand&action=create">Add Brand</a>

<a href="index.php?controller=auth&action=logout">Logout</a>

</div>


<!-- Main Area -->

<div class="main">

<!-- Topbar -->

<div class="topbar">

<div class="profile-menu">

<img src="/laptofy_MVC/public/uploads/<?php echo $_SESSION['user']['profile'] ?? 'default.jpg'; ?>" 
class="profile-icon" onclick="toggleMenu()">

<div id="dropdown" class="dropdown">

<a href="index.php?controller=profile&action=edit">Edit Profile</a>

<a href="index.php?controller=auth&action=logout">Logout</a>

</div>

</div>

</div>


<!-- Dynamic Page Content -->

<div class="content">

<?php
if(isset($view)){
    require $view;
}
?>

</div>

</div>


<script>

function toggleMenu(){
    var menu = document.getElementById("dropdown");

    if(menu.style.display === "block"){
        menu.style.display = "none";
    }else{
        menu.style.display = "block";
    }
}

</script>

</body>
</html>