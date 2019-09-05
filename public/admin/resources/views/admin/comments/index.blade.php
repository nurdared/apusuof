@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.comments.title')</h3>
    @can('comment_create')
    <p>
        
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($comments) > 0 ? 'datatable' : '' }} @can('comment_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('comment_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.comments.fields.user')</th>
                        <th>@lang('quickadmin.users.fields.username')</th>
                        <th>@lang('quickadmin.comments.fields.commentable-type')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($comments) > 0)
                        @foreach ($comments as $comment)
                            <tr data-entry-id="{{ $comment->id }}">
                                @can('comment_delete')
                                    <td></td>
                                @endcan

                                <td field-key='user'>{{ $comment->user->name ?? '' }}</td>
<td field-key='username'>{{ isset($comment->user) ? $comment->user->username : '' }}</td>
                                <td field-key='commentable_type'>{{ $comment->commentable_type }}</td>
                                                                <td>
                                    @can('comment_view')
                                    <a href="{{ route('admin.comments.show',[$comment->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('comment_edit')
                                    <a href="{{ route('admin.comments.edit',[$comment->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('comment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.comments.destroy', $comment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('comment_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.comments.mass_destroy') }}';
        @endcan

    </script>
@endsection