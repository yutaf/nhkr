var switch_content = {
    init: function() {
        $(document).on('click', 'a.switch_content', function(e){
            e.preventDefault();
            if ($(this).hasClass('switch_content_selected')) {
                return false;
            }
            $('.switch_content').toggleClass('switch_content_selected');
            $('.form').toggleClass('hide');
        });
    }
};
$(document).ready(function(){
    switch_content.init();
});