function chooseUser(id) {

    window.parent.$('#user-modal').modal('hide');
    window.parent.$('#agreement-uid').val(id);

    $.getJSON('/manager/users/get', {id:id}, function(data) {
        if (data.id !== undefined) {
            window.parent.$('#user-name').html('<strong>'+data.lastname+' '+data.username+' '+data.patronymic+'</strong>');
            window.parent.$('#user-email').html(data.email);
            window.parent.$('#user-phone1').html(data.phone1);
            window.parent.$('#user-photo').attr('src',data.photo);
            window.parent.$('#user-table').removeClass('hide');
        }
    });

}

