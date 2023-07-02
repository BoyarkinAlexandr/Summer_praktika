<!-- Меню любимых товаров -->
<div class="favorietes__container">
    <div class="favorietes__filter"></div>
    <div class="favorietes__wrapper">
        <div class="favorietes__title">
            <h2 class="favorietes__title__text">Любимые товары</h2>
        </div>
        <div class="favorietes__products__container">
            <?php foreach($products as $product):
                    if ($product['is_favourites']):?>
                    <div class="favorietes__products">
                        <div class="favorietes__products__wrapper">
                            <div class="favorietes__products__icon">
                                <img src="<?= $product['img_product']?>" alt="">
                            </div>
                            <div class="favorietes__products__name">
                                <h2><?= $product['name_product']?></h2>
                            </div>
                            <div class="product-links">
                            <?php echo !isset($product['count_product']) ? '<div href="" data-id-product="' . $product['id_product'] . '"><ion-icon name="bag-outline" data-id-product="' . $product['id_product'] . '"></ion-icon></div>' 
                                        : '<div href="" data-id-product="' . $product['id_product'] . '" style="padding: 8px 19px; font-size: 20px; color: #f3f7f2; font-family:Better Together Caps">' . $product['count_product'] . '</div>' ?>
                            </div>
                        </div>
                    </div>
            <?php 
                endif;
            endforeach;?>
        </div>
    </div>
</div>
<!-- Меню любимых товаров -->