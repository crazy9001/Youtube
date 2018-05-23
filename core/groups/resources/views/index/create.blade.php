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
                <a href="{{ route('group.index') }}">Nhóm</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ route('group.create') }}">Thêm nhóm mới</a>
            </li>
        </ul>
    </div>
    {!! Form::open(['class' => 'form-horizontal form-bordered']) !!}
    <div class="row">

        <div class="col-sm-9">

            <div class="box box-color box-bordered">

                <div class="box-title">
                    <h3>
                        <i class="fa fa-th-list"></i>Thông tin cơ bản
                    </h3>
                </div>

                <div class="box-content nopadding">


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
                                {!! Form::select('parent_id', $groups, old('parent_id'), ['class' => 'form-control', 'id' => 'parent_id']) !!}
                                @if ($errors->has('parent_id'))
                                    <span id="username-error" class="help-block has-error">{{ $errors->first('parent_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('tags')) has-error @endif">
                            <label for="textfield" class="control-label col-sm-2 required">Tags</label>
                            <div class="col-sm-10">
                                <input type="text" name="tags" id="tags" class="tagsinput form-control" value="">
                                <span class="label label-info">Mỗi tag cách nhau bởi phím "enter"</span>
                                @if ($errors->has('tags'))
                                    <span id="username-error" class="help-block has-error">{{ $errors->first('tags') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('icon')) has-error @endif">
                            <label for="textfield" class="control-label col-sm-2">Biểu tượng</label>
                            <div class="col-sm-10">
                                <input type="text" name="icon" id="icon" class="form-control" placeholder="Ví dụ: fa fa-home">
                                @if ($errors->has('icon'))
                                    <span id="username-error" class="help-block has-error">{{ $errors->first('icon') }}</span>
                                @endif
                            </div>
                        </div>

                </div>

            </div>

        </div>


        <div class="col-sm-3">

            @include('bases::elements.form-actions')

        </div>


    </div>
    {!! Form::close() !!}
@stop