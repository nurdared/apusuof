@section('heading', 'Questions')
    @forelse($threads as $thread)
        <div class="card mb-3 border-info" >
            <div class="card-header bg-primary" style="height: 4em">
                <a class='btn' href="{{route('thread.show',$thread->id)}}">
                    <h4 class="text-white ">{{$thread->subject}}</h4>
                </a>
            </div>
            <div class="card-body">
                <p>
                    {!! str_limit($thread->thread,100) !!}
                    {{-- {{route('profile',$thread->user->name)}} --}} 
                </p>
                <hr>
                <small>Posted by <a href="/student_profile/{{$thread->user->id}}">{{$thread->user->name}}</a> {{ $thread->created_at->diffForHumans() }}</small> 
            </div>

        </div>
            
        
    @empty
        <h5>No threads</h5>

    @endforelse
    {{ $threads->links() }}
