jQuery('input[type=file]').change(function () {
    let filename = jQuery(this).val().split('\\').pop();
    let idname = jQuery(this).attr('id');
    jQuery('span.' + idname).next().find('span').html(filename);
});

