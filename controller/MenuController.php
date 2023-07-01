<?php
class MenuController extends Model{
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
        $products = $this->productModel->getAllProducts();
        $view = './view/menu.php';
        $clientId = $this->clientModele->getClientId($_SESSION['id_session']);
        $favoruetesProducts = $this->favoruetesModel->getAllFavourites($clientId);
        $products = $this->productModel->getInitParamFavorietes($products, $favoruetesProducts);
        $data = array(
            'products' => $products,
        );
        $this->html->render($data, $view);
    }
}