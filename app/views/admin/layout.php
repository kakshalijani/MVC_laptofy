<?php
if(!isset($page)){
    $page = '';
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

<h2>Admin Panel</h2>

<a href="../app/view/dashboard/index.php">Dashboard</a>
<a href="../app/view/product/create.php">Add Product</a>
<a href="../app/view/brand/create.php">Add Brand</a>

<div class="logout">
<a href="/laptofy_MVC/logout">Logout</a>
</div>

</div>

<!-- Topbar -->

<div class="topbar">

<div class="profile">
<a href="/laptofy_MVC/profile">
<img src="/laptofy_MVC/public/profile.png">
</a>
</div>

</div>

<!-- Page Content -->

<div class="content">

<?php
if($page != ''){
    require $page;
}
?>

</div>

</body>
</html>