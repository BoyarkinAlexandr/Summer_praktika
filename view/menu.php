
    <!-- Начало меню -->

    <section class="menu">
        <div class="heading1">
            <h3>МЕНЮ</h3>
        </div>

        <div class="menu_category">
            <div class="all">
                <h4>All</h4>

            </div>
            <div class="coffee">
                <h4>Coffee</h4>

            </div>
            <div class="vipechka">
                <h4>Vipechka</h4>

            </div>
            <div class="desert">
                <h4>Deserts</h4>
            </div>
        </div>

    </section>

    <!-- Конец меню -->


    <!-- Популярные позиции начало -->

    <section class="product1">
        <div class="product-container">
        <?php while(ceil(count($products)/3)):?>
            <div class="product-row">
                <?php foreach(array_slice($products, 0, 3) as $product):?>
                <div class="product-card">
                    <div class="badge <?php echo $product['favourites'] == '' ? '' : 'active'?>" data-id-product="<?php echo $product['id_product']?>">
                        <img src="/public/css/pictures/favorietes.svg" class="like" alt="Нажми меня">
                        <img src="/public/css/pictures/success.svg" class="success" alt="Нажми меня">
                    </div>
		            <div class="product-tumb">
                        <img src="<?= $product['img_product']?>" alt="">
                    </div>

                    <div class="product-details">
                        <h4><?= $product['name_product']?></h4>
                        <div class="product-bottom-details">
                            <div class="product-price">
                                <small><?= $product['price_product']?>₽</small>
                            </div>

                            <div class="product-links" >
                                <div href=""><ion-icon name="bag-outline" data-id-product="<?php $product['id_product']?>"></ion-icon></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    array_shift($products);
                    endforeach;?>
            </div>
        <?php endwhile;?>
        </div>
    </section>