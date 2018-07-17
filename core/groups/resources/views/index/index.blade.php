@extends('bases::layouts.master')

@section('content')
    <div class="page-header"></div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="{{ route('dashboard.index') }}">Bảng điều khiển</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ route('group.index') }}">Danh sách nhóm</a>
            </li>
        </ul>
    </div>

    <div class="row">

        <div class="col-sm-9">

            <div class="box box-color box-bordered">

                <div class="box-title">
                    <h3>
                        <i class="fa fa-th-list"></i>Danh sách tất cả nhóm
                    </h3>
                </div>

                <div class="box-content">
                    <div class="dd" id="nestable">
                        {!! $html !!}
                    </div>
                </div>

            </div>
        </div>

    </div>


@stop
@section('javascript')
    {{--<script>
        $(document).ready(function () {
            $("#browser").treeview();
        });
    </script>--}}
    <script>
        $(document).ready(function () {
            $("#load").hide();
            $("#submit").click(function () {
                $("#load").show();

                var dataString = {
                    label: $("#label").val(),
                    link: $("#link").val(),
                    id: $("#id").val()
                };

                $.ajax({
                    type: "POST",
                    url: "save_menu.php",
                    data: dataString,
                    dataType: "json",
                    cache: false,
                    success: function (data) {
                        if (data.type == 'add') {
                            $("#menu-id").append(data.menu);
                        } else if (data.type == 'edit') {
                            $('#label_show' + data.id).html(data.label);
                            $('#link_show' + data.id).html(data.link);
                        }
                        $('#label').val('');
                        $('#link').val('');
                        $('#id').val('');
                        $("#load").hide();
                    }, error: function (xhr, status, error) {
                        alert(error);
                    },
                });
            });

            $('.dd').on('change', function () {
                $("#load").show();

                var dataString = {
                    data: $("#nestable-output").val(),
                };

                $.ajax({
                    type: "POST",
                    url: "save.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        $("#load").hide();
                    }, error: function (xhr, status, error) {
                        alert(error);
                    },
                });
            });

            $("#save").click(function () {
                $("#load").show();

                var dataString = {
                    data: $("#nestable-output").val(),
                };

                $.ajax({
                    type: "POST",
                    url: "save.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        $("#load").hide();
                        alert('Data has been saved');

                    }, error: function (xhr, status, error) {
                        alert(error);
                    },
                });
            });


            $(document).on("click", ".del-button", function () {
                var x = confirm('Delete this menu?');
                var id = $(this).attr('id');
                if (x) {
                    $("#load").show();
                    $.ajax({
                        type: "POST",
                        url: "delete.php",
                        data: {id: id},
                        cache: false,
                        success: function (data) {
                            $("#load").hide();
                            $("li[data-id='" + id + "']").remove();
                        }, error: function (xhr, status, error) {
                            alert(error);
                        },
                    });
                }
            });

            $(document).on("click", ".edit-button", function () {
                var id = $(this).attr('id');
                var label = $(this).attr('label');
                var link = $(this).attr('link');
                $("#id").val(id);
                $("#label").val(label);
                $("#link").val(link);
            });

            $(document).on("click", "#reset", function () {
                $('#label').val('');
                $('#link').val('');
                $('#id').val('');
            });

        });

    </script>
@stop