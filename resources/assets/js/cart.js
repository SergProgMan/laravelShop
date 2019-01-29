$(document).ready(function(){

    let addToCartUrl = $('meta[name=add-to-cart-link').attr("content");
    let updateCartUrl = $('meta[name=update-cart-link]').attr("content");
    let deleteCartUrl = $('meta[name=delete-cart-link]').attr("content");
    let csrfToken = $('meta[name=csrf-token]').attr("content");


    let addToCartButtonsSelector = '.btn-add-to-cart';
    let addToCartButtons = $(addToCartButtonsSelector);
   
    addToCartButtons.each(function(){
        
        let curr = $(this);
        curr.click(function(event){
            event.preventDefault();

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

                updateCartData(cart);

                showCartUpdated();
            });

            request.fail(function(jqXHR, textStatus){
                alert("Request failed: " + textStatus);
            });
             
        });
        
    });

    let showCartUpdated = function(){
        let alertEl = $('.alert-cart-updated');
        alertEl.show();
        setTimeout(function(){
            alertEl.fadeOut(250);
        }, 2000);
    }

    let cartTableEl = $('.cart-table');

    let updateCartData = function(cart){
        cartTableEl.find('tbody tr').each(function(){
            let currTr = $(this);
            let currProduct = currTr.data('product-id');

            let currProductData =cart.products[currProductId];

            if(currProductData !== undefined){
                currTr.find('.cart-quantity-input').val(currProductData.quantity);
                currTr.find('.cart-total-product-price').text(currProductData.totalPrice);
            }
        });

        $('.cart-totals-count').text(cart.cartProductsCount);
        $('.cart-totals-price').text(cart.cartTotalPrice);

        let headerCartLinkEl = $('.header-cart-link');
        headerCartLinkEl.find('span').text(cart.cartProductsCount);
    }

    cartTableEl.find('tbody tr').each(function(){
        let currTr = $(this);

        let quantityInput = currTr.find('.cart-quantity-input');

        let quatityOldValue = false;
        let currentTimeout = false;
        let quantityInputChanges = function(value){

            if(quatityOldValue === value){
                return;
            }

            if(value <= 0 && vaue !== ""){
                let neededValue = quantityOldValue !== false ? quatityOldValue : 1;
                quantityInput.val(neededValue);
                return;
            }

            quatityOldValue = value;

            if(currentTimeout){
                clearTimeout(currentTimeout);
            }

            currentTimeout = setTimeout(function(){
                let request = $.ajax({
                    url: updateCartUrl,
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        product_id: currTr.data('product-id'),
                        quantity: value
                    }
                });

                request.done(function(answer){
                    let cartData = $.parseJSON(answer);
                    updateCartData(cartData);
                    showCartUpdated();
                });

                request.fail(function(jqXHR, textStatus){
                    alert("Request failed: " + textStatus);
                });
            }, 500);
        }

        quantityInput.keyup(function(){
            quantityInputChanges(quantityInput.val());
        });

        quantityInput.click(function(){
            quantityInputChanges(quantityInput.val());
        });

        let deleteButton = currTr.find('.cart-product-remove');
        deleteButton.click(function(){
            let request = $.ajax({
                url: deleteCartUrl,
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    product_id: currTr.data('product-id')
                }
            });

            request.done(function(answer){
                let cartData = $.parseJSON(answer);
                updateCartData(cartData);
                showCartUpdated();
                currTr.remove();
            });

            request.fail(function(jqXHR, textStatus){
                alert("Request failed: " + textStatus);
            });
        });
    });

});