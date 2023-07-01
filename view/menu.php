
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
        <div class="product-row">
            <?php foreach($products1 as $product):?>
            <div class="product-card">
                <div class="badge">
                    <a href="#">
                        <img src="/public/css/pictures/izbranoe.png" alt="Нажми меня">
                    </a>
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

                        <div class="product-links">
                            <a href=""><ion-icon name="bag-outline"></ion-icon></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div class="product-row">
            <?php foreach($products2 as $product):?>
            <div class="product-card">
                <div class="badge">
                    <a href="#">
                        <img src="/public/css/pictures/izbranoe.png" alt="Нажми меня">
                    </a>
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

                        <div class="product-links">
                            <a href=""><ion-icon name="bag-outline"></ion-icon></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            </div>
        </div>
    </section>