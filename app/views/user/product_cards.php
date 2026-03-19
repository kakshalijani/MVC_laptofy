<div id="filterCards">
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
            <a href="/laptofy_MVC/public/show/<?= $product['id'] ?>">View Details</a>
            <form method="POST" action="/laptofy_MVC/public/wishlist-add">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button>Wishlist</button>
            </form>
        </div>
    <?php endwhile; ?>

<?php else: ?>
    <p>No Products Found</p>
<?php endif; ?>
</div>

<div id="filterPagination" style="display:none;">
    <?php for($i = 1; $i <= $totalPages; $i++): ?>

        <?php if(isset($price_range) && $price_range != ''): ?>
            <a href="#"
               onclick="loadByPrice(<?= $i ?>); return false;"
               class="<?= $i === $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php else: ?>
            <a href="#"
               onclick="loadProducts(<?= $i ?>); return false;"
               class="<?= $i === $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endif; ?>

    <?php endfor; ?>
</div>