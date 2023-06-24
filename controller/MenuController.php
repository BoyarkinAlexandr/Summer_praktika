<?php
class MenuController extends Model{
    protected $productModel;
    protected $html;

    public function __construct()
    {   
        $this->productModel = new ProductModel();
        $this->html = new View();
    }

    public function Action(){
        $product1 = $this->productModel->getProductsWithLimitPeriod(1,3);
        $product2 = $this->productModel->getProductsWithLimitPeriod(3,6);
        $view = './view/menu.php';
        $data = array(
            'products1' => $product1,
            'products2' => $product2,
        );
        $this->html->render($data, $view);
    }
}