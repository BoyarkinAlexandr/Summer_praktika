function newAjaxQuery(url, data, method){
    return new Promise(function(resolve, reject){
        $.ajax({
            url: url,
            data: data,
            method: method,
            success: function(responce){
                resolve(responce);
            },
            error: function(xhr, status, error){
                reject(error);
            }
        });
    });
}

function addToCart(blocks, selectorBlocks){
    blocks.forEach(block => {
        $(block).on('click', function(){
            let thisBtn = $(selectorBlocks + `[data-id-product=${$(this).data('id-product')}]`);
            thisBtn.css({'padding': '8px 19px', 'font-size': '20px', 'color': '#f3f7f2', 'font-family':'Better Together Caps'});
            let thisValue = $(block).text() ?  Number($(block).text()) + 1 : 1;
            let action = thisValue === 1 ? `add_cart` : `update_cart`;
            let data = {
                'action': action,
                'id_product': $(block).data('id-product'),
                'count_product': thisValue,
            }
            newAjaxQuery('index.php',data, 'POST')
                .then(function(responce){
                    responce = $.parseJSON(responce);
                    thisBtn.text(thisValue);
                    $(`.product-links > div[data-id-product=${thisBtn.data('id-product')}]`).text(responce.count_product);
                    $(`.cart__products__count__num > input[data-id-product=${thisBtn.data('id-product')}]`).val(responce.count_product);
                    refreshContainerCart($('.cart__products__container'),responce);
                })
                .catch(function(xhr, status, error){
                    console.log(xhr);
                })
        });
    });
}

function refreshContainerFavor(container, arrayInfo){
    container.empty();
    let btns = [];
    arrayInfo.forEach(infoBlock => {
        if(infoBlock['is_favourites']){
            let ShopBtn = document.createElement('div');
            if(!infoBlock['count_product']){
                ShopBtn.insertAdjacentHTML('beforeend','<ion-icon name="bag-outline" data-id-product="" role="img" class="md hydrated"></ion-icon>');
                ShopBtn.setAttribute('data-id-product', infoBlock['id_product']);
            } else {
                ShopBtn.style.padding = '8px 19px';
                ShopBtn.style.fontFamily = 'Better Together Caps';
                ShopBtn.style.fontSize = '20px';
                ShopBtn.style.color = "#f3f7f2";
                ShopBtn.setAttribute('data-id-product', infoBlock['id_product']);
                ShopBtn.innerText = infoBlock['count_product'];
            }
            let totalHTML = 
            `<div class="favorietes__products">
                <div class="favorietes__products__wrapper">
                    <div class="favorietes__products__icon">
                        <img src="${infoBlock['img_product']}" alt="">
                    </div>
                    <div class="favorietes__products__name">
                        <h2>${infoBlock['name_product']}</h2>
                    </div>
                    <div class="product-links">
                        ${ShopBtn.outerHTML}
                    </div>
                </div>
            </div>`;
            container.append(totalHTML);
            btns.push(ShopBtn);
        }
        $('.product-links > div').off();
        addToCart(document.querySelectorAll('.product-links > div'), '.product-links > div');
    })
    zeroProductInFavor(container);
}

