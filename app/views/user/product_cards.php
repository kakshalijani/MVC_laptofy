<?php if($products->num_rows > 0): ?>

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
    <a href="/laptofy_MVC/public/show/<?= $product['id'] ?>">
    View Details
</a>
</div>
<?php endwhile; ?>
<?php else: ?>

<p>No Products Found</p>

<?php endif; ?>