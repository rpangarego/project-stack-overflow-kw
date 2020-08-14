@extends('layouts.master')

@section('title')
<title>Stack Overflow KW</title>
@endsection

@section('content')

@foreach($questions as $question)

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><span class="text-gray-700">{{$question->user['name']}}:</span>
            {{$question->title}}</h6>
    </div>
    <div class="card-body">
        <div>
            {{-- <p>Asked by {{$question->user['name']}}</p> --}}
        </div>
        <div class="buttons float-right">
            {{-- upvote button --}}
            <a href="#" class="btn btn-light btn-icon-split btn-sm mx-1">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-up"></i>
                </span>
                <span class="text">Upvote</span>
            </a>
            {{-- downvote button --}}
            <a href="#" class="btn btn-light btn-icon-split btn-sm mx-1">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-down"></i>
                </span>
                <span class="text">Downvote</span>
            </a>
            {{-- comment button --}}
            <a href="/pertanyaan/{{ $question->question_id }}/komentarpertanyaan" class="btn btn-light btn-icon-split btn-sm mx-1">
                <span class="icon text-white-50">
                    <i class="far fa-comment"></i>
                </span>
                <span class="text">Komentar</span>
            </a>
        </div>

        <a href="{{route('pertanyaan.show', ['pertanyaan' => $question->question_id])}}">Lihat lebih banyak
            &rarr;</a>
    </div>
</div>
@endforeach
@endsection
