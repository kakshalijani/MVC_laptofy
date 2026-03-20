<h2>Dashboard</h2>

<p>Total Products: <?php echo $totalProducts; ?></p>
<p>Total Brands: <?php echo $totalBrands; ?></p>
<p>Total Persons: <?php echo $totalPersons; ?></p>

<h3 style="margin-top:30px; margin-bottom:15px;">Registered Persons</h3>

<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Registration Date</th>
            <th>Wishlist Items</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if($persons->num_rows > 0): ?>
            <?php $i = 1; ?>
            <?php while($person = $persons->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($person['fullname']) ?></td>
                    <td><?= htmlspecialchars($person['email']) ?></td>
                    <td><?= date('d M Y', strtotime($person['created_at'])) ?></td>

                    <td>
                        <span class="wishlist-badge">
                            <?php
                                $wishlistModel = new Wishlist();
                                echo $wishlistModel->getTotalByPerson($person['id']);
                            ?>
                        </span>
                    </td>

                    <td>
                        <a href="/laptofy_MVC/public/delete-person?id=<?= $person['id'] ?>"
                           onclick="return confirm('Are you sure you want to delete this person?')">
                            <button type="button" class="btn-delete">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No persons registered yet</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>