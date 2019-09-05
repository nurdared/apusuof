@foreach($event->comments->sortByDesc('created_at') as $comment)
<div class="card-body">
    <div class="row">
        <div class="col-md-2">
            <img src="/storage/images/avatars/{{ $comment->user->avatar }}" class="img rounded-circle img-fluid float-right" style="height: 7em" />
        </div>
        <div class="col-md-8">
            <p>
                <a class="float-left" href="/student_profile/{{$comment->user->id}}">
                    <strong>{{$comment->user->name}}</strong>
                </a>
                
                <small class="text-secondary mb-2 float-right">{{ $comment->created_at->diffForHumans() }}</small>
            </p>
            <div class="clearfix"></div>
            <p>{!! $comment->body !!}</p>
            {{-- Comment Actions --}}
            <p>
                @if ((Auth::user()->id == $comment->user_id)) 
                
                {{-- Actions --}} 
                {{-- edit-form --}}
                <!-- Button to Open the Modal -->
                <a class="float-right btn btn-sm btn-outline-warning ml-2" data-toggle="modal" href="#edit-comment-{{ $comment->id }}">
                    Edit
                    </a>

                <!-- The Modal -->
                <div class="modal" id="edit-comment-{{ $comment->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Editing Comment</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="comment-form">
                                <form action="{{route('comment.update', $comment->id)}}" method="post" role="form">
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        {{csrf_field()}} {{method_field('put')}}

                                        <div class="form-group">
                                            <textarea class="form-control" name="body" placeholder="Input..." value="">{!!$comment->body!!}</textarea>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Update</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- delete-form --}}
                <form action="{{route('comment.destroy',$comment->id)}}" method="POST" class="inline-it">
                    {{csrf_field()}} {{method_field('DELETE')}}

                    <input class="float-right btn btn-sm btn-outline-danger  ml-2" type="submit" value="Delete">

                </form>
                @endif

                <a data-toggle="modal" href="#reply-comment-{{ $comment->id }}" class="float-right btn btn-sm btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
                <!-- Reply Modal -->
                <div class="modal fade" id="reply-comment-{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">


                            {{-- Enter Reply Section --}}
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
                                                <form action="{{route('replycomment.store', $comment->id)}}" method="post" role="form">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="body" id="" placeholder="Enter Reply..."></textarea>
                                                    </div>
                
                                                    <button type="submit" class="float-right btn btn-sm btn-primary">Reply</button>
                                                </form>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                
                <span  class="float-right btn btn-sm text-white btn-danger  {{$comment->isLiked()?"liked":""}}" onclick="likeIt('{{$comment->id}}',this)"><button class="btn btn-xs btn-danger text-white" id="{{$comment->id}}-count" >{{$comment->likes()->count()}}</button><span class="fa fa-heart"></span></span>
                
            </p>
        </div>
    </div>

    {{-- Comment Reply --}} 
    @foreach ($comment->comments as $reply)
    <hr>
    <div class="ml-5  card-inner bg-light small mb-1" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <img src="/storage/images/avatars/{{ $reply->user->avatar }}" class="img rounded-circle img-fluid float-right" style="height: 7em" />
                    
                </div>
                <div class="col-md-8">
                    <p>
                        <a href="/student_profile/{{$reply->user->id}}">
                            <strong>{{ $reply->user->name }}</strong>
                        </a>
                        <small class="text-secondary float-right mb-2">{{$reply->created_at->diffForHumans()}}</small>
                    </p>
                    <p>{!! $reply->body !!}</p>
                    {{-- Reply Comment Actions --}}
                    <p>
                        @if ((Auth::user()->id == $reply->user_id) || (Auth::user()->type == 'admin')) {{-- Actions --}} {{-- edit-form --}}
                        <!-- Button to Open the Modal -->
                        <a class="float-right btn btn-xs btn-outline-warning ml-2" data-toggle="modal" href="#edit-comment-{{ $reply->id }}">
                            Edit
                            </a>

                        <!-- The Modal -->
                        <div class="modal" id="edit-comment-{{ $reply->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Editing Comment</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="comment-form">
                                        <form action="{{route('comment.update', $reply->id)}}" method="post" role="form">
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                {{csrf_field()}} {{method_field('put')}}

                                                <div class="form-group">
                                                    <textarea class="form-control" name="body" id="" placeholder="Input..." value="">{!!$reply->body!!}</textarea>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning">Update</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- delete-form --}}
                        <form action="{{route('comment.destroy',$reply->id)}}" method="POST" class="inline-it">
                            {{csrf_field()}} {{method_field('DELETE')}}

                            <input class="float-right btn btn-xs btn-outline-danger  ml-2" type="submit" value="Delete">

                        </form>
                        @endif
            
                        <span  class="float-right btn btn-xs text-white btn-danger  {{$reply->isLiked()?"liked":""}}" onclick="likeIt('{{$reply->id}}',this)"><button class="btn btn-xs btn-danger text-white" id="{{$reply->id}}-count" >{{$reply->likes()->count()}}</button> <span class="fa fa-heart"></span></span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @endforeach 



</div>


<hr> 
@endforeach

@section('js')
<script>
    function likeIt(commentId,elem){
        var csrfToken='{{csrf_token()}}';
        var likesCount=parseInt($('#'+commentId+"-count").text());
        $.post('{{route('toggleLike')}}', {commentId: commentId,_token:csrfToken}, function (data) {
            console.log(data);
        if(data.message==='liked'){
            //$(elem).css({color:'red'});
            //$(elem).toggleClass('bg-dark');
            $(elem).addClass('liked');
            $('#'+commentId+"-count").text(likesCount+1);
            
        }else{
            $('#'+commentId+"-count").text(likesCount-1);
            $(elem).removeClass('liked');
        }
        });
    }
</script>
@endsection