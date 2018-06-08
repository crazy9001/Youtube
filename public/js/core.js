var Youtube = Youtube || {};
var GlobalLinkYoutube = 'http://youtube.com/';
Youtube.GlobalLinkChannelYoutube = GlobalLinkYoutube + 'channel/';
Youtube.showNotice = function (e, n, t) {
    toastr.options = {
        closeButton: !0,
        positionClass: "toast-bottom-right",
        onclick: null,
        showDuration: 1e3,
        hideDuration: 1e3,
        timeOut: 1e4,
        extendedTimeOut: 1e3,
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    }, toastr[e](n, t)
},
Youtube.icheck = function () {
    if ($(".icheck-me").length > 0) {
        $(".icheck-me").each(function () {
            var $el = $(this);
            var skin = ($el.attr('data-skin') !== undefined) ? "_" + $el.attr('data-skin') : "",
                color = ($el.attr('data-color') !== undefined) ? "-" + $el.attr('data-color') : "";

            var opt = {
                checkboxClass: 'icheckbox' + skin + color,
                radioClass   : 'iradio' + skin + color,
                increaseArea : "10%"
            }

            $el.iCheck(opt);
        });
    }
}