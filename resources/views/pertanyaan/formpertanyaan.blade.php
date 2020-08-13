@extends('layouts.master')

@section('title')
<title>Stack Overflow</title>
@endsection

@section('content')
<h3 class="text-center">Buat Pertanyaan</h3>
<div class="container bg-white">
        <form class="p-3" action="/pertanyaan" method="POST">
        @csrf
            <div class="form-group">
                <label for="formGroupExampleInput">Judul</label>
                <input type="text" class="form-control" id="formGroupExampleInput" name="title">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Isi</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="content">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Tags</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="tags">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Buat Pertanyaan</button>
            </div>
        </form>
</div>
@endsection