@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.updates.title')</h3>
    
    {!! Form::model($update, ['method' => 'PUT', 'route' => ['admin.updates.update', $update->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('update_title', trans('quickadmin.updates.fields.update-title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('update_title', old('update_title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('update_title'))
                        <p class="help-block">
                            {{ $errors->first('update_title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('update_body', trans('quickadmin.updates.fields.update-body').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('update_body', old('update_body'), ['class' => 'form-control editor', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('update_body'))
                        <p class="help-block">
                            {{ $errors->first('update_body') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($update->update_image)
                        <a href="{{ asset('/images'.$update->update_image) }}" target="_blank"><img src="{{ asset('/images/thumb/'.$update->update_image) }}"></a>
                    @endif
                    {!! Form::label('update_image', trans('quickadmin.updates.fields.update-image').'*', ['class' => 'control-label']) !!}
                    {!! Form::file('update_image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('update_image_max_size', 2) !!}
                    {!! Form::hidden('update_image_max_width', 4096) !!}
                    {!! Form::hidden('update_image_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('update_image'))
                        <p class="help-block">
                            {{ $errors->first('update_image') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('quickadmin.updates.fields.user').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('club_id', trans('quickadmin.updates.fields.club').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('club_id', $clubs, old('club_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('club_id'))
                        <p class="help-block">
                            {{ $errors->first('club_id') }}
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