@extends('layouts.forum') 
@section('banner')
<div class="jumbotron" style="background-image: url('/storage/images/qa.jpg');
background-size: cover;
padding-top: 100px;
padding-bottom: 150px;
">
    <div class="container">
        <h1>Q & A Forum</h1>
        <h5>Help and Get help Anytime!</h5>
        <p>
            <a href='forum/thread' class="btn btn-primary text-white btn-lg">Enter</a>
        </p>
    </div>
</div>
@endsection
@section('heading', 'Questions')

@section('content')

    @include('pages.forums.thread.inc.thread-list')
@endsection