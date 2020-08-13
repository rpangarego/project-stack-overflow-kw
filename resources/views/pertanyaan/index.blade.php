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
                    <p class="card-text">Ditanyakan oleh: {{$question->user['name']}}</p>
                    <a href="{{route('pertanyaan.show', ['pertanyaan' => $question->question_id])}}" class="btn btn-primary">Baca</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection