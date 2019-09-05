@extends('layouts/app')
@section('content')
@include('inc.callendar')

<h1 class="mb-4 mt-2">Volunteering | {{$event->name}}</h1>


@if($event->invitations->where('email', auth()->user()->email)->count() > 0)
    <div class="row mb-4">
        <div class="w-100">
            <div class="row ">
                <div class="col-2">
                    <img src="/admin/public/images/{{$event->poster}}" class="img img-fluid rounded" alt="">
                </div>
                <div class="col-7">
                    <div class="card-block px-3">
                        <h5 class="card-title font-weight-bold mt-2"><i class="fas fa-users"></i> Current Number of Volunteers: {{$event->volunteers->where('approved_at')->count()}}</h5>
                        <h5 class="card-title font-weight-bold mt-2">&nbsp<i class="fas fa-map-marker-alt"></i>&nbsp&nbsp{{$event->location}}</h5>
                        <h5 class="card-title font-weight-bold mt-2"><i class="fas fa-info-circle"></i> Information:</h5>
                        <p class="text-justify">{!! $event->information !!}</p>
                    </div>
                </div>
                <div class="col-3  align-center">
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
    <hr>
@endif

<h3 class="mb-4">Discussions</h3>
{{-- Comment Section --}}
{{-- Enter Comment Section --}}
<div class="card-body m-auto">
    <div class="row">
        <div class="col-md-2">
            <img src="/storage/images/avatars/{{ auth()->user()->avatar }}" class="img rounded-circle img-fluid float-right" style="height: 7em" />
        </div>
        <div class="col-md-8">
            <p>
                <a class="float-left h5" href="/profile"><strong>{{ auth()->user()->name }}</strong></a>
            </p>
            <div class="clearfix"></div>
            <p>
                <div class="comment-form">
                    <form action="{{route('eventcomment.store', $event->id)}}" method="post" role="form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea class="form-control" name="body" placeholder="Enter Comment..."></textarea>
                        </div>

                        <button type="submit" class="float-right btn btn-sm btn-primary">Comment</button>
                    </form>
                </div>
            </p>
        </div>
    </div>
</div>
{{-- Comments --}}
<hr> 
{{--Answer/comment--}}
<div class="comment-list">
    @include('pages.upcoming.comment-list')
</div>
<br><br>



@endsection