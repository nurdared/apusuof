@extends('layouts/app') 
@section('content')
<h1 class="mb-4 mt-2">Clubs & Societies |  {{$club->category->category_name}} | {{$club->club_name}}</h1>
<hr>
<div class="row">
    <div class="col-md-4">
        <img class="card-img-top" style="width: inherited" src="/admin/public/images/{{$club->club_logo}}" alt="Card image cap">
        <a href="/clubs-soc/{{$club->category->id}}" class='btn btn-dark mt-3'>Go Back</a>  
        </div>
        <div class="col-md-5">
            {!! $club->club_description !!}
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-info h5 text-white"><strong>Timetable</strong></div>
                <div class="card-body">{!! $club->club_timetable !!}</div>
            </div>
        </div>
    </div>

    <hr>
  
    <!-- Page Heading -->
    <h1 class="my-4">Last Updates</h1>

    @foreach ($updates as $update)
        <!-- Project One -->
        <div class="row">
            <div class="col-md-4">
                <a href="#">
                    <img class="img-fluid rounded mb-3 mb-md-0" src="/admin/public/images/{{$update->update_image}}" alt="">
                 </a>
            </div>
            <div class="col-md-8">
                <h3>{{$update->update_title}}</h3>
                <p>{!!$update->update_body!!}</p>
                <hr>
                <span>Created On {{$update->created_at}} | By {{$update->user->name}}</span>
            </div>
        </div>
        <!-- /.row -->
        <hr>
    @endforeach
    <!--Pagination-->
    {{$updates->links()}}
    <br>

    <h1>Comments</h1>
    {{-- Comment Section --}}
    {{-- Enter Comment Section --}}
    <div class="card-body m-auto">
        <div class="row">
            <div class="col-md-2">
                <img src="/storage/images/avatars/{{ auth()->user()->avatar }}" class="img rounded-circle img-fluid float-right" style="height: 7em; width: 7em" />
            </div>
            <div class="col-md-8">
                <p>
                    <a class="float-left h5" href="/profile"><strong>{{ auth()->user()->name }}</strong></a>
                </p>
                <div class="clearfix"></div>
                <p>
                    <div class="comment-form">
                        <form action="{{route('clubcomment.store', $club->id)}}" method="post" role="form">
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
        @include('pages.clubs.comment-list')
    </div>
    <br><br>
        
    
        

@endsection