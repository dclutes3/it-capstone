$.ajax({
    type: 'POST',
    url: '../app/ajax/getAllStores.php',
    success: function (data) {
        var data = $.parseJSON(data);
        if (data.code == 1) { //on success
            $('#stores').dataTable({
                data: data.result,
                columns: [
                    {title: 'Store', data: 'name', render: function (data, type, row) {
                            data = data.replace('Hy-Vee', '<span class="hyvee">Hy-Vee</span>');
                            data = data.replace('Walmart', '<span class="walmart">Walmart</span>');
                            data = data.replace('Target', '<span class="target">Target</span>');
                            return (data != null) ? data : "<strong>None</strong>";
                        }
                    },
                    {title: 'Address', data: 'address', render: function (data, type, row) {
                            return (data != null) ? data : "<strong>None</strong>";
                        }
                    },
                    {
                        title: 'Actions',
                        data: 'id',
                        render: function (data, type, row) {
                            return '<button class="btn btn-success" onclick="storeItems(' + data + ')" title="Show Items Button" aria-label="Show Items Button">Show Items</button>';
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
    window.location.href = 'items?Id=' + Id;
}