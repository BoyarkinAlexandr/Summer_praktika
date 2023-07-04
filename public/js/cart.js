$(document).ready(() => {

    $('.cart__buy__btn').on('click', function(){
        let array = [];
        document.querySelectorAll('.cart__products').forEach(block => {
            let obj = {};
            obj['id_product'] = $(block).find('.cart__products__favourites').data('id-product');
            obj['count_product'] = $(block).find('.cart__products__count__num').find('input').val();
            array.push(obj);
        })
        data = {
            'action': 'add_history',
            'array': array
        };
        console.log(data);
        newAjaxQuery('index.php',data, 'POST')
            .then(function(responce){
                console.log(responce);
                let data = {'action': 'delete_all'};
                newAjaxQuery('index.php', data, 'POST')
                    .then(function(responce){
                        responce = $.parseJSON(responce);
                        refreshContainerCart($('.cart__products__container'),responce);
                        refreshContainerFavor($('.favorietes__products__container'), responce);
                        refreshBtnIconFromDelete($('.product-links > div'));
                        addToCart(document.querySelectorAll('.product-links > div'),'.product-links > div');
                    })
            })
            .catch(function(xhr, status, error){
                console.log(xhr);
            })
    });

    $('.cart__products__delete');

    zeroProductInCart($('.cart__products__container'));

    returnAllPrice($('.cart__price__number > span'), $('.cart__products__price__text'));

    deleteProductFromCartById(document.querySelectorAll('.cart__products__delete'));


    class AnimationOpenJQ{
        constructor(btn, block){
            this.block = block;
            this.mode = false;
            this.btn = btn;
            this.btn.on('click', () => {
                this.triger();
            })
        }

        triger(){
            if (this.mode){
                this.block.hide(500);
                this.mode = !this.mode;
            } else {
                this.block.show(500);
                this.mode = !this.mode;
            }
        }

    }

    new AnimationOpenJQ($('#cart-icon-card'),$('.cart__container'));
    new AnimationOpenJQ($('#cart-icon-favorietes'),$('.favorietes__container'));

    addToCart(document.querySelectorAll('.product-links > div'),'.product-links > div');

    $('.cart__reset__btn').on('click', function(){
        let data = {'action': 'delete_all'};
        newAjaxQuery('index.php', data, 'POST')
            .then(function(responce){
                responce = $.parseJSON(responce);
                refreshContainerCart($('.cart__products__container'),responce);
                refreshContainerFavor($('.favorietes__products__container'), responce);
                refreshBtnIconFromDelete($('.product-links > div'));
                addToCart(document.querySelectorAll('.product-links > div'),'.product-links > div');
            })
    });
    setCounter();


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
                    })
                let totalPrice = 0;
                document.querySelectorAll('.cart__products__price__text').forEach(block => {
                    totalPrice += Number($(block).text());
                })
                $('.cart__price__number > span').text(totalPrice);
            }   
        });
    }
});