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
        <div class="buttons float-right row">
            {{-- upvote button --}}
            <form action="/upvote/pertanyaan" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{$question->question_id}}">
                <input type="hidden" name="" value="{{$question->question_id}}">
                <button type="submit" class="btn btn-light btn-icon-split btn-sm mx-1"><span class="icon text-white-50">
                        <i class="fas fa-arrow-up"></i>
                    </span>
                    <span class="text">Upvote</span></button>
            </form>
            {{-- downvote button --}}
            <form action="/downvote/pertanyaan" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{$question->question_id}}">
                <input type="hidden" name="" value="{{$question->question_id}}">
                <button type="submit" class="btn btn-light btn-icon-split btn-sm mx-1"><span class="icon text-white-50">
                        <i class="fas fa-arrow-up"></i>
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
<!--
{{-- tampilan yg lama. kalo mau pake tinggal di uncomment trus hapus yg diatas --}}
{{-- <div class="row mb-3">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$question->title}}</h5>
<p class="card-text">Ditanyakan oleh: {{$question->user['name']}}</p>
<a href="{{route('pertanyaan.show', ['pertanyaan' => $question->question_id])}}" class="btn btn-primary px-4">Baca</a>
</div>
</div>
</div>
</div> --}} -->

@endforeach
@endsection
