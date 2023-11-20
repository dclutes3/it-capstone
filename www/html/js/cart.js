$(function () {
    if ($("#tableCart").length) {
        initTableCart();
    }

    let arr;
    $("#tableCart").on("change","#cartCheckbox", function(){
        arr=[]
        $("input[name='cart-checkboxes']:not(:checked)").each(function(){
            arr.push($(this).data('price'));
        })
        console.log(arr);
        if(arr.length){
            $("#removeFromCart").prop('disabled',false);
        } else {
            $("#removeFromCart").prop('disabled',true);
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
                url: '../ajax/updateCart.php',
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

var tableCart = '';
var tableCartColumns = [
    {"data": "price_id","render": function (data, type, row){
        return (data != null) ? '<input type="checkbox" name="cart-checkboxes" data-price=' + data + ' id="cartCheckbox"></input>' : "";
    }},
    {"data": "item", "render": function (data, type, row) {
        return (data != null) ? data : "No Name";
    }},
    {"data": "price", "render": function (data, type, row) {
        return (data != null) ? data : "0.00";
    }},
    {"data": "type", "render": function (data, type, row) {
        return (data != null) ? data : "None";
    }},
    {"data": "store", "render": function (data, type, row) {
        return (data != null) ? data : "None";
    }}
];


function initTableCart(){
    tableCart = $('#tableCart').DataTable();
    tableCart.destroy();
    tableCart = $('#tableCart').DataTable({
        "ajax": {
            "url": "/app/ajax/getCart.php",
        },
        "columns": tableCartColumns
    });
}
