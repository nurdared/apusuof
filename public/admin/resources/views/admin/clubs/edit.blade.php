@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.clubs.title')</h3>
    
    {!! Form::model($club, ['method' => 'PUT', 'route' => ['admin.clubs.update', $club->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('club_name', trans('quickadmin.clubs.fields.club-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('club_name', old('club_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('club_name'))
                        <p class="help-block">
                            {{ $errors->first('club_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('club_description', trans('quickadmin.clubs.fields.club-description').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('club_description', old('club_description'), ['class' => 'form-control editor', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('club_description'))
                        <p class="help-block">
                            {{ $errors->first('club_description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('club_timetable', trans('quickadmin.clubs.fields.club-timetable').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('club_timetable', old('club_timetable'), ['class' => 'form-control editor', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('club_timetable'))
                        <p class="help-block">
                            {{ $errors->first('club_timetable') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($club->club_logo)
                        <a href="{{ asset('/images'.$club->club_logo) }}" target="_blank"><img src="{{ asset('/images/thumb/'.$club->club_logo) }}"></a>
                    @endif
                    {!! Form::label('club_logo', trans('quickadmin.clubs.fields.club-logo').'*', ['class' => 'control-label']) !!}
                    {!! Form::file('club_logo', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('club_logo_max_size', 2) !!}
                    {!! Form::hidden('club_logo_max_width', 4096) !!}
                    {!! Form::hidden('club_logo_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('club_logo'))
                        <p class="help-block">
                            {{ $errors->first('club_logo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('quickadmin.clubs.fields.user').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('category_id', trans('quickadmin.clubs.fields.category').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_id'))
                        <p class="help-block">
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop