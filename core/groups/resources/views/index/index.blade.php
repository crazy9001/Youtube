@extends('bases::layouts.master')

@section('content')
    <div id="groups-screen">

        <div class="page-header"></div>
        <div class="breadcrumbs">
            <h2>Nhóm Video <a class="label opac5" href="#addVideo" data-toggle="modal">+ add new</a></h2>
        </div>

        <div class="row">

            <div class="col-sm-12">

                <div class="portlet-title">
                    <div class="row-fluid">
                        <div class="span8">
                            <div class="pull-left">
                                {!! Form::open(array('route' => 'group.index', 'method'=>'get','class'=>'form-search-listing form-inline')) !!}
                                <div class="input-append">
                                    {!! Form::text('search', isset($filters['search']) && !empty($filters['search']) ? $filters['search'] : '' ,array('id' => 'form-search-input','placeholder'=>'Nhập tên nhóm', 'class' => 'search-query search-quez input-medium placeholder', 'autocomplete' => 'off', 'style' => 'width:250px !important')) !!}
                                    <button type="submit" class="btn" id="submitFind">
                                        <i class="icon-search findIcon"></i>
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="box-content nopadding portlet light" id="showListGroups">

                    <table class="table table-bordered" id="list_groups">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên nhóm</th>
                            <th>Tags</th>
                            <th>Ghi chú</th>
                            <th>Display</th>
                            <th>Chọn</th>
                        </tr>
                        </thead>
                        <tbody id="dataGroups">
                            {!! $html !!}
                        </tbody>
                    </table>

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