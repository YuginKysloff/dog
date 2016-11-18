// Функция Ajax
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
                $(before_id).addClass('js-process');
            }
        },
        success: function(response) {
            $.each(response, function(i, val) {
                $('#'+i).html(val);
            });
        },
        error: function(response) {
            messager('error', 'Unknown error');
        },
        complete: function () {
            st_process[ident] = true;
            if(before_id) {
                $(before_id).removeClass('js-process');
            }
        }
    });
}

// launch fancybox
if($('.fancybox').length != 0) {
    $(".fancybox").fancybox();
}

// log_view
$('#log__list').on('click', '.log__login', function() {
    $('input[name=query]').val($(this).text());
});
$('select[name=per_page]').on('change', function() {
    location.href='/admin/log/'+$('select[name=per_page]').val()+'/'+$('input[name=query]').val();
});

// warning_view
$('#warn__list').on('click', '.warn__login', function() {
    $('input[name=query]').val($(this).text());
});
$('#warn__list').on('click', '.warn__ip', function() {
    $('input[name=query]').val($(this).text());
});

//$('#users__list').on('click', '.users__group', function(){
//    process('/admin/users/change_status/'+$(this).attr('data-group')+'/'+$(this).attr('data-id'), 'block');
//});
