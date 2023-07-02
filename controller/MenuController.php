<?php
class MenuController{
    protected $productModel;
    protected $html;
    protected $clientModele;
    protected $favoruetesModel;

    public function __construct()
    {   
        $this->productModel = new ProductModel();
        $this->html = new View();
        $this->clientModele = new ClientModel();
        $this->favoruetesModel = new FavouritesModel();
    }

    public function Action(){
        $clientId = $_SESSION['id_client'];
        $products = $this->productModel->getAllProducts($clientId);
        $view = './view/menu.php';
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