//Функции Ajax

var st_process = new Object();
function process(url, ident, before_id, form_id) {
    if(st_process[ident] == false) return;
    if(form_id == '') form_id = 'undefined';
    jQuery.ajax({
        url:     url,
        type:     "POST",
        dataType: "json",
        data: jQuery("#"+form_id).serialize(),
        beforeSend: function () {
            st_process[ident] = false;
            if(before_id) {
                if(!$("#"+before_id).is(":visible")) {
                    $("#"+before_id).show();
                }
                $("#"+before_id).html('<img class="load__img" src="/views/default/img/load.gif">');
            }
        },
        success: function(response) {
            $.each(response, function(i, val) {
                $('#'+i).html(val);
            });
        },
        error: function(response) {

            //location.href = '/errors/data';
        },
        complete: function () {
            st_process[ident] = true;
        }
    });
}

$('#users__list').on('click', '.users__group', function(){
    process('/admin/users/change_status/'+$(this).attr('data-group')+'/'+$(this).attr('data-id'), 'block');
});
