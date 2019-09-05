@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.clubs.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.clubs.fields.club-name')</th>
                            <td field-key='club_name'>{{ $club->club_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.clubs.fields.club-description')</th>
                            <td field-key='club_description'>{!! $club->club_description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.clubs.fields.club-timetable')</th>
                            <td field-key='club_timetable'>{!! $club->club_timetable !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.clubs.fields.club-logo')</th>
                            <td field-key='club_logo'>@if($club->club_logo)<a href="{{ asset('/images' . $club->club_logo) }}" target="_blank"><img src="{{ asset('/images/thumb/' . $club->club_logo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.clubs.fields.user')</th>
                            <td field-key='user'>{{ $club->user->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.clubs.fields.category')</th>
                            <td field-key='category'>{{ $club->category->category_name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#updates" aria-controls="updates" role="tab" data-toggle="tab">Updates</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="updates">
<table class="table table-bordered table-striped {{ count($updates) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.updates.fields.update-title')</th>
                        <th>@lang('quickadmin.updates.fields.update-image')</th>
                        <th>@lang('quickadmin.updates.fields.user')</th>
                        <th>@lang('quickadmin.updates.fields.club')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($updates) > 0)
            @foreach ($updates as $update)
                <tr data-entry-id="{{ $update->id }}">
                    <td field-key='update_title'>{{ $update->update_title }}</td>
                                <td field-key='update_image'>@if($update->update_image)<a href="{{ asset('/images' . $update->update_image) }}" target="_blank"><img src="{{ asset('/images/thumb/' . $update->update_image) }}"/></a>@endif</td>
                                <td field-key='user'>{{ $update->user->name ?? '' }}</td>
                                <td field-key='club'>{{ $update->club->club_name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('update_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.updates.restore', $update->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('update_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.updates.perma_del', $update->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('update_view')
                                    <a href="{{ route('admin.updates.show',[$update->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('update_edit')
                                    <a href="{{ route('admin.updates.edit',[$update->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('update_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.updates.destroy', $update->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.clubs.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
