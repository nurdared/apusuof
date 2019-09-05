@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.thread.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.thread.fields.subject')</th>
                            <td field-key='subject'>{{ $thread->subject }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.thread.fields.thread')</th>
                            <td field-key='thread'>{!! $thread->thread !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.thread.fields.type')</th>
                            <td field-key='type'>{{ $thread->type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.thread.fields.user')</th>
                            <td field-key='user'>{{ $thread->user->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.threads.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