function refreshContainerCart(container, arrayInfo){
    container.empty();
    arrayInfo.forEach(infoBlock => {
        if(infoBlock['count_product']){
            let totalHTML = 
            `<div class="cart__products">
                <div data-id-product="${ infoBlock['id_product']}" class="cart__products__favourites ${ !infoBlock['is_favourites'] ? '' : 'active'}">
                    <img src="/public/css/pictures/love.svg" class="cart__products__love" alt="">
                    <img src="/public/css/pictures/love-fill.svg" class="cart__products__love-fill" alt="">
                </div>
                <div class="cart__products__wrapper">
                    <div class="cart__products__icon">
                        <img src="${infoBlock['img_product']}" alt="">
                    </div>
                    <div class="cart__products__name">
                        <h2><${infoBlock['name_product']}</h2>
                    </div>
                    <div class="cart__products__count">
                        <div class="cart__products__count__min">-</div>
                        <div class="cart__products__count__num"><input type="number" data-id-product="${infoBlock['id_product']}" value="${infoBlock['count_product']}" disabled max="99" min="1"></div>
                        <div class="cart__products__count__plus">+</div>
                    </div>
                    <div class="cart__products__price">
                        <span class="cart__products__price__text">${ infoBlock['count_product'] * infoBlock['price_product']}</span>&#8381;
                    </div>
                    <div class="cart__products__delete" data-id-product="${ infoBlock['id_product']}">
                        x
                    </div>
                </div>
            </div>`;
            container.append(totalHTML);
        }
    })
    $(`.cart__products__favourites`).off();
    addToFavourites($(`.cart__products__favourites`));
    zeroProductInCart(container);
    returnAllPrice($('.cart__price__number > span'), $('.cart__products__price__text'));
    deleteProductFromCartById(document.querySelectorAll('.cart__products__delete'));
    setCounter();
}

function addToFavourites(block){
    block.on('click', function(){
        let thisTimer;
        let thisIcon = $(this);
        let idProduct = $(this).data('id-product');
        let data = {
            'action': $(this).hasClass('active') ? 'delete_favourites' : 'add_favourites',
            'id_product': idProduct
        };
        newAjaxQuery('index.php', data, 'POST')
            .then(function(responce){
                responce = $.parseJSON(responce);
                if(responce.result_query.action == 'delete'){
                    if(thisIcon.hasClass('cart__products__favourites')){
                        clearTimeout(thisTimer);
                        $(`.badge[data-id-product=${thisIcon.data('id-product')}]`).css('background-color', '#FFEDD5');
                        thisTimer = setTimeout(function(){$(`.badge[data-id-product=${thisIcon.data('id-product')}]`).removeClass('active');}, 200);
                        thisIcon.removeClass('active');
                        refreshContainerFavor($('.favorietes__products__container'), responce.objects_products);
                    }else{
                        clearTimeout(thisTimer);
                        thisIcon.css('background-color', '#FFEDD5');
                        thisTimer = setTimeout(function(){thisIcon.removeClass('active');}, 200);
                        $(`.cart__products__favourites[data-id-product=${thisIcon.data('id-product')}]`).removeClass('active');
                        refreshContainerFavor($('.favorietes__products__container'), responce.objects_products);
                    }
                } else{
                    if(thisIcon.hasClass('cart__products__favourites')){
                        clearTimeout(thisTimer);
                        $(`.badge[data-id-product=${thisIcon.data('id-product')}]`).css('background-color', '#F97316');
                        thisTimer = setTimeout(function(){$(`.badge[data-id-product=${thisIcon.data('id-product')}]`).addClass('active');}, 200);
                        thisIcon.addClass('active');
                        refreshContainerFavor($('.favorietes__products__container'), responce.objects_products);
                    } else {
                        clearTimeout(thisTimer);
                        thisIcon.css('background-color', '#F97316');
                        thisTimer = setTimeout(function(){thisIcon.addClass('active');}, 200);
                        $(`.cart__products__favourites[data-id-product=${thisIcon.data('id-product')}]`).addClass('active');
                        refreshContainerFavor($('.favorietes__products__container'), responce.objects_products);
                    }
                }
            })
            .catch(function(error){
                console.log(error);
            })
    });
}

function refreshBtnIconFromDelete(btnBlocks){
    let ShopBtn = document.createElement('div');
    ShopBtn.insertAdjacentHTML('beforeend','<ion-icon name="bag-outline" data-id-product="" role="img" class="md hydrated"></ion-icon>');
    for (let i = 0; i < btnBlocks.length; i++){
        ShopBtn.setAttribute('data-id-product', $(btnBlocks[i]).data('id-product')); 
        btnBlocks[i].outerHTML = ShopBtn.outerHTML;
    }
}

