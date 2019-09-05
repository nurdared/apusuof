@extends('layouts/app')
@section('content')
<h1 class="mt-2 mb-4">Clubs & Societies | {{$category->category_name}}</h1>


@if (count($clubs) >= 1)
@foreach ($clubs->chunk(3) as $chunk)
<div class="row">
    @foreach ($chunk as $club)
    <div class="mb-4 col-md-4">
        <div class="card mb-2 border-dark h-100">
            <img class="card-img-top " style="width: 100%" src="/admin/public/images/{{$club->club_logo}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$club->club_name}}</h5>
                <p class="card-text text-justify">{!! str_limit($club->club_description, 120) !!}</p>
                <a href="/clubs-soc/club/{{$club->id}}" class="btn btn-dark btn-sm">Enter Club</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endforeach
{{-- {{$categories->links()}} --}}
@else
<p>No club Found</p>
@endif
<a href="/clubs-soc" class='btn btn-dark mb-2'>Go Back</a>




@endsection