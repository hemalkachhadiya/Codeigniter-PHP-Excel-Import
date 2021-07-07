var table = $('#table').DataTable({
    "pagingType": "full_numbers",
    "processing": true,
    "serverSide": true,
    "order": [0, 'desc'],
    "ajax": {
        "url": base_url+"/users/list",
        "dataType": "json",
        "type": "POST",
        data: function (data) {
            
        }
    }
});

function deleteData(user_id) {
    if (confirm('Are you sure to delete this record ?')) {
        $.ajax({
            "url": base_url + "/users/delete",
            "type": "post",
            "data": {
                "user_id": user_id
            },
            success: function () {
                table.ajax.reload();
            }
        })
    }
}