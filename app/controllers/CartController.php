<?php
require_once __DIR__ . '/../models/Cart.php';
require_once __DIR__ . '/../core/Person.php';

class CartController
{
    public function index(): void
    {
        Person::requireLogin();

        $person_id  = $_SESSION['Person']['id'];
        $cartModel  = new Cart();

        $cartItems  = $cartModel->getByPerson($person_id);
        $totalPrice = $cartModel->getTotalPrice($person_id);
        $totalItems = $cartModel->getTotalItems($person_id);

        require __DIR__ . '/../views/user/cart.php';
    }

    public function add(): void
    {
        $product_id = (int)($_POST['product_id'] ?? 0);

        if($product_id === 0){
            echo "<script>alert('Invalid product'); window.history.back();</script>";
            exit();
        }

        if(Person::check()){
            $person_id = $_SESSION['Person']['id'];
            $cartModel = new Cart();
            $cartModel->add($person_id, $product_id);
        } else {
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = [];
            }
            if(isset($_SESSION['cart'][$product_id])){
                $_SESSION['cart'][$product_id]++;
            } else {
                $_SESSION['cart'][$product_id] = 1;
            }
        }

        echo "<script>
                alert('Added to cart!');
                window.history.back();
              </script>";
        exit();
    }

    public function remove(): void
    {
        Person::requireLogin();

        $product_id = (int)($_POST['product_id'] ?? 0);
        $person_id  = $_SESSION['Person']['id'];

        $cartModel = new Cart();
        $cartModel->remove($person_id, $product_id);

        header("Location: /laptofy_MVC/public/cart");
        exit();
    }

    public function increase(): void
    {
        Person::requireLogin();

        $product_id = (int)($_POST['product_id'] ?? 0);
        $person_id  = $_SESSION['Person']['id'];

        $cartModel = new Cart();
        $cartModel->increaseQuantity($person_id, $product_id);

        header("Location: /laptofy_MVC/public/cart");
        exit();
    }

    public function decrease(): void
    {
        Person::requireLogin();

        $product_id = (int)($_POST['product_id'] ?? 0);
        $person_id  = $_SESSION['Person']['id'];

        $cartModel = new Cart();
        $cartModel->decreaseQuantity($person_id, $product_id);

        header("Location: /laptofy_MVC/public/cart");
        exit();
    }
}