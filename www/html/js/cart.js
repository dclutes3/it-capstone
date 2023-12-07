/********************* */
/* Drew Clutes aack2f  */
/********************* */

$(function () {
    if ($("#tableCartBody").length) { //if the cart body exists, init()
        $("#removeFromCart").hide();
        initTableCart();
    }

    $("#tableCartBody").on("click",".cart-row",function(){ //when the row of a cart item is clicked, check that row's checkbox. 
       var checkbox =$(this).find("#cartCheckbox");
       checkbox.prop('checked', !checkbox.prop('checked'));
       checkbox.trigger("change");
    })

    $("#tableCartBody").on("click","#cartCheckbox",function(){
        $(this).prop('checked', !$(this).prop('checked'));
    })

    let arr;
    $("#tableCartBody").on("change",".cart-row #cartCheckbox",function(){ //when a chectbox is changed, push the data (price id) to the array to be used in case of a delete
        arr=[]
        $("input[name='cart-checkboxes']:checked").each(function(){
            arr.push($(this).data('price'));
        })
        if(arr.length){                                         //if the arr has numbers, allow the user to delete those selected items
            $("#removeFromCart").prop('disabled',false);
            $("#removeFromCart").show();
        } else {
            $("#removeFromCart").prop('disabled',true);
            $("#removeFromCart").hide();
        }
    })

    $('#tableCartBody').on("change",".cart-row #quantityDropdown",function(){  //when the quantity dropdown is changed, call updateQuantity() with the priceid and value of the dropdown. 
        if($(this).val()>=0){
            updateQuantity($(this).data('price'),$(this).val());
        } else {
            console.log("an unknown error occurred");
        }
    })

    $("#removeFromCart").on("click",function(){
        var prices = JSON.stringify(arr);
        var count = arr.length;
        var text
        if (count > 1){
            text = "Are you sure you want to remove "+count+" Items?"
        } else {
            text = "Are you sure you want to remove "+count+" Item?"
        }
        if(confirm(text)){
            $.ajax({
                type: 'POST',
                url: '../app/ajax/updateCart.php',
                data: {
                    prices: prices,
                    action: "delete",
                },
                success: function (data) {
                    console.log(data);
                    var data = $.parseJSON(data);
                    if (data.code === 1) {
                        $("#removeFromCart").prop('disabled',true);
                        $("#removeFromCart").hide();
                        initTableCart();
                    } else {
                        console.log("ERROR");
                    }
                },
                error: function (xhr, status, error) {
                    var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/vote.php';
                    alert(errorMessage);
                }
            });
        }
    })
})


function updateQuantity(price_id,quantity){     //takes the price_id and the quantity of the row to be changed.
    $.ajax({
        type: 'POST',
        url: '../app/ajax/updateQuantity.php',  //calls an AJAX script that updates the database. 
        data: {
            price_id: price_id,                 //pass price_id and quantity to the script for use. 
            quantity: quantity,
            action: "update",
        },
        success: function (data) {              //on success, reinitialize the table.
            initTableCart();
        },
        error: function (xhr, status, error) {
            var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/updateQuantity.php';
            alert(errorMessage);
        }
    });
}

function initTableCart(){                       //initialize or reinitialize the table
    $.ajax({
        url: '/app/ajax/tableCart.php',
        method: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#tableCartBody').html(data);     //overwrite the html of #tableCartBody
        },
        error: function () {
            alert('Error fetching data.');
        }
    });
}