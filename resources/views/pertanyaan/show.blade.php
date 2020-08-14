@extends('layouts.master')

@section('title')
<title>Stack Overflow</title>
@endsection

@section('content')

<div class="row">
    <div class="col">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><span class="text-gray-700">Pertanyaan:
                    </span>{{$question->title}}</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Aksi</div>
                        <a class="dropdown-item" href="{{$question->question_id}}/edit">Ubah</a>
                        <form action="/pertanyaan/{{$question->question_id}}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Deskripsi: {!!$question->content!!}</p>
                <hr>
                <div class="text-muted" style="font-size: 14px">Ditanyakan oleh: {{$question->user['name']}}</div>
                <br>
                <a href="/pertanyaan" class="d-block"> &larr; Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
