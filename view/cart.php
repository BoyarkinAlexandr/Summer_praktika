    <!-- Начало корзина -->
    <div class="cart__container">
        <div class="cart__filter"></div>
        <div class="cart__wrapper">
            <div class="cart__title">
                <h2 class="cart__title__text">Ваши покупки</h2>
            </div>
            <div class="cart__products__container">
                <?php 
                foreach ($products as $product):
                    if(isset($product['count_product'])):
                    ?>
                    <div class="cart__products">
                        <div data-id-product="<?= $product['id_product']?>" class="cart__products__favourites <?php echo $product['is_favourites'] == '' ? '' : 'active'?>">
                            <img src="/public/css/pictures/love.svg" class="cart__products__love" alt="">
                            <img src="/public/css/pictures/love-fill.svg" class="cart__products__love-fill" alt="">
                        </div>
                        <div class="cart__products__wrapper">
                            <div class="cart__products__icon">
                                <img src="<?= $product['img_product']?>" alt="">
                            </div>
                            <div class="cart__products__name">
                                <h2><?= $product['name_product']?></h2>
                            </div>
                            <div class="cart__products__count">
                                <div class="cart__products__count__min">-</div>
                                <div class="cart__products__count__num"><input type="number" data-id-product="<?= $product['id_product']?>" value="<?= $product['count_product']?>" max="99" min="1"></div>
                                <div class="cart__products__count__plus">+</div>
                            </div>
                            <div class="cart__products__price">
                                <span class="cart__products__price__text"><?= $product['count_product'] * $product['price_product']?></span>&#8381;
                            </div>
                        </div>
                    </div>
                <?php 
                    endif;
                endforeach;?>
            </div>

            <div class="cart__price">
                <div class="cart__price__text">Итого</div>
                <div class="cart__price__number"><span>750</span>&#8381;</div>
            </div>

            <div class="cart__buy__btn">Купить</div>
        </div>
    </div>
    <!-- Конец корзина -->