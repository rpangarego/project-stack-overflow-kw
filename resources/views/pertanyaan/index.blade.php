@extends('layouts.master')

@section('title')
    <title>Stack Overflow</title>
@endsection

@section('content')
    @foreach($questions as $question)
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
<<<<<<< HEAD
                    <h5 class="card-title">TITLE</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
=======
                    <h5 class="card-title">{{$question->title}}</h5>
                    <p class="card-text">Ditanyakan oleh: {{$question->user['name']}}</p>
                    <a href="{{route('pertanyaan.show', ['pertanyaan' => $question->id])}}" class="btn btn-primary">Baca</a>
>>>>>>> 284a24efd047ab284da0d9c4cad95bb7ce972ed0
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection