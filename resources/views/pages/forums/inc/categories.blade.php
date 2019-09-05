
<h1 class="mt-2">Tags</h1>
<ul class="list-group">
    <a href="{{route('thread.index')}}" class="list-group-item border-primary btn btn-outline-primary text-left">
       <h5>All Threads</h5> 
    </a>
    @foreach($tags as $tag)
        <a href="{{route('thread.index', ['tags'=>$tag->id])}}" class="list-group-item border-primary btn btn-outline-primary text-left">
            {{$tag->name}}
            <span class="badge badge-primary float-right">{{count($tag->threads)}}</span>
        </a>
    @endforeach
</ul>
<div class="mt-5">
    <a href="{{route('thread.create')}}" class="d-block btn btn-primary btn-lg w-100">Create Thread</a>
</div>