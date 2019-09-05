@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.categories.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.categories.fields.category-name')</th>
                            <td field-key='category_name'>{{ $category->category_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.categories.fields.category-body')</th>
                            <td field-key='category_body'>{!! $category->category_body !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.categories.fields.user')</th>
                            <td field-key='user'>{{ $category->user->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.categories.fields.category-image')</th>
                            <td field-key='category_image'>@if($category->category_image)<a href="{{ asset('/images'. $category->category_image) }}" target="_blank"><img src="{{ asset('/images/thumb/' . $category->category_image) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#clubs" aria-controls="clubs" role="tab" data-toggle="tab">Clubs</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="clubs">
<table class="table table-bordered table-striped {{ count($clubs) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.clubs.fields.club-name')</th>
                        <th>@lang('quickadmin.clubs.fields.club-logo')</th>
                        <th>@lang('quickadmin.clubs.fields.user')</th>
                        <th>@lang('quickadmin.clubs.fields.category')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($clubs) > 0)
            @foreach ($clubs as $club)
                <tr data-entry-id="{{ $club->id }}">
                    <td field-key='club_name'>{{ $club->club_name }}</td>
                                <td field-key='club_logo'>@if($club->club_logo)<a href="{{ asset('/images'. $club->club_logo) }}" target="_blank"><img src="{{ asset('/images/thumb/' . $club->club_logo) }}"/></a>@endif</td>
                                <td field-key='user'>{{ $club->user->name ?? '' }}</td>
                                <td field-key='category'>{{ $club->category->category_name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('club_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.clubs.restore', $club->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('club_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.clubs.perma_del', $club->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('club_view')
                                    <a href="{{ route('admin.clubs.show',[$club->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('club_edit')
                                    <a href="{{ route('admin.clubs.edit',[$club->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('club_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.clubs.destroy', $club->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
