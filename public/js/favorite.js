$(document).ready(() => {
    $(`.badge`).on('click', function(){
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
                    clearTimeout(thisTimer);
                    thisIcon.css('background-color', '#FFEDD5');
                    thisTimer = setTimeout(function(){thisIcon.removeClass('active');}, 200);
                    refreshContainerFavor($('.favorietes__products__container'), responce.objects_products);
                } else{
                    clearTimeout(thisTimer);
                    thisIcon.css('background-color', '#F97316');
                    thisTimer = setTimeout(function(){thisIcon.addClass('active');}, 200);
                    refreshContainerFavor($('.favorietes__products__container'), responce.objects_products);
                }
            })
            .catch(function(error){
                console.log(error);
            })
    });
});