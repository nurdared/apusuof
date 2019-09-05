@extends('layouts.forum')

@section('heading', 'Create Question')

@section('content')



<div class="row">
        <div class="card card-body bg-light">
            <form class="form-vertical" action="{{route('thread.store')}}" method="post" role="form"
                    id="create-thread-form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="" placeholder="Input..."
                           value="{{old('subject')}}">
                </div>

                <div class="form-group">
                    <label for="tag">Tags</label>
                    <select type="text" class="form-control" multiple name="tags[]" id="tag" placeholder="Tags">
                        {{-- todo add from db--}}
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="thread">Thread</label>
                    <textarea class="form-control" name="thread" id="article-ckeditor" placeholder="Input..."
                    > {{old('thread')}}</textarea>
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