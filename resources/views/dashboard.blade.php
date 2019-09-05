@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    <a href="/dashboard/category" class="btn btn-primary mb-3 form-control">Category Modification</a>
                    <a href="/dashboard/club" class="btn btn-primary mb-3 form-control">Clubs Modification</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection