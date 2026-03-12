<!DOCTYPE html>
<html>
<head>

<title>Our Products</title>

<style>

.card{
    border:1px solid #ccc;
    padding:15px; width:200px; 
    display:inline-block; 
    margin:10px; 
    text-align:center;
}

/* CARD IMAGES CONTAINER */
.card-images {
  display: flex;
  overflow-x: auto;
  gap: 8px;
  justify-content: center;
  margin-bottom: 10px;
}

/* EACH IMAGE */
.card-images img {
  width: 100px;        /* fixed width */
  height: 80px;        /* fixed height */
  object-fit: contain;  /* keeps aspect ratio */
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  transition: transform 0.3s ease;
}

/* HOVER EFFECT */
.card-images img:hover {
  transform: scale(1.1);
}

</style>

</head>

<body>

<h2>All Products</h2>

<!-- Search -->
<input type="text" id="search" placeholder="Search product">

<!-- Brand Filter -->
<select id="brandFilter">

<option value="">All Brands</option>

<?php while($brand = $brands->fetch_assoc()): ?>

<option value="<?= $brand['brand_id'] ?>">
<?= $brand['name'] ?>
</option>

<?php endwhile; ?>

</select>

<br><br>

<!-- Product List -->
<div id="productContainer">

<?php while($product = $products->fetch_assoc()): ?>

<?php
$images = explode(',', $product['img']);
?>

<div class="card">
    <div class="card-images">
        <?php foreach($images as $img): ?>
            <img src="/laptofy_MVC/public/img/product/<?= $img ?>" alt="<?= $product['name'] ?>">
        <?php endforeach; ?>
    </div>
    <h3><?= $product['name'] ?></h3>
    <p>₹<?= $product['price'] ?></p>
    <a href="/laptofy_MVC/public/show/<?= $product['id'] ?>">
    View Details
</a>
</div>
<?php endwhile; ?>

</div>

<!-- External AJAX JS -->
<script src="/laptofy_MVC/public/js/product-filter.js"></script>

</body>
</html>