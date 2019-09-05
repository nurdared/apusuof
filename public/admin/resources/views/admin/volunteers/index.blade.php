@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.volunteers.title')</h3>
    @can('volunteer_create')
    <p>
        <a href="{{ route('admin.volunteers.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($volunteers) > 0 ? 'datatable' : '' }} @can('volunteer_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('volunteer_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.volunteers.fields.event')</th>
                        <th>@lang('quickadmin.volunteers.fields.user')</th>
                        <th>@lang('quickadmin.volunteers.fields.sent-at')</th>
                        <th>@lang('quickadmin.volunteers.fields.approved-at')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($volunteers) > 0)
                        @foreach ($volunteers as $volunteer)
                            <tr data-entry-id="{{ $volunteer->id }}">
                                @can('volunteer_delete')
                                    <td></td>
                                @endcan

                                <td field-key='event'>{{ $volunteer->event->name ?? '' }}</td>
                                <td field-key='user'>{{ $volunteer->user->name ?? '' }}</td>
                                <td field-key='sent_at'>{{ $volunteer->sent_at }}</td>
                                <td field-key='approved_at'>{{ $volunteer->approved_at }}</td>
                                                                <td>
                                    @can('volunteer_view')
                                    @if (!$volunteer->approved_at)
                                    <a href="{{ route('admin.volunteers.approve',[$volunteer->id]) }}" class="btn btn-xs btn-warning">Approve</a>
                                    @else
                                    <a href="{{ route('admin.volunteers.reApprove',[$volunteer->id]) }}" class="btn btn-xs btn-success">Approved</a>  
                                    @endif
                                    <a href="{{ route('admin.volunteers.show',[$volunteer->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('volunteer_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.volunteers.destroy', $volunteer->id])) !!}
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
        @can('volunteer_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.volunteers.mass_destroy') }}';
        @endcan

    </script>
@endsection