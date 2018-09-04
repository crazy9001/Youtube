@extends('bases::layouts.master')

@section('content')
    <div id="groups-screen">

        <div class="page-header"></div>
        <div class="breadcrumbs">
            <h2>Nhóm Video <a class="label opac5" href="#createNewGroup" data-toggle="modal">+ add new</a></h2>
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
                            <th>Số lượng video</th>
                            <th><input type="checkbox" data-skin="square" data-color="blue" id="select_all_group"></th>
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

    <div class="clearfix"></div>

    <div id="stack-controls" class="list-controls scroll-to-fixed-fixed">
        <div class="btn-toolbar pull-right" style=" padding-top: 5px">
            <div class="btn-group dropup">
                <button name="Submit" value="Trash selected" class="btn btn-small btn-danger btn-strong" id="trashVideoSelected">Delete</button>
            </div>
            <input type="hidden" name="filter" id="listing-filter" value="added">
            <input type="hidden" name="fv" id="listing-filter_value" value="desc">
        </div>
    </div>

    <div id="createNewGroup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 id="myModalLabel">Add Group</h3>
                </div>
                <!-- /.modal-header -->
                <div class="modal-body" style="padding: 0px">
                    <form action="#" method="POST" class='form-horizontal form-bordered'>
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label for="textfield" class="control-label col-sm-2 required">Tên nhóm</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên nhóm">
                                @if ($errors->has('name'))
                                    <span id="username-error" class="help-block has-error">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('parent_id')) has-error @endif">
                            <label for="select" class="control-label col-sm-2 required">Nhóm cha</label>
                            <div class="col-sm-10">
                                {!! Form::select('parent_id', $groups_parent, old('parent_id'), ['class' => 'form-control', 'id' => 'parent_id']) !!}
                                @if ($errors->has('parent_id'))
                                    <span id="username-error" class="help-block has-error">{{ $errors->first('parent_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('tags')) has-error @endif">
                            <label for="textfield" class="control-label col-sm-2 required">Tags</label>
                            <div class="col-sm-10">
                                <input type="text" name="tags" id="tags" class="tagsinput form-control" value="">
                                @if ($errors->has('tags'))
                                    <span id="username-error" class="help-block has-error">{{ $errors->first('tags') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('note')) has-error @endif">
                            <label for="textfield" class="control-label col-sm-2 required">Ghi chú</label>
                            <div class="col-sm-10">
                                {!! Form::textarea('note', isset($groups->id) && !empty($groups->note) ? $groups->note : '',['id'=>'note', 'class'=>'textarea-embed', 'cols' => '', 'rows' => '']) !!}
                            </div>
                        </div>

                    </form>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add-new-group">Add</button>
                </div>
                <!-- /.modal-footer -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@stop
@section('javascript')
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
            $(document).on("click", ".btn-add-new-group", function () {
                var name = $("input[name=name]").val();
                var parent_id = $('#parent_id').val();
                var tags = $("input[name=tags]").val();
                var note = CKEDITOR.instances['note'].getData()
                $.ajax({
                    type: "POST",
                    url: "{{ route('group.create') }}",
                    data: { name : name, parent_id : parent_id, tags: tags, note: note},
                    success: function(result){
                        if(result.success == true){
                            Youtube.showNotice('success', result.message, Youtube.languages.notices_msg.success);
                            $('#createNewGroup').modal('hide')
                            $("input[name=name]").val('');
                            $("input[name=tags]").val('');
                            window.setTimeout(function(){location.reload()},2000)
                        }
                    },
                    beforeSend: function(){

                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        xhr = jQuery.parseJSON(xhr.responseText);
                        Youtube.showNotice('error', xhr.data, xhr.message);
                    },
                });
            });

            CKEDITOR.replace( 'note' );

            var checkboxes = $('#dataGroups').find(':checkbox');
            $('#select_all_group').change(function() {
                checkboxes.prop('checked', $(this).is(':checked'));
            });

        });

    </script>
@stop