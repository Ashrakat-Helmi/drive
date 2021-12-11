@extends('layouts.app')
@section('content')
<h1 class="text-center text-info">Edit Drive: {{$drive->id}} </h1>
@if ($errors->any())
    <div class="alert alert-danger mx-auto w-50">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <form action="{{route('drives.update',$drive->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label for="">Drive Title</label>
                    <input type="text" value="{{$drive->title}}" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Drive Description</label>
                    <input type="text" value="{{$drive->description}}" name="description" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Upload File : <img src="{{asset("upload/$drive->file")}} " width="40px" alt=""></label>
                    <input type="file" name="inputFile" class="form-control">
                </div>
                <button class="btn btn-block btn-info">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection