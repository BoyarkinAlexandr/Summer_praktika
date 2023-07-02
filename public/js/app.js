$(document).ready(() => {
    let slider = document.querySelector('.slider .list');
    let items = document.querySelectorAll('.slider .list .item');
    let next = document.getElementById('next');
    let prev = document.getElementById('prev');
    let dots = document.querySelectorAll('.slider .dots li');

    let lengthItems = items.length - 1;
    let active = 0;
    next.addEventListener('onclick', function(){
        active = active + 1 <= lengthItems ? active + 1 : 0;
        reloadSlider();
    });
    prev.addEventListener('onclick', function(){
        active = active - 1 >= 0 ? active - 1 : lengthItems;
        reloadSlider();
    });
    let refreshInterval = setInterval(()=> {next.click()}, 3000);
    function reloadSlider(){
        slider.style.left = -items[active].offsetLeft + 'px';
        // 
        let last_active_dot = document.querySelector('.slider .dots li.active');
        last_active_dot.classList.remove('active');
        dots[active].classList.add('active');

        clearInterval(refreshInterval);
        refreshInterval = setInterval(()=> {next.click()}, 3000);

        
    }

    dots.forEach((li, key) => {
        li.addEventListener('click', ()=>{
            active = key;
            reloadSlider();
        })
    })
    window.onresize = function(event) {
        reloadSlider();
    };

    // ____________________Кнопка________________-


    // Получение элементов модального окна и кнопки открытия

    // Получаем кнопку "Войти" и модальное окно
    var loginButton = document.querySelector('#cart-icon-profile');
    var modal = document.querySelector('#modal-container');

    // При клике на кнопку "Войти" открываем модальное окно
    $(loginButton).on('click', function() {
        $(modal).show(200);
    });

    // При клике на крестик закрываем модальное окно
    var closeButton = document.querySelector('.close');
    $(closeButton).on('click', function(){
        $(modal).hide(200);
        $('#container').removeClass('right-panel-active');
    });

    // Закрываем модальное окно при клике вне его области
    $(window).on('click', function(event) {
        if (event.target === modal) {
            $(modal).hide(200);
            $('#container').removeClass('right-panel-active');
        }
    });


    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

    function openModal() {
        var modal = document.getElementById("modal-container");
        modal.style.display = "block";
    }

    function closeModal() {
        var modal = document.getElementById("modal-container");
        modal.style.display = "none";
    }
});
