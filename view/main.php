
<!-- home section start -->
    <section class="home" id="home">
        <div class="home-content">
            <h2>Зарядись энергией вместе с нашей кофейней!</h2>
            <p>Мы создали идеальное место для настоящих ценителей 
                кофе. Погрузитесь в атмосферу комфорта и насладитесь 
                богатым выбором ароматных напитков, свежих зерен и 
                вкусных десертов и закусок. Приходите и откройте для 
                себя настоящий кофейный рай.</p>
            <button id="btn-menu"><a class="btn-menu"href="/menu">Открыть меню</a></button>
        </div>
        <div class="img">
            <img src="/public/css/pictures/coffee_mas.png" alt="">
        </div>
    </section>
<!-- Home Section End -->

<!-- Часть удобств сайта -->
    <section class="facility">
        <div class="heading">
            <h3>Сочетание культуры, кофе и<br>первоклассного обслуживания</h3>

        </div>

        <div class="box-container">
            <div class="box">
                <img src="/public/css/pictures/oborudovanie.png" alt="">
            </div>

            <div class="box">
                <img src="/public/css/pictures/coffee_var.png" alt="">
            </div>

            <div class="box">
                <img src="/public/css/pictures/coffee_out.png" alt="">
            </div>


            <div class="box">
                <img src="/public/css/pictures/candies.png" alt="">
            </div>


            <div class="box">
                <img src="/public/css/pictures/beans.png" alt="">
            </div>
        </div>
        
    </section>

<!-- Конец удобств сайта -->



<!-- Популярные позиции начало -->

    <section class="product">
        <div class="product-container">
            <div class = "popular-heading">
                <h1>Популярные позиции</h1>
                <p>Наша команда прилагает много сил для создания качественных кофе и выпечки. В каждом нашем<br> продукте вы можете почуствовать частичку вложенной нами любви.</p>
            </div>
            
            <?php while(ceil(count($products)/3)):?>
            <div class="product-row">
                <?php foreach(array_slice($products, 0, 3) as $product):?>
                <div class="product-card">
                    <div class="badge <?php echo $product['is_favourites'] == '' ? '' : 'active'?>" data-id-product="<?php echo $product['id_product']?>">
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
                                <?php echo !isset($product['count_product']) ? '<div href="" data-id-product="' . $product['id_product'] . '"><ion-icon name="bag-outline" data-id-product="' . $product['id_product'] . '"></ion-icon></div>' 
                                : '<div href="" data-id-product="' . $product['id_product'] . '" style="padding: 8px 19px; font-size: 20px; color: #f3f7f2; font-family:Better Together Caps">' . $product['count_product'] . '</div>' ?>
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
<!-- Популярные позиции конец -->



<!-- Начало слайдера -->
    <section class="slider_img">
        <div class="sales">
            <h1>Акции</h1>
        </div>
        <div class="slider">
            <div class="list">
                <div class="item"> 
                    <img src="/public/css/pictures/sales1.png" alt="">
                </div>
                <div class="item">
                    <img src="/public/css/pictures/sales2.png" alt="">
                </div>
                <div class="item">
                    <img src="/public/css/pictures/sales3.png" alt="">
                </div>
            </div>
            <div class="buttons">
                <button id="prev"><</button>
                <button id="next">></button>
            </div>
            <ul class="dots">
                <li class="active"></li>
                <li></li>
                <li></li>
            </ul>
            <button class="order-now-btn">Заказать сейчас</button>
        </div>
    </section>
<!-- Конец слайдера -->

