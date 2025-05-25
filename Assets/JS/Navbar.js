$(document).ready(function () {
    $('.subitem-menu').click(function (e) {
        $(this).toggleClass('active');
    });
    $('#Menu-btn').click(function (e) {
        $('body').toggleClass('Active-navbar');
        $(this).toggleClass('bx-menu-alt-right bx-x');
    });
});