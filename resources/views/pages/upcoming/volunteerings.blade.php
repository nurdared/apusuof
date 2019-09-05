@extends('layouts/app')
@section('content')
@include('inc.callendar')

<h1 class="mb-4 mt-2">Volunteering</h1>
{{-- Search form --}}
<form action="/volunteering/search" method="GET" role="search">
   
    <div class="form-group">
        <input type="search" class="form-control float-left w-25" name="search"
            placeholder="Search Event"> <span class="form-group-item">
            <button type="submit" class="ml-2 btn btn-dark">
                Search
            </button>
        </span>
    </div>
</form>

@forelse ($events as $event)
@if($event->invitations->where('email', auth()->user()->email)->count() > 0)
    <div class="row mb-4">
        <div class="card border-danger">
            <div class="row ">
                <div class="col-md-2">
                    <img src="/admin/public/images/{{$event->poster}}" class="img img-fluid" alt="">
                </div>
                <div class="col-md-5">
                    <div class="card-block px-3">
                        <h4 class="card-title font-weight-bold mt-2">{{$event->name}}</h4>
                        <h5 class="card-title font-weight-bold mt-2">&nbsp<i class="fas fa-map-marker-alt"></i>&nbsp&nbsp{{$event->location}}</h5>
                        <h5 class="card-title font-weight-bold mt-1"><i class="fas fa-users"></i> Current Number of Volunteers: {{$event->volunteers->where('approved_at')->count()}}</h5>
                        @if ($event->volunteers->where('user_id', auth()->user()->id)->where('event_id', $event->id)->count() > 0)
                            @if ($event->volunteers->where('user_id', auth()->user()->id)->where('event_id', $event->id)->first()->approved_at != null)
                                <a href="#" class="btn btn-md mt-2 btn-success mr-2"><i class="fas fa-check-circle"></i> Approved</a>
                                <a href="{{ route('volunteer.show', [$event->id]) }}" class="btn btn-md mt-2 btn-primary"><i class="fas fa-info-circle"></i> Details</a>
                            @else
                                <a href="#" class="btn btn-md mt-2 btn-warning"><i class="fas fa-clock"></i> Waiting Approval</a>
                            @endif
                        @else
                            <a href="{{ route('volunteer.send', [$event->id]) }}" class="btn btn-md mt-2 btn-primary "><i class="fas fa-users"></i> Be Volunteer</a>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 m-auto align-center">
                    <div class="text-center date-body float-right rounded" style="width:200px">
                        <label for="" class="date-title h5 m-auto p-2"> {{ \Carbon\Carbon::parse($event->event_date)->format('M') }}, {{ \Carbon\Carbon::parse($event->event_date)->year }}</label>
                        <div class="date-content">
                            <p class="dia">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</p>
                            <hr class="nomargin" />
                            <p class="nomargin"><strong>{{ \Carbon\Carbon::parse($event->event_date)->englishDayOfWeek }} | {{ \Carbon\Carbon::parse($event->event_date)->format('g:i A') }} </strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif

@empty
    <h1>No Upcoming Volunteering Events</h1>
@endforelse


@endsection