<nav>
    <div class="container-fluid">
        <div class="logo-search-container">
            <a href="/main" class="logo__title">Fragrante</a>
            <div class="search-bar">
            <input type="search" placeholder="ПОИСК">
            </div>
        </div>
        <div class="button">
            <div>
                <a href="/menu" class="menu__market__icon <?= SPLIT()[0] == 'menu' ? "on" : "" ?>" style="text-decoration: none">
                    <img id="cart-menu-market" src="/public/css/pictures/market-icon.svg" alt="корзина" style="margin-right: 10px">
                    <img id="cart-menu-text-title" src="/public/css/pictures/menu-text-title.svg" alt="корзина">
                </a>
            </div>

            <div>
                <img id="cart-icon-favorietes" src="/public/css/pictures/izbranoe.svg" alt="корзина"">
            </div>

            <div>
                <img id="cart-icon-card" src="/public/css/pictures/shop_card.svg" alt="корзина"">
            </div>

            <div>
                <img id="cart-icon-profile" src="/public/css/pictures/profile.svg" alt="корзина"">
            </div>
        </div>
    </div>
</nav>

    <!-- Меню авторизации -->
    <div id="modal-container" class="modal">
        <div class="modal-content1">
            <!-- Ваше содержимое модального окна здесь -->
            <div class="container" id="container">
                <span class="close">×</span>
                <div class="form-container sign-up-container">
                    <form action="#">
                        <h1 class="modal__window__title">Создать аккаунт</h1>
                        <input type="text" placeholder="Name" class="modal__window__input">
                        <input type="email" placeholder="Email" class="modal__window__input">
                        <input type="password" placeholder="Password" class="modal__window__input">
                        <button class="modal__window__btn">Зарегистрироваться</button>
                    </form>
                </div>
                <div class="form-container sign-in-container">
                    <form action="#">
                        <h1 class="modal__window__title">Войти</h1>
                        <input type="email" placeholder="Email" class="modal__window__input">
                        <input type="password" placeholder="Password" class="modal__window__input">
                        <a href="#" class="modal__window__link">Забыли свой пароль?</a>
                        <button class="modal__window__btn">Войти</button>
                    </form>
                </div>
                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <h1 class="modal__window__title">С возвращением!</h1>
                            <p class="modal__window__text">Чтобы поддерживать с нами связь, пожалуйста, войдите в систему, указав свои личные данные</p>
                            <button class="modal__window__btn ghost" id="signIn">Войти</button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h1 class="modal__window__title">Привет, друг!</h1>
                            <p class="modal__window__text">Введите свои личные данные и начните быть вместе с нами</p>
                            <button class="modal__window__btn ghost" id="signUp">Зарегистрироваться</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Меню авторизации -->