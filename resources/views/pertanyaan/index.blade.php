@extends('layouts.master')

@section('title')
    <title>Stack Overflow</title>
@endsection

@section('content')
<<<<<<< HEAD
    @foreach($questions as $question)
=======
@foreach ($questions as $question)
>>>>>>> fe015d8e99c5c75c01459cfe3771f89683b941d1
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
<<<<<<< HEAD
    @endforeach
=======
@endforeach
>>>>>>> fe015d8e99c5c75c01459cfe3771f89683b941d1
@endsection