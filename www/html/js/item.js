$(function () {
    if ($("#tableItems").length) {
        initFilter();
        initTableItems();
    }
    $("#tableItems").on("click", "#upvotePrice", function () {
        vote("upvote", $(this).data('id'), $(this).data('store'));
    })
    $("#tableItems").on("click", "#downvotePrice", function () {
        vote("downvote", $(this).data('id'), $(this).data('store'));
    })
    $("#applyFilter").on("click", function () {
        initTableItems()
    })
    $("#clearFilter").on("click", function () {
        clearFilter();
        initTableItems();
    })

    $("#addItem").on("click", function () {
        $("#addItemModal").modal("show");
        clearModalSelect2();

    })
    $("#itemDropdown").on("change", function () {
        $("#itemSelection").val($("#itemDropdown").val());
        if ($("#itemSelection").val() != "") {
            $('#addItemModal1').modal('hide');
            $('#addItemModal2').modal('show');
        }
    });
    $("#addItemBackButton").on("click", function () {
        $('#addItemModal2').modal('hide');
        $('#addItemModal3').modal('hide');
        $('#addItemModal1').modal('show');
    })
});

function initFilter() {
    initSelect2();
    initSlider();
}

var filter = ''

function updateFilter() {
    var store = ($('.store-select2 option:selected').length) ? $(".store-select2").select2('data')[0].text : "";
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
}

var tableItems = ''

var tableItemColumns = [
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

            return (data != null) ? '<div class="row"><div class="col-1"><button id="upvotePrice" class="btn btn-sm btn-block" action="upvote" data-store=' + data.store + ' data-id=' + data.id + '><i class="fa-solid fa-caret-up"></i></button><button id="downvotePrice" class="btn btn-sm btn-block" action="downvote" data-store=' + data.store + ' data-id=' + data.id + '><i class="fa-solid fa-caret-down"></i></button></div><div class="col-1 pl-2 d-flex align-items-center"><p class="text-center mt-3 ' + color + '">' + sum + '</p></div></div>' : "";
        }}
]

var tableItemColumnsStore = [
    {"data": "item", "render": function (data, type, row) {
            return (data != null) ? data : "No Name";
        }},
    {"data": "price", "render": function (data, type, row) {
            return (data != null) ? data : "0.00";
        }},
    {"data": "type", "render": function (data, type, row) {
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

            return (data != null) ? '<div class="row"><div class="col-1"><button id="upvotePrice" class="btn btn-sm btn-block" action="upvote" data-store=' + data.store + ' data-id=' + data.id + '><i class="fa-solid fa-caret-up"></i></button><button id="downvotePrice" class="btn btn-sm btn-block" action="downvote" data-store=' + data.store + ' data-id=' + data.id + '><i class="fa-solid fa-caret-down"></i></button></div><div class="col-1 pl-2 d-flex align-items-center"><p class="text-center mt-3 ' + color + '">' + sum + '</p></div></div>' : "";
        }}
]

function initTableItems() {
    /* Commented out as storeItems is no longer needed/used
    if (window.location.href.includes("storeItems.php"))
    {
        var urlParams = new URLSearchParams(window.location.search);
        var id = urlParams.get('Id');
        if (id == null)
        {
            $('#title').text("A store was not selected.");
        } else
        {
            tableItems = $('#tableItems').DataTable({
                "ajax": {
                    "url": "/app/ajax/getItemsStore.php",
                    "data": {
                        "Id": id
                    },
                    "dataSrc": function (data) {
                        $('#title').text("Items for " + data.storename);
                        $('#address').text(data.storeaddress);
                        return data.data;
                    }
                },
                "columns": tableItemColumnsStore
            });
        }
    } else
    { */
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
    //} Commented out as storeItems is no longer needed/used
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
                store: store,
            },
            success: function (data) {
                console.log(data);
                var data = $.parseJSON(data);
                if (data.code === 1) {
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
                if(id) {
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

/* might be deprecated with death of search page
 $('#globalSearchBtn').on('click', function () {
 var itemName = $("#itemName").val();
 var itemType = $("#itemType").val();
 var storeName = $("#storeName").val();
 if (!itemName || !itemType || !storeName) {
 console.log($("#globalSearchBody"));
 $("#globalSearchBody").html("");
 $("#globalSearchError").html("<p class='text-danger'>You must select a value for all input fields.</p>");
 } else {
 $.ajax({
 type: 'POST',
 url: '../ajax/globalSearch.php',
 data: {
 item: itemName,
 type: itemType,
 store: storeName,
 },
 success: function (data) {
 var data = $.parseJSON(data);
 if (data.code === 1) {
 $("#itemName").val("");
 $("#itemType").val("All");
 $("#storeName").val("All");
 $("#globalSearchError").html("");
 $("#globalSearchBody").html(data.msg);
 } else {
 $("#globalSearchBody").html("");
 $("#globalSearchError").html("An unknown error occurred.");
 }
 },
 error: function (xhr, status, error) {
 var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/globalSearch.php';
 alert(errorMessage);
 }
 });
 }
 });
 */