@extends('layouts.app')

@section('profile')
<div class="m-4">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 mx-auto">
            <img src="/storage/images/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->name }}'s Profile</h2><br>

            @if ($user->id == auth()->user()->id)                
                <form enctype="multipart/form-data" action="/profile" method="POST">
                    <label class="btn btn-sm btn-outline-primary mt-4"  for="avatar"><strong>Update Profile Image</strong></label><br>
                    <input style="	
                        width: 0.1px;
                        height: 0.1px;
                        opacity: 0;
                        overflow: hidden;
                        position: absolute;
                        z-index: -1;" 
                    id="avatar" type="file" name="avatar">
                
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="float-right btn btn-sm btn-primary">
                </form>
            @endif


        </div>
        <table class="table table-hover col-md-10 col-md-offset-1 mx-auto mt-5">
            <tr>
                <th><strong>Name:</strong></th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th><strong>Age:</strong></th>
                <td>{{ $user->age }}</td>
            </tr>
            <tr>
                <th><strong>Student Number:</strong></th>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <th><strong>E-mail Adress:</strong></th>
                <td><span class="fas fa-envelope"></span> {{ $user->email }}</td>
            </tr>    
            <tr>
                <th><strong>Contact Number:</strong></th>
                <td><span class="fas fa-address-book"></span> {{ $user->contact }}</td>
            </tr>
            <tr>
                <td></td>
                @if ($user->id == auth()->user()->id)                
                <td><a href="{{route('editprofile')}}" class="float-right btn btn-sm btn-warning">Edit Details</a></td>
                @endif
            </tr>
            
        </table>
    </div>
</div>
@endsection

@section('profilecontent')
    <div class="mt-4">
    
        <h3 id='questions'><i class="fas fa-chevron-right"></i> Asked Questions</h3>
    
        @forelse($threads as $thread)
            <h5 class='questions' style='display:none;'><a href="{{route('thread.show',$thread->id)}}">{{$thread->subject}}</a></h5>
    
        @empty
            <h5 class='questions' style='display:none;'>No Questions yet</h5>
    
        @endforelse
        <br>
        <hr>
    
        <h3 id="comments"><i class="fas fa-chevron-right"></i> Latest Comments</h3>
    
        @forelse($comments as $comment)
            <h5 class="comments" style='display:none;'>{{$user->name}} commented on <a href="{{route('thread.show',$comment->commentable->id)}}">{{$comment->commentable->subject}}</a>  {{$comment->created_at->diffForHumans()}}</h5>
        @empty
        <h5 class="comments" style='display:none;'>No comments yet</h5>
        @endforelse

        @if(auth()->user() == $user)
            
            <br><hr>
            <h3 id="events"><i class="fas fa-chevron-right"></i> Joined Events</h3>
            @forelse($events as $event)
                <h5 class="events" style='display:none;'> <a href="/events/search?search={{$event->event->name}}">{{$event->event->name}}</a>  {{$event->event->event_date}}</h5>
            @empty
                <h5 class="events" style='display:none;'>No Events Joined</h5>
            @endforelse

            <br><hr>
            <h3 id="volunteers"><i class="fas fa-chevron-right"></i> Joined As a Volunteer</h3>
            @forelse($volunteers as $volunteer)
                <h5 class="volunteers" style='display:none;'> <a href="/volunteering/{{$volunteer->event->id}}">{{$volunteer->event->name}}</a>  {{$volunteer->event->event_date}}</h5>
            @empty
                <h5 class="volunteers" style='display:none;'>No Joined Volunteering</h5>
            @endforelse

            
        @endif

    </div>
@endsection
@section('js')
<script>

    $("#questions").click(function(){
        $(".questions").toggle();
        $("i", this).toggleClass("fas fa-chevron-right fas fa-chevron-down");
    });

    $("#comments").click(function(){
        $(".comments").toggle();
        $("i", this).toggleClass("fas fa-chevron-right fas fa-chevron-down");
    });
    $("#events").click(function(){
        $(".events").toggle();
        $("i", this).toggleClass("fas fa-chevron-right fas fa-chevron-down");
    });
    $("#volunteers").click(function(){
        $(".volunteers").toggle();
        $("i", this).toggleClass("fas fa-chevron-right fas fa-chevron-down");
    });

</script>
@endsection