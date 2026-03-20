<!DOCTYPE html>
<html>
<head>
    <title>Our Products</title>
    <link rel="stylesheet" href="/laptofy_MVC/css/user.css">
</head>
<body>

<div class="page-container">

    <h2>All Products</h2>

    <?php if(Person::check()): ?>
        <div style="text-align:right; margin-bottom:10px;">
            <span style="color:#fff; margin-right:10px;">
                Welcome, <?= $_SESSION['Person']['fullname'] ?>
            </span>
            <a href="/laptofy_MVC/public/person-profile"><button type="button">My Profile</button></a>
            <a href="/laptofy_MVC/public/wishlist"><button type="button">My Wishlist</button></a>
            <a href="/laptofy_MVC/public/person-logout"><button type="button">Logout</button></a>
        </div>
    <?php else: ?>
        <div style="text-align:right; margin-bottom:10px;">
            <a href="/laptofy_MVC/public/person-login"><button type="button">Login</button></a>
            <a href="/laptofy_MVC/public/person-register"><button type="button">Register</button></a>
        </div>
    <?php endif; ?>

    <input type="text" id="search" placeholder="Search product">

    <select id="brandFilter">
        <option value="">All Brands</option>
        <?php while($brand = $brands->fetch_assoc()): ?>
            <option value="<?= $brand['brand_id'] ?>"><?= $brand['name'] ?></option>
        <?php endwhile; ?>
    </select>
    <select id="priceFilter">
        <option value="">All Price</option>
        <option value="10000-20000">10000-20000</option>
        <option value="30000-40000">30000-40000</option>
        <option value="50000-60000">50000-60000</option>
        <option value="70000-80000">70000-80000</option>
        <option value="90000-100000">90000-100000</option>
        </select>

    <button id="searchBtn">Search</button>
    <a href="/laptofy_MVC/public/home"><button>RESET</button></a>

    <div id="productContainer">
        <?php while($product = $products->fetch_assoc()): ?>
            <?php $images = explode(',', $product['img']); ?>
            <div class="card">
                <div class="card-images">
                    <?php foreach($images as $img): ?>
                        <img src="/laptofy_MVC/public/img/product/<?= $img ?>" alt="<?= $product['name'] ?>">
                    <?php endforeach; ?>
                </div>
                <h3><?= $product['name'] ?></h3>
                <p>₹<?= $product['price'] ?></p>
                <a href="/laptofy_MVC/public/show/<?= $product['id'] ?>">View Details</a>
                    <form method="POST" action="/laptofy_MVC/public/wishlist-add">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button>Wishlist</button></a>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="pagination" id="mainPagination" style="display:flex;">
        <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <a href="/laptofy_MVC/public/Home?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>">
                <?= $i ?></a>
        <?php endfor; ?>
    </div>

</div>

<script src="/laptofy_MVC/public/js/product-filter.js"></script>
</body>
</html>