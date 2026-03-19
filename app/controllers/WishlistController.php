<?php

require_once __DIR__ . '/../models/Wishlist.php';
require_once __DIR__ . '/../core/Person.php';

class WishlistController
{

    public function index(): void
    {
        Person::requireLogin();

        $person_id = $_SESSION['Person']['id'];

        $wishlistModel = new Wishlist();
        $wishlist = $wishlistModel->getByPerson($person_id);
        $totalWishlist = $wishlistModel->countByPerson($person_id);

        require __DIR__ . '/../views/user/wishlist.php';
    }

    public function add(): void
    {
        Person::requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /laptofy_MVC/public/home");
            exit();
        }

        $person_id  = $_SESSION['Person']['id'];
        $product_id = (int)($_POST['product_id'] ?? 0);

        if ($product_id === 0) {
            echo "<script>
                    alert('Invalid product');
                    window.history.back();
                  </script>";
            exit();
        }

        $wishlistModel = new Wishlist();

        if ($wishlistModel->exists($person_id, $product_id)) {
            echo "<script>
                    alert('Alredy in Wishlist ');
                    window.history.back();
                  </script>";
            exit();
        }

        $success = $wishlistModel->add($person_id, $product_id);

        if ($success) {
            echo "<script>
                    alert('Added to wishlist!');
                    window.history.back();
                  </script>";
            exit();
        } 
        else {
            echo "<script>
                    alert('Failed to add to wishlist. Try again.');
                    window.history.back();
                  </script>";
            exit();
        }
    }

    public function remove(): void
    {
        Person::requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /laptofy_MVC/public/wishlist");
            exit();
        }

        $person_id  = $_SESSION['Person']['id'];
        $product_id = (int)($_POST['product_id'] ?? 0);

        if ($product_id === 0) {
            echo "<script>
                    alert('Invalid product');
                    window.location='/laptofy_MVC/public/wishlist';
                  </script>";
            exit();
        }

        $wishlistModel = new Wishlist();
        $success = $wishlistModel->remove($person_id, $product_id);

        if ($success) {
            echo "<script>
                    ('Removed from wishlist');
                    window.location='/laptofy_MVC/public/wishlist';
                  </script>";
            exit();
        } 
        else {
            echo "<script>
                    alert('Failed to remove. Try again.');
                    window.location='/laptofy_MVC/public/wishlist';
                  </script>";
            exit();
        }
    }
}