function zeroProductInCart(container){
    if (container.children().length === 0){
        $('.cart__price').hide();
        $('.cart__btn__container').hide();
        $('.cart__wrapper').append('<div class="cart__title__text__nothing">Пока здесь ничего нет!</div>');
    } else {
        $('.cart__price').show();
        $('.cart__btn__container').show();
        $('.cart__title__text__nothing').remove();
    }

}

function zeroProductInFavor(container){
    if (container.children().length === 0){
        $('.favorietes__wrapper').append('<div class="favorietes__title__text__nothing">Пока здесь ничего нет!</div>');
    } else {
        $('.favorietes__title__text__nothing').remove();
    }
}

function returnAllPrice(container, blocks){
    let totalPrice = 0;
    for(let i = 0; i < blocks.length; i++){
        totalPrice += Number($(blocks[i]).text());
    }
    container.text(totalPrice);
}

function deleteProductFromCartById(blocks){
    blocks.forEach(block => {
        $(block).on('click', function(){
            let data = {
                'action': 'delete_by_id',
                'id_product': $(block).data('id-product')
            }
            let thisBtn = $(this);
            newAjaxQuery('index.php',data, 'POST')
                .then(function(responce){
                    responce = $.parseJSON(responce);
                    let ShopBtn = document.createElement('div');
                    ShopBtn.insertAdjacentHTML('beforeend','<ion-icon name="bag-outline" data-id-product="" role="img" class="md hydrated"></ion-icon>');
                    ShopBtn.setAttribute('data-id-product', thisBtn.data('id-product')); 
                    document.querySelectorAll(`.product-links > div[data-id-product="${thisBtn.data('id-product')}"]`).forEach(block =>{
                        block.outerHTML = ShopBtn.outerHTML;
                    })
                    refreshContainerCart($('.cart__products__container'),responce);
                })
                .catch(function(xhr, status, error){
                    console.log(xhr);
                })
        });
    })
}

function setCounter(){

    $('.cart__products__count__plus').on('click', function(){
        let idProduct = $(this).data(`id-product`);
        if($(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val() < 99){
            let thisProdPrice = Number($(`.cart__products__price__text[data-id-product=${idProduct}]`).text())/Number($(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val());
            $(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val(Number($(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val()) + 1);
            let thisValue = Number($(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val());
            let action = `update_cart`;
            let data = {
                'action': action,
                'id_product': idProduct,
                'count_product': thisValue,
            }
            newAjaxQuery('index.php',data, 'POST')
                .then(function(responce){
                    responce = $.parseJSON(responce);
                    $(`.cart__products__price__text[data-id-product=${idProduct}]`).text(thisProdPrice * Number($(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val()));
                })
                .catch(function(xhr, status, error){
                    console.log(xhr);
                })
            let totalPrice = 0;
            document.querySelectorAll('.cart__products__price__text').forEach(block => {
                totalPrice += Number($(block).text());
            })
            $('.cart__price__number > span').text(totalPrice);
        }
    })

    $('.cart__products__count__min').on('click', function(){
        let idProduct = $(this).data(`id-product`);
        if($(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val() > 1){
            let thisProdPrice = Number($(`.cart__products__price__text[data-id-product=${idProduct}]`).text())/Number($(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val());
            $(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val(Number($(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val()) - 1);
            let thisValue = Number($(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val());
            let action = `update_cart`;
            let data = {
                'action': action,
                'id_product': idProduct,
                'count_product': thisValue,
            }
            newAjaxQuery('index.php',data, 'POST')
                .then(function(responce){
                    responce = $.parseJSON(responce);
                    $(`.cart__products__price__text[data-id-product=${idProduct}]`).text(thisProdPrice * Number($(`.cart__products__count__num > input[data-id-product=${idProduct}]`).val()));
                })
                .catch(function(xhr, status, error){
                    console.log(xhr);
                });
            let totalPrice = 0;
            document.querySelectorAll('.cart__products__price__text').forEach(block => {
                totalPrice += Number($(block).text());
            })
            $('.cart__price__number > span').text(totalPrice);
        }
    });
}