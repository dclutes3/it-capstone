$.ajax({
    type: 'POST',
    url: '../app/ajax/getAllStores.php',
    success: function (data) {
        var data = $.parseJSON(data);
        if (data.code == 1) { //on success
            $('#stores').dataTable({
                data: data.result,
                columns: [
                    {title: 'Store', data: 'name'},
                    {title: 'Address', data: 'address'},
                    {
                        title: 'Actions',
                        data: 'id',
                        render: function (data, type, row) {
                            return '<button class="btn btn-success" onclick="storeItems(' + data + ')">Show Items</button>';
                        }
                    }
                ]
            });
        } else if (data.code == -2) { //error
            $("#storesError").html("An unknown error occurred.");
        } else { //other error
            $("#storesError").html("An unknown error occurred.");
        }
    },
    error: function (xhr, status, error) {
        var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> /ajax/getAllStores.php';
        alert(errorMessage);
    }
})

function storeItems(Id) {
    window.location.href = 'items.php?Id=' + Id;
}