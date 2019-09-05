@extends('layouts.forum') 
@section('heading', 'Edit Question') 
@section('content')

<div class="row">
    <div class="content-wrap card card-body bg-light">
        <form class="form-vertical" action="{{route('thread.update',$thread->id)}}" method="post" role="form" id="create-thread-form">
            {{csrf_field()}} {{method_field('put')}}
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" name="subject" id="" placeholder="Input..." value="{{$thread->subject}}">
            </div>

            <div class="form-group">
                <label for="thread">Thread</label>
                <textarea class="form-control" name="thread" id="article-ckeditor" placeholder="Input..."> {{$thread->thread}} </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('js')
    <script>
        (function ($) { 
            $(function () {
                $('#tag').chosen();
            })
        }( jQuery ));
    </script>
@endsection