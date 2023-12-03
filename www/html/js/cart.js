$(function () {
    if ($("#tableCartBody").length) {
        initTableCart();
    }

    $(".cart-row").on("click",function(){
       var checkbox =$(this).find("#cartCheckbox");
       checkbox.prop('checked', !checkbox.prop('checked'));
    })

    let arr;
    $("#tableCartBody").on("change",".cart-row #cartCheckbox",function(){
        arr=[]
        $("input[name='cart-checkboxes']:checked").each(function(){
            arr.push($(this).data('price'));
        })
        console.log(arr);
        if(arr.length){
            $("#removeFromCart").prop('disabled',false);
        } else {
            $("#removeFromCart").prop('disabled',true);
        }
    })

    $('#tableCartBody').on("change",".cart-row #quantityDropdown",function(){
        console.log("dropdown changed");
        if($(this).val()>=0){
            updateQuantity($(this).data('price'),$(this).val());
        } else {
            console.log("an unknown error occurred");
        }
    })

    $("#removeFromCart").on("click",function(){
        var prices = JSON.stringify(arr);
        var count = arr.length;
        var removeCount = 0;
        $("input[name='cart-checkboxes']:checked").each(function(){
            removeCount+=1;
        })
        if(confirm("Are you sure you want to remove ("+removeCount+") Item(s)?")){
            $.ajax({
                type: 'POST',
                url: '../app/ajax/updateCart.php',
                data: {
                    prices: prices,
                    count: count,
                },
                success: function (data) {
                    console.log(data);
                    var data = $.parseJSON(data);
                    if (data.code === 1) {
                        $("#removeFromCart").prop('disabled',true);
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


function updateQuantity(price_id,quantity){
    console.log("updateQuantity() called");
    $.ajax({
        type: 'POST',
        url: '../app/ajax/updateQuantity.php',
        data: {
            price_id: price_id,
            quantity: quantity,
        },
        success: function (data) {
            initTableCart();
        },
        error: function (xhr, status, error) {
            var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/updateQuantity.php';
            alert(errorMessage);
        }
    });
}

function initTableCart(){
    console.log("initTableCart() called");
    $.ajax({
        url: '/app/ajax/tableCart.php',
        method: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#tableCartBody').html(data);
        },
        error: function () {
            alert('Error fetching data.');
        }
    });
}