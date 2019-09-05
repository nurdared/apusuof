@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.events.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.events.fields.name')</th>
                            <td field-key='name'>{{ $event->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.events.fields.event-date')</th>
                            <td field-key='event_date'>{{ $event->event_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.events.fields.description')</th>
                            <td field-key='description'>{!! $event->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.events.fields.location')</th>
                            <td field-key='location'>{{ $event->location }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.events.fields.poster')</th>
                            <td field-key='poster'>@if($event->poster)<a href="{{ asset('/images' . $event->poster) }}" target="_blank"><img src="{{ asset('/images/thumb/' . $event->poster) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.events.fields.information')</th>
                            <td field-key='information'>{!! $event->information !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.events.fields.quantity')</th>
                            <td field-key='quantity'>{{ $event->quantity }}</td>
                        </tr>
                    </table>
                </div>
            </div>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
    <li role="presentation" class="active"><a href="#volunteers" aria-controls="volunteers" role="tab" data-toggle="tab">Volunteers</a></li>
    <li role="presentation" class=""><a href="#invitations" aria-controls="invitations" role="tab" data-toggle="tab">Invitations</a></li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        
    <div role="tabpanel" class="tab-pane active" id="volunteers">
    <table class="table table-bordered table-striped {{ count($volunteers) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
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
                        <td field-key='event'>{{ $volunteer->event->name ?? '' }}</td>
                                    <td field-key='user'>{{ $volunteer->user->name ?? '' }}</td>
                                    <td field-key='sent_at'>{{ $volunteer->sent_at }}</td>
                                    <td field-key='approved_at'>{{ $volunteer->approved_at }}</td>
                                                                    <td>
                                        @can('volunteer_view')
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
    <div role="tabpanel" class="tab-pane " id="invitations">
    <table class="table table-bordered table-striped {{ count($invitations) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('quickadmin.invitations.fields.event')</th>
                            <th>@lang('quickadmin.invitations.fields.email')</th>
                            <th>@lang('quickadmin.invitations.fields.sent-at')</th>
                            <th>@lang('quickadmin.invitations.fields.accepted-at')</th>
                            <th>@lang('quickadmin.invitations.fields.rejected-at')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($invitations) > 0)
                @foreach ($invitations as $invitation)
                    <tr data-entry-id="{{ $invitation->id }}">
                        <td field-key='event'>{{ $invitation->event->name ?? '' }}</td>
                                    <td field-key='email'>{{ $invitation->email }}</td>
                                    <td field-key='sent_at'>{{ $invitation->sent_at }}</td>
                                    <td field-key='accepted_at'>{{ $invitation->accepted_at }}</td>
                                    <td field-key='rejected_at'>{{ $invitation->rejected_at }}</td>
                                                                    <td>
                                        @can('invitation_view')
                                        <a href="{{ route('admin.invitations.show',[$invitation->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                        @endcan
                                        @can('invitation_edit')
                                        <a href="{{ route('admin.invitations.edit',[$invitation->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                        @endcan
                                        @can('invitation_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                            'route' => ['admin.invitations.destroy', $invitation->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
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
    
                <a href="{{ route('admin.events.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
    
        <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
        <script>
            $(function(){
                moment.updateLocale('{{ App::getLocale() }}', {
                    week: { dow: 1 } // Monday is the first day of the week
                });
                
                $('.datetime').datetimepicker({
                    format: "{{ config('app.datetime_format_moment') }}",
                    locale: "{{ App::getLocale() }}",
                    sideBySide: true,
                });
                
            });
        </script>
                
    @stop