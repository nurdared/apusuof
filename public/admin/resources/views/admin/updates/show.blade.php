@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.updates.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.updates.fields.update-title')</th>
                            <td field-key='update_title'>{{ $update->update_title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.updates.fields.update-body')</th>
                            <td field-key='update_body'>{!! $update->update_body !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.updates.fields.update-image')</th>
                            <td field-key='update_image'>@if($update->update_image)<a href="{{ asset('/images' . $update->update_image) }}" target="_blank"><img src="{{ asset('/images/thumb/' . $update->update_image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.updates.fields.user')</th>
                            <td field-key='user'>{{ $update->user->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.updates.fields.club')</th>
                            <td field-key='club'>{{ $update->club->club_name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.updates.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
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
