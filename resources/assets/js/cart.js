$(document).ready(function(){
    let addToCartButtonsSelector = '.btn-add-to-cart';
    let addToCartButtons = $(addToCartButtonsSelector);
    let csrfToken = $('meta[name=csrf-token]').attr("content");
    addToCartButtons.each(function(){
        
        let curr = $(this);
        curr.click(function(event){
            event.preventDefault();

            let addToCartUrl = $('meta[name=add-to-cart-link]').attr("content");

            let request = $.ajax({
                url: addToCartUrl,
                method: "POST",
                headers:{
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    product_id: curr.data('product-id')
                }
            });

            request.done(function(answer){
                let cart = $.parseJSON(answer);

                let headerCartLinkRl = $('.header-cart-link');
                headerCartLinkRl.find('span').text(cartProductCount); 
            });

            request.fail(function(jqXHR, textStatus){
                alert("Request failed: " + textStatus);
            });
             
        });
        
    });
});