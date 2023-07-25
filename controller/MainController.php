<?php
class MainController{
    protected $productModel;
    protected $html;
    protected $clientModele;
    protected $favoruetesModel;

    public function __construct()
    {   
        $this->productModel = new ProductModel();
        $this->clientModele = new ClientModel();
        $this->favoruetesModel = new FavouritesModel();
        $this->html = new View();
    }

    public function Action(){
        $clientId = $_SESSION['id_client'];
        var_dump($clientId);
        $products = $this->productModel->getAllProducts($clientId);
        $view = './view/main.php';
        $data = array(
            'products' => $products,
        );
        $this->html->render($data, $view);
    }
}