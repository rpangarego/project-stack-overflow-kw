@extends('layouts.master')

@section('title')
<title>Stack Overflow KW</title>
@endsection

@section('content')

@forelse ($questions as $question)
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><span class="text-gray-700">{{$question->user['name']}}:</span>
            {{$question->title}}</h6>
    </div>
    <div class="card-body">
        <div class="buttons float-right row">
            {{-- upvote button --}}
            <form action="/upvote/pertanyaan" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{$question->question_id}}">
                <input type="hidden" name="user_id" value="{{$question->user['id']}}">
                <button type="submit" class="btn btn-light btn-icon-split btn-sm mx-1" @foreach ($voteQuestions as
                    $vote) @if ($question->question_id == $vote->question_id && $vote->user_id == Auth::id() &&
                    $vote->point == 1)
                    disabled
                    @endif
                    @endforeach

                    ><span class="icon text-white-50">
                        <i class="fas fa-arrow-up"></i>
                    </span>
                    <span class="text">Upvote</span></button>
            </form>
            {{-- downvote button --}}
            <form action="/downvote/pertanyaan" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{$question->question_id}}">
                <input type="hidden" name="user_id" value="{{$question->user['id']}}">
                <button type="submit" class="btn btn-light btn-icon-split btn-sm mx-1" @foreach ($voteQuestions as
                    $vote) @if ($question->question_id == $vote->question_id && $vote->user_id == Auth::id() &&
                    $vote->point == 0)
                    disabled
                    @endif
                    @endforeach><span class="icon text-white-50">
                        <i class="fas fa-arrow-down"></i>
                    </span>
                    <span class="text">Downvote</span></button>
            </form>
            {{-- comment button --}}
            <a href="/pertanyaan/{{ $question->question_id }}/komentarpertanyaan"
                class="btn btn-light btn-icon-split btn-sm mx-1">
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
@empty
<div class="card shadow mb-4">
    <div class="card-body text-center">
        <p>Tidak ada data</p>
        <div>
            <a href="/pertanyaan/create" class="btn btn-primary">Buat Pertanyaan</a>
        </div>
    </div>
</div>
@endforelse

@endsection
