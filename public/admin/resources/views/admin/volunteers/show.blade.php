@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.volunteers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.volunteers.fields.event')</th>
                            <td field-key='event'>{{ $volunteer->event->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.volunteers.fields.user')</th>
                            <td field-key='user'>{{ $volunteer->user->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.volunteers.fields.sent-at')</th>
                            <td field-key='sent_at'>{{ $volunteer->sent_at }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.volunteers.fields.approved-at')</th>
                            <td field-key='approved_at'>{{ $volunteer->approved_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.volunteers.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

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
