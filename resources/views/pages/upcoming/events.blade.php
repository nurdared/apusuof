@extends('layouts/app')
@section('content')
@include('inc.callendar')

<h1 class="mt-2 mb-4">Upcoming Events</h1>
{{-- Search form --}}
<form action="/events/search" method="GET" role="search">
   
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
            <div class="row no-gutters">
                <div class="col-md-2">
                    <img src="/admin/public/images/{{$event->poster}}" class="img img-fluid" alt="">
                </div>
                <div class="col-md-7">
                    <div class="card-block px-3">
                        <h4 class="card-title font-weight-bold mt-2">{{$event->name}}</h4>
                        <p class="card-text text-justify">{!!$event->description!!}</p>
                        <h5 class="card-title font-weight-bold mt-2"><i class="fas fa-map-marker-alt"></i> {{$event->location}}</h5>
                        @if ($event->invitations->where('email', auth()->user()->email)->first()->accepted_at == null && $event->invitations->where('email', auth()->user()->email)->first()->rejected_at == null)
                            <a href="{{ route('invitations.send', [$event->invitations->where('email', auth()->user()->email)->first()->id, 'join']) }}" class="btn btn-sm btn-success mr-2"><i class="fas fa-check-circle"></i> Join</a>
                            <a href="{{ route('invitations.send', [$event->invitations->where('email', auth()->user()->email)->first()->id, 'declin']) }}" class="btn btn-sm btn-danger mr-2"><i class="fas fa-times-circle"></i> Decline</a>
                        @elseif($event->invitations->where('email', auth()->user()->email)->first()->accepted_at != null)
                            <a href="#" class="btn btn-sm btn-success mr-2"><i class="fas fa-check-circle"></i> Joined</a>
                        @else
                            <a href="#" class="btn btn-sm btn-danger mr-2"><i class="fas fa-times-circle"></i> Declined</a>
                        @endif

                        

                    </div>
                </div>
                <div class="col-md-3 m-auto align-center">
                    <div class="text-center date-body float-right mr-5 rounded" style="width:200px">
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
    <h1>No Upcoming Events</h1>
@endforelse

    {{-- <div class="row mb-4">
            <div class="card border-danger">
                <div class="row no-gutters">
                    <div class="col-md-2">
                        <img src="/storage/images/Music-party.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-md-7">
                        <div class="card-block px-3">
                            <h4 class="card-title font-weight-bold mt-2">Title</h4>
                            <p class="card-text text-justify">In publishing and graphic design, Lorem ipsum is a placeholder
                                text commonly used to demonstrate the visual form of a document without relying on meaningful
                                content. Replacing the actual content with placeholder text allows designers to design the form
                                of the content before the content itself has been produced.</p>
                            <h5 class="card-title font-weight-bold mt-2">Location:</h5>
                            <a href="#" class="btn btn-sm btn-success mr-2">Accept</a>
                            <a href="#" class="btn btn-sm btn-danger">Reject</a>
                        </div>
                    </div>
                    <div class="col-md-3 m-auto align-center">
                        <div class="text-center date-body float-right mr-5 rounded" style="width:200px">
                            <label for="" class="date-title h5 m-auto p-2">{{ $date->monthName }}, {{ $date->year }}</label>
                            <div class="date-content">
                                <p class="dia">{{ $date->format('d') }}</p>
                                <hr class="nomargin" />
                                <p class="nomargin"><strong>{{ $date->englishDayOfWeek }} | {{ $date->format('g:i A') }} </strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    



@endsection