<!-- Меню любимых товаров -->
<div class="favorietes__container">
    <div class="favorietes__filter"></div>
    <div class="favorietes__wrapper">
        <div class="favorietes__title">
            <h2 class="favorietes__title__text">Любимые товары</h2>
        </div>
        <div class="favorietes__products__container">
            <?php foreach($favorProducts as $favorProduct):?>
            <div class="favorietes__products">
                <div class="favorietes__products__wrapper">
                    <div class="favorietes__products__icon">
                        <img src="<?= $favorProduct['img_product']?>" alt="">
                    </div>
                    <div class="favorietes__products__name">
                        <h2><?= $favorProduct['name_product']?></h2>
                    </div>
                    <div class="product-links">
                        <div href="" data-id-product="<?= $favorProduct['id_product']?>"><ion-icon name="bag-outline" data-id-product="" role="img" class="md hydrated"></ion-icon></div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<!-- Меню любимых товаров -->