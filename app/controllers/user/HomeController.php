<?php
class HomeController extends Controller {
    public function index() {
        // Fetch brands from the existing Brand model
        $brandModel = $this->model('Brand');
        $brands = $brandModel->getAllBrands();

        // Pass data to the user-specific view
        $this->view('user/index', ['brands' => $brands]);
    }
}