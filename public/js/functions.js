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

function refreshContainerFavor(container, arrayInfo){
    container.empty();
    arrayInfo.forEach(infoBlock => {
        if(infoBlock['is_favourites']){
            console.log(infoBlock['count_product']);
            let btnAddToCart = `<div style="${!infoBlock['count_product'] ? '' : "padding: 8px 19px; font-size: 20px; color: #f3f7f2; font-family:Better Together Caps"}" data-id-product="${infoBlock['id_product']}">${ !infoBlock['count_product'] ? '<ion-icon name="bag-outline" data-id-product="" role="img" class="md hydrated"></ion-icon>' : infoBlock['count_product']}</div>`;
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
                        ${btnAddToCart}
                    </div>
                </div>
            </div>`;
            addToCart([btnAddToCart], '.product-links > div');
            container.append(totalHTML);
        }
    })
}

function addToCart(blocks, selectorBlocks){
    console.log(selectorBlocks + `[data-id-product=${$(this).data('id-product')}]`);
    blocks.forEach(block => {
        $(block).on('click', function(){
            let thisBtn = $(selectorBlocks + `[data-id-product=${$(this).data('id-product')}]`);
            thisBtn.css({'padding': '8px 19px', 'font-size': '20px', 'color': '#f3f7f2', 'font-family':'Better Together Caps'});
            let thisValue = $(block).text() ?  Number($(block).text()) + 1 : 1;
            let action = thisValue === 1 ? `add_cart` : `update_cart`;
            console.log(action);
            let data = {
                'action': action,
                'id_product': $(block).data('id-product'),
                'count_product': thisValue,
            }
            newAjaxQuery('index.php',data, 'POST')
                .then(function(responce){
                    responce = $.parseJSON(responce);
                    thisBtn.text(responce.count_product);
                    $(`.product-links > div[data-id-product=${thisBtn.data('id-product')}]`).text(responce.count_product);
                    $(`.cart__products__count__num > input[data-id-product=${thisBtn.data('id-product')}]`).val(responce.count_product);
                })
                .catch(function(xhr, status, error){
                    console.log(xhr);
                })
        });
    });
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