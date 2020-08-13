@extends('layouts.master')

@section('title')
    <title>Stack Overflow</title>
@endsection

@section('content')
@foreach ($questions as $question)
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$question->title}}</h5>
                    <p class="card-text">Ditanyakan oleh: </p>
                    <a href="#" class="btn btn-primary">Baca</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection