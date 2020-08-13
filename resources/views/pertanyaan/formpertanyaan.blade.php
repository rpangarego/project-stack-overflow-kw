@extends('layouts.master')

@section('title')
<title>Form Buat Pertanyaan</title>
@endsection

@section('content')
<h3 class="text-center">Make Question</h3>
<div class="container bg-white">
        <form class="p-3">
            <div class="form-group">
                <label for="formGroupExampleInput">Title</label>
                <input type="text" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Content</label>
                <input type="text" class="form-control" id="formGroupExampleInput2">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary">Make Question</button>
            </div>
        </form>
</div>
@endsection