$(function () {

    // vars
    $body = $('body');

    // layout functions
    function resizeAuthMainSidebar() {

        $('.main-sidebar').height($('.content-wrapper > .content.container-fluid').outerHeight());

    }

    if($body.hasClass('login-page') || $body.hasClass('register-page')) {

        // trigger the resize first
        resizeAuthMainSidebar();

        // fix the sidebar height
        $(window).resize(function () {

            setTimeout(resizeAuthMainSidebar, 500);

        });

    }

    // enable toggle sidebar functionality
    $('[data-toggle="control-sidebar"]').controlSidebar();


});