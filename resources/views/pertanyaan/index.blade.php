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
                    <h5 class="card-title">TITLE</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection