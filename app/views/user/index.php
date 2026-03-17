<!DOCTYPE html>
<html>
<head>
    <title>Our Products</title>
        <link rel="stylesheet" href="/laptofy_MVC/css/user.css">

</head>
<body>

<div class="page-container">

    <h2>All Products</h2>

    <input type="text" id="search" placeholder="Search product">
    <button  id="searchBtn" onclick="loadProducts()">search</button>
    
    <select id="brandFilter">
        <option value="">All Brands</option>
        <?php while($brand = $brands->fetch_assoc()): ?>
            <option value="<?= $brand['brand_id'] ?>"><?= $brand['name'] ?></option>
        <?php endwhile; ?>
    </select>

    <a href="/laptofy_MVC/public/home"><button>reset</button></a>
    
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
            </div>
        <?php endwhile; ?>
    </div>
    <div class="pagination">

            <?php for($i=1;$i<=$totalPages;$i++): ?>

            <a href="/laptofy_MVC/public/Home?page=<?= $i ?>">
            <?= $i ?>
            </a>

            <?php endfor; ?>

    </div>
</div>

<script src="/laptofy_MVC/public/js/product-filter.js"></script>

</body>
</html>