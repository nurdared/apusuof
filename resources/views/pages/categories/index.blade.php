@extends('layouts/app') 
@section('content')
    <h1 class="mb-4 mt-2">Clubs & Societies | Categories</h1>
    @if (count($categories)>0)
        @foreach ($categories->chunk(3) as $chunk)
            <div class="row">
                @foreach ($chunk as $category)
                <div class="mb-2 col-md-4" >
                    
                        <div class="card mb-4 text-white bg-dark">
                           <img class="card-img-top" style="width: 100%" src="/admin/public/images/{{$category->category_image}}" alt="Card image cap">
                           <div class="card-body">
                              <h5 class="card-title">{{$category->category_name}}</h5>
                              <p class="card-text"> {!! $category->category_body !!}</p>
                              <a href="/clubs-soc/{{$category->id}}" class="btn btn-outline-light btn-md mt-2">Enter</a>
                           </div>
                        </div>
                    
                </div>
                @endforeach
            </div>
        @endforeach
        {{$categories->links()}}
    @else
        <p>No Category Found</p>
    @endif



@endsection