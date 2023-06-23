
    <!-- <nav>
        <div class="container">
            <p class="logo__title">Fragrante</p>
            <div class="search-bar">
                <input type="search" placeholder="ПОИСК">
            </div>
            <div class="button">
                <button class="btn_log">Войти</button>
                <button class="btn_reg">Зарегистрироваться</button>
            </div>

        </div>
    </nav> -->

    <nav>
        <div class="container">
        <div class="logo-search-container">
            <p class="logo__title">Fragrante</p>
            <div class="search-bar">
            <input type="search" placeholder="ПОИСК">
            </div>
        </div>
        <div class="button">
            <a href="#">
                <img id="cart-icon" src="/public/css/pictures/shopping_cart.png" alt="корзина"">
            </a>
            <button class="btn_log">Войти</button>
            <button class="btn_reg">Зарегистрироваться</button>
        </div>
        </div>
    </nav>

<!-- home section start -->
    <section class="home" id="home">
        <div class="home-content">
            <h2>Зарядись энергией вместе с нашей кофейней!</h2>
            <p>Мы создали идеальное место для настоящих ценителей 
                кофе. Погрузитесь в атмосферу комфорта и насладитесь 
                богатым выбором ароматных напитков, свежих зерен и 
                вкусных десертов и закусок. Приходите и откройте для 
                себя настоящий кофейный рай.</p>
            <button id="btn">Order Now</button>
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


            <!-- ______________________ -->

            <!-- <div class="product-row">
                <div class="product-card">
                    <div class="badge">
                        <a href="#">
                            <img src="./icons/izbranoe.png" alt="Нажми меня">
                        </a>
                    </div>
		            <div class="product-tumb">
                        <img src="./pictures/kruasan.png" alt="">
                    </div>

                    <div class="product-details">
                        <div class="product-cat">
                            <span class="product-catagory">3 типа</span>
                        </div>
                        <h4>Croissant</h4>
                        <div class="product-bottom-details">
                            <div class="product-price">
                                <small>200₽</small>
                            </div>

                            <div class="product-links">
                                <a href=""><ion-icon name="bag-outline"></ion-icon></a>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="product-card">
                    <div class="badge">
                        <a href="#">
                            <img src="./icons/izbranoe.png" alt="Нажми меня">
                        </a>
                    </div>
		            <div class="product-tumb">
                        <img src="./pictures/cold brue.png" alt="">
                    </div>

                    <div class="product-details">
                        <div class="product-cat">
                            <span class="product-catagory">3 типа</span>
                        </div>
                        <h4>cold brew</h4>
                        <div class="product-bottom-details">
                            <div class="product-price">
                                <small>200₽</small>
                            </div>

                            <div class="product-links">
                                <a href=""><ion-icon name="bag-outline"></ion-icon></a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="badge">
                        <a href="#">
                            <img src="./icons/izbranoe.png" alt="Нажми меня">
                        </a>
                    </div>
		            <div class="product-tumb">
                        <img src="./pictures/latte.png" alt="">
                    </div>

                    <div class="product-details">
                        <div class="product-cat">
                            <span class="product-catagory">3 типа</span>
                        </div>
                        <h4>latte</h4>
                        <div class="product-bottom-details">
                            <div class="product-price">
                                <small>350₽</small>
                            </div>

                            <div class="product-links">
                                <a href=""><ion-icon name="bag-outline"></ion-icon></a>
                            </div>

                        </div>
                    </div>
                </div>


            </div> -->
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

