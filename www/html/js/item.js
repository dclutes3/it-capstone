$(function () {
    if ($("#tableItems").length) {
        initTableItems();
    }
    $("#tableItems").on("click", "#upvotePrice", function () {
        vote("upvote", $(this).data('id'), $(this).data('store'));
    })
    $("#tableItems").on("click", "#downvotePrice", function () {
        vote("downvote", $(this).data('id'), $(this).data('store'));
    })
});

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
            return (data != null) ? '<div class="row"><div class="col-1"><button id="upvotePrice" class="btn btn-sm btn-block" action="upvote" data-store=' + data.store + ' data-id=' + data.id + '><i class="fa-solid fa-caret-up"></i></button><button id="downvotePrice" class="btn btn-sm btn-block" action="downvote" data-store=' + data.store + ' data-id=' + data.id + '><i class="fa-solid fa-caret-down"></i></button></div><div class="col-1 pl-2 d-flex align-items-center"><p class="text-center mt-3 ' + color + '">' + sum + '</p></div></div>' : "";
        }}
]

function initTableItems() {
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
    {
        tableItems = $('#tableItems').DataTable({
            "ajax": {
                "url": "/app/ajax/getItems.php"
            },
            "columns": tableItemColumns
        });
    }
}

$(function () {

})