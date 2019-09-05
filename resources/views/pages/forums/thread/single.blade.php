@extends('layouts.forum') 
@section('content')
<div class="card card-body bg-light border-primary mt-5">
    <h2>{{$thread->subject}}</h2>
    <div class="thread-details">
        <p>{!! $thread->thread !!}</p>
    </div>
    <hr>
    <small><a href="/student_profile/{{$thread->user->id}}">{{$thread->user->name}}</a> | {{$thread->created_at->diffForHumans()}}</small>
    <br>

    <div class="actions">
        @if (!Auth::guest()) @if ((Auth::user()->id == $thread->user_id) || (Auth::user()->type == 'admin')) 
        {{-- edit-form --}}
        <a href="{{route('thread.edit',$thread->id)}}" class="btn btn-warning btn-sm">Edit</a> 
        {{--//delete form--}}
        <form action="{{route('thread.destroy',$thread->id)}}" method="POST" class="inline-it float-right">
            {{csrf_field()}} {{method_field('DELETE')}}
            <input class="btn btn-sm btn-danger" type="submit" value="Delete">
        </form>
        @endif @endif
    </div>
    <br><br> 
    {{-- Enter Comment Section --}}
    @if (empty($thread->solution))
    
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <img src="/storage/images/avatars/{{ auth()->user()->avatar }}" class="img rounded-circle img-fluid" />
            </div>
            <div class="col-md-10">
                <p>
                    <a class="float-left" href="/profile"><strong>{{ auth()->user()->name }}</strong></a>
                </p>
                <div class="clearfix"></div>
                <p>
                    <div class="comment-form">
                        <form action="{{route('threadcomment.store', $thread->id)}}" method="post" role="form">
                            {{csrf_field()}}
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="article-ckeditorEC" placeholder="Enter Comment..."></textarea>
                            </div>

                            <button type="submit" class="float-right btn btn-sm btn-primary">Comment</button>
                        </form>
                    </div>
                </p>
            </div>
        </div>
    </div>
    @endif
    <hr> 
    {{--Answer/comment--}}
    <div class="comment-list">
        @include('pages.forums.thread.inc.comment-list')
    </div>
    <br><br>

</div>
@endsection