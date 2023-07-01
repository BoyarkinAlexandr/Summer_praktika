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
        let btnAddToCart = `<div href="" data-id-product="${infoBlock['id_product']}"><ion-icon name="bag-outline" data-id-product="" role="img" class="md hydrated"></ion-icon></div>`;
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
        addToCart([btnAddToCart]);
        container.append(totalHTML);
    })
}

function addToCart(blocks){
    blocks.forEach(block => {
        $(block).on('click', function(){

        });
    });
}