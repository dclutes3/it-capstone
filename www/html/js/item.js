$(function () {
    if ($("#tableItems").length) {
        initFilter();
        initTableItems();
    }
    $("#tableItems").on("click", "#upvotePrice", function () {
        vote("upvote", $(this).data('id'), $(this).data('store_id'));
    })
    $("#tableItems").on("click", "#downvotePrice", function () {
        vote("downvote", $(this).data('id'), $(this).data('store_id'));
    })
    $("#applyFilter").on("click", function () {
        initTableItems()
    })
    $("#clearFilter").on("click", function () {
        clearFilter();
        initTableItems();
    })

    let arr;
    $("#tableItems").on("change","#priceCheckbox", function(){
        arr=[]
        $("input[name='price-checkboxes']:checked").each(function(){
            arr.push($(this).data('price'));
        })
        if(arr.length){
            $("#addToCart").prop('disabled',false);
        } else {
            $("#addToCart").prop('disabled',true);
        }
    })

    $("#addToCart").on("click",function(){
        var prices = JSON.stringify(arr);
        var count = arr.length;
        if(confirm("Add ("+count+") Item(s) to cart?")){
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
                        console.log(data.msg);
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

    $("#addItem").on("click", function () {
        if ($('#userId').val() != "") {
            $("#addItemModal1").modal("show");
            clearModalSelect2();
        } else {
            $('#errorModal').modal("show");
        }


    })
    $("#itemDropdown").on("change", function () {
        $("#itemSelection").val($("#itemDropdown").val());
        if ($("#itemSelection").val() != "") {
            item_id = $("#itemSelection").val();
            addItem = false;
            $('#addItemModal1').modal('hide');
            $('#addItemModal2').modal('show');
        }
    });
    $("#addItemBackButton").on("click", function () {
        $('#addItemModal2').modal('hide');
        $('#addItemModal3').modal('hide');
        $('#addItemModal1').modal('show');
        $("#addItemModal1Error").html("");
    })
});

function initFilter() {
    initSelect2();
    initSlider();
}

var filter = ''

function updateFilter() {
    var store = ($('.store-select2 option:selected').length) ? $(".store-select2").select2('data')[0].id : "";
    var item = ($('.item-select2 option:selected').length) ? $(".item-select2").select2('data')[0].text : "";
    var priceLow = $("#filterPrice").slider("values", 0)
    var priceHigh = $("#filterPrice").slider("values", 1);

    filter = '{"store":"' + store + '", "item":"' + item + '", "priceLow":' + priceLow + ', "priceHigh":' + priceHigh + '}';
    console.log(filter);
}
function clearFilter() {
    clearSelect2();
    $("#filterPrice").slider("values", [0, 100]);
    $("#amount").val("$" + $("#filterPrice").slider("values", 0) + " - $" + $("#filterPrice").slider("values", 1));

    updateFilter();
}

function clearSelect2() {
    $(".item-select2").val(null).trigger("change");
    $(".store-select2").val(null).trigger("change");
    clearModalSelect2();
}

function clearModalSelect2() {
    $(".add-item-select2").val(null).trigger("change");
    $(".add-type-select2").val(null).trigger("change");
    $(".add-store-select2").val(null).trigger("change");
    $("#addItemModal1Error").html("");
    $("#addItemModal2Error").html("");
}

var tableItems = ''

var tableItemColumns = [
    {"data": "price_id","render": function (data, type, row){
        return (data != null) ? '<input type="checkbox" name="price-checkboxes" data-price=' + data + ' id="priceCheckbox"></input>' : "";
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
        }},
    {"data": "date", "render": function (data, type, row) {
            return (data != null) ? data : "No Date Posted";
        }},
    {"data": "vote", /*"orderable":false,*/"render": function (data, type, row) {
            var sum = (data.sum != null) ? data.sum : 0;
            if (sum > 0) {
                color = "text-success";
            } else if (sum == 0) {
                color = "";
            } else {
                color = 'text-danger';
            }
            if ($("#userId").val() == "")
                return '<p class="text-center mt-3 ' + color + '">' + sum + '</p>'

            return (data != null) ? '<div class="row"><div class="col-1"><button id="upvotePrice" class="btn btn-sm btn-block" action="upvote" data-store_id=' + data.store_id + ' data-id=' + data.id + '><i class="fa-solid fa-caret-up"></i></button><button id="downvotePrice" class="btn btn-sm btn-block" action="downvote" data-store_id=' + data.store_id + ' data-id=' + data.id + '><i class="fa-solid fa-caret-down"></i></button></div><div class="col-1 pl-2 d-flex align-items-center"><p class="text-center mt-3 ' + color + '">' + sum + '</p></div></div>' : "";
        }}
]

function initTableItems() {
    tableItems = $("#tableItems").DataTable();
    tableItems.destroy();
    updateFilter();
    filter = $.parseJSON(filter)
    tableItems = $('#tableItems').DataTable({
        "ajax": {
            "url": "/app/ajax/getItems.php",
            "data": {
                "priceLow": filter.priceLow,
                "priceHigh": filter.priceHigh,
                "store": filter.store,
                "item": filter.item
            }
        },
        "columns": tableItemColumns
    });
}

function vote(type, id, store) {
    var user = $("#userId").val();
    if (user == "") {
        console.log("CANNOT VOTE WHEN NOT LOGGED IN");
    } else if (id != null && (type == "upvote" || type == "downvote")) {
        
        $.ajax({
            type: 'POST',
            url: '../ajax/vote.php',
            data: {
                type: type,
                user: user,
                price: id,
                store: store
            },
            success: function (data) {
                console.log(data);
                var data = $.parseJSON(data);
                if (data.code === 1) {
                    $("#addToCart").prop("disabled",true);
                    tableItems.ajax.reload();
                } else {
                    console.log("ERROR");
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/vote.php';
                alert(errorMessage);
            }
        });
    } else {
        console.log("ERROR");
    }
}
function initSelect2() {
    if ($(".item-select2").length) {
        $.ajax({
            type: 'GET',
            url: '/app/ajax/select2-items.php',
            dataType: 'json',
            success: function (data) {
                $(".item-select2").select2({
                    placeholder: "Select an item",
                    dropdownAutoWidth: true,
                    allowClear: true,
                    width: "100%",
                    data: data,
                    initSelection: function (element, callback) {
                        // No default selection
                    }
                });
                $(".item-select2").val(null).trigger('change');
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> /app/ajax/select2-items.php';
            }
        })
    }
    if ($('.store-select2').length) {
        var urlParams = new URLSearchParams(window.location.search);
        var id = urlParams.get('Id');

        $.ajax({
            type: 'GET',
            url: '/app/ajax/select2-stores.php',
            dataType: 'json',
            success: function (data) {
                $(".store-select2").select2({
                    placeholder: "Select an store",
                    dropdownAutoWidth: true,
                    allowClear: true,
                    width: "100%",
                    data: data
                });
                if (id) {
                    $(".store-select2").val(id).trigger("change");
                    initTableItems()
                } else
                {
                    $(".store-select2").val(null).trigger("change");
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> /app/ajax/select2-stores.php';
            }
        })
    }
    if ($('.add-store-select2').length) {
        $.ajax({
            type: 'GET',
            url: '/app/ajax/select2-stores.php',
            dataType: 'json',
            success: function (data) {
                $(".add-store-select2").select2({
                    placeholder: "Select an store",
                    dropdownParent: "#addItemModal2",
                    dropdownAutoWidth: true,
                    allowClear: true,
                    width: "100%",
                    data: data
                });
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> /app/ajax/select2-stores.php';
            }
        })
    }

    if ($('.add-item-select2').length) {
        $.ajax({
            type: 'GET',
            url: '/app/ajax/select2-items.php',
            dataType: 'json',
            success: function (data) {
                $(".add-item-select2").select2({
                    placeholder: "Select an item",
                    dropdownParent: "#addItemModal1",
                    dropdownAutoWidth: true,
                    allowClear: true,
                    width: "100%",
                    data: data
                });
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> /app/ajax/select2-items.php';
            }
        })
    }

    if ($('.add-type-select2').length) {
        $.ajax({
            type: 'GET',
            url: '/app/ajax/select2-itemType.php',
            dataType: 'json',
            success: function (data) {
                $(".add-type-select2").select2({
                    placeholder: "Select an item category",
                    dropdownParent: "#addItemModal1",
                    dropdownAutoWidth: true,
                    allowClear: true,
                    width: "100%",
                    data: data
                });
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> /app/ajax/select2-items.php';
            }
        })
    }

    clearSelect2();
}

function initSlider() {
    if ($("#filterPrice").length) {
        $("#filterPrice").slider({
            range: true, // Enable range mode
            min: 0, // Minimum value
            max: 100, // Maximum value
            values: [0, 100], // Initial values for the range
            slide: function (event, ui) {
                // Function to handle the slide event
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        })
        $("#amount").val("$" + $("#filterPrice").slider("values", 0) + " - $" + $("#filterPrice").slider("values", 1));
    }
}


//Add Item Code
$(function () {
    $('#addItemButton1').on('click', function(){
        name = $('#itemTextBox').val();
        type_id = $('#itemType').val();
        if (name == "" || type_id == null){
            $("#addItemModal1Error").html("Please fill in all fields.");
        }
        else{
            $('#addItemModal1').modal('hide');
            $('#addItemModal2').modal('show');
            addItem = true;
        }
    });

    $('#addItemButton2').on('click', function () {
        var price = $('#priceTextBox').val();
        var store_id = $('#storeName').val();
        if (price == "" || store_id == null){
            $("#addItemModal2Error").html("Please fill in all fields.");
        }
        else {
            if (Number(price) < 0 || Number(price) > 100){
                $("#addItemModal2Error").html("Price must be between 0 and 100.");
            }
            else{
                if (addItem) {
                    $.ajax({
                        type: 'POST',
                        url: '../ajax/addItem.php',
                        data: {
                            name: name,
                            type_id: type_id
                        },
                        success: function (data) {
                            var data = $.parseJSON(data);
                            if (data.code == 1){
                                item_id = data.result.id;
                                $.ajax({
                                    type: 'POST',
                                    url: '../ajax/addPrice.php',
                                    data: {
                                        price: price,
                                        store_id: store_id,
                                        item_id: item_id
                                    }
                                });
                                $("#addItemModal3Text").html("Item " + name + " with price $" + price + " successfully added.");
                            }
                            else{
                                $("#addItemModal3Text").html("There was an error adding the item " + name);
                            }
                        },
                        error: function (xhr, status, error){
                            var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> /ajax/getItem.php';
                        }
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '../ajax/addPrice.php',
                        data: {
                            price: price,
                            store_id: store_id,
                            item_id: item_id
                        }
                    });
                    $("#addItemModal3Text").html("Price $" + price + " successfully added.");
                }
                $('#addItemModal2').modal('hide');
                $('#addItemModal3').modal('show');
            }
        }
    });

    $('#addItemModal3').on('hidden.bs.modal', function () {
        location.reload();
    });
});