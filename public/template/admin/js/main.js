$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/* Delete */
$(document).ready(function () {
    function getIdDelete(c, n) {
        $(c).click(function () {
            const id = $(this).attr('data-id');
            if (confirm('Are you delete?')) {
                $.ajax({
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: {id},
                    url: '/admin/'+n+'/delete/' + id,
                    success: function (result) {
                        location.reload();
                    }
                });
            }
        });
    }

    getIdDelete('.delete-menu', 'menus');
    getIdDelete('.delete-course', 'courses');
    getIdDelete('.delete-customer', 'customers');

    $('#avatar').change(function () {
       $('.old-avatar').hide();
        $('.old-label').hide();
    });

});
