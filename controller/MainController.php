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
        $products = $this->productModel->getAllProducts();
        $view = './view/main.php';
        $clientId = $this->clientModele->getClientId($_SESSION['id_session']);
        $favoruetesProducts = $this->favoruetesModel->getAllFavourites($clientId);
        $products = $this->productModel->getInitParamFavorietes($products, $favoruetesProducts);
        $listFavorProducts = $this->favoruetesModel->getFavofProducts($clientId);
        $data = array(
            'products' => $products,
            'favorProducts' => $listFavorProducts,
        );
        $this->html->render($data, $view);
    }
}