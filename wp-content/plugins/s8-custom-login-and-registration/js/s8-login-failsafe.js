jQuery(document).ready(function($) {
    form_item = $('#loginform');
    my_action = form_item.attr('action');
    if(my_action && my_action != '')
        form_item.attr('action', my_action + '?no-redirect=true');
});
