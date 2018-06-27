var Youtube = Youtube || {};
var GlobalLinkYoutube = 'http://youtube.com/';
var baseUrl = 'http://' + $(location).attr('host');
var ChannelURL = baseUrl + '/admin/channel/';
var APIGetListChannelURL = ChannelURL + 'ListChannel';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
Youtube.GlobalLinkChannelYoutube = GlobalLinkYoutube + 'channel/';
$(document).ready( function () {
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
    },
    Youtube.getJsonData = function (url, _callback) {
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                _callback(data);
            },
        });
    },
    Youtube.parseDataChannel = function(data){
        var row = '';
        var paginate = '';
        $.each(data.data.data, function (i, item) {
            var count_video = (item.count_video === null) || (item.count_video === '') ? '<img src="../img/loading-update.svg">' : item.count_video;
            var note_channel = (item.note === null) || (item.note === '') ? '<img src="../img/loading-update.svg">' : item.note;
            var last_update = (item.last_update === null) || (item.last_update === '') ? '<img src="../img/loading-update.svg">' : item.last_update;
            row += '<tr>' +
                '<td class="table-checkbox hidden-480 table-stt"> ' + i + ' </td>' +
                '<td> <a href="' + Youtube.GlobalLinkChannelYoutube + item.id_channel + '" target="_blank"> <img src="' + item.images + '" width="50px" style="border: 1px solid #ff4433; border-radius:50%"> </a></td>' +
                '<td><a href="#" id="nameChannel" data-type="text" data-pk="' + item.id + '" data-name="' + item.name + '" class="editable">' + item.name + '</a></td>' +
                '<td class="hidden-480"> <a href="' + Youtube.GlobalLinkChannelYoutube + item.id_channel + '" target="_blank">' + item.id_channel + '</a></td>' +
                '<td class="hidden-480" id="lastUpdateChannel"> ' + last_update + ' </td>' +
                '<td class="hidden-480" id="countVideo"> ' + count_video + ' </td>' +
                '<td class="hidden-480"> <a href="#" id="noteChannel" data-type="textarea" data-pk="' + item.id + '"> ' + note_channel + '</a> </td>' +
                '<td class="hidden-480" style="text-align: center">' +
                '<input type="checkbox" id="c5" class="selectable" data-skin="square" data-color="blue" name="selector[]" value="' + item.id + '">' +
                '</td>' +
                '</tr>';
        });
        $('#dataChannel').html(row);
        if(Boolean(data.data.prev_page_url) || Boolean(data.data.next_page_url)){
            paginate += '<ul class="pager" style="text-align: right">' +
                '                                        <li '+ (Boolean(data.data.prev_page_url) ? '' : 'class="disabled"' )+'>' +
                '                                            <a href="javascript:void(0)" data-link="' + data.data.prev_page_url + '">←</a>' +
                '                                        </li>' +
                '                                         <li '+ (Boolean(data.data.next_page_url) ? '' : 'class="disabled"' )+'>' +
                '                                            <a href="javascript:void(0)" data-link="' + data.data.next_page_url + '">→</a>' +
                '                                        </li>' +
                '                                    </ul>';
        }else{
            paginate += '';
        }
        $('#paginateChannel').html(paginate);
    };

});


