@extends('layouts.master')

@section('title')
<title>Stack Overflow KW</title>
@endsection

@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')

<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><span class="text-gray-700">Pertanyaan:
            </span>{{$question->title}}</h6>

        {{-- Auth Action Button --}}
        @guest
        <div></div>
        @else
        @if ($question->user_id == Auth::user()->id)
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi</div>
                <a class="dropdown-item" href="{{$question->id}}/edit">Ubah</a>
                <form action="/pertanyaan/{{$question->id}}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">Hapus</button>
                </form>
            </div>
        </div>
        @endif
        @endguest

    </div>
    <!-- Card Body -->
    <div class="card-body">
        <p>Deskripsi: {!!$question->content!!}</p>
        <div class="text-muted" style="font-size: 14px">Ditanyakan oleh: {{$question->user['name']}}</div>
        <hr>
        <div>
            <div class="buttons float-right row">
                {{-- upvote button --}}
                <form action="/upvote/pertanyaan" method="POST">
                    @csrf
                    <input type="hidden" name="question_id" value="{{$question->id}}">
                    <input type="hidden" name="user_id" value="{{$question->user['id']}}">
                    <button type="submit" class="btn btn-light btn-icon-split btn-sm mx-1" @foreach ($voteQuestions as
                        $vote) @if ($question->id == $vote->question_id && $vote->user_id == Auth::id() &&
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
                        $vote) @if ($question->id == $vote->question_id && $vote->user_id == Auth::id() &&
                        $vote->point == 0)
                        disabled
                        @endif
                        @endforeach><span class="icon text-white-50">
                            <i class="fas fa-arrow-down"></i>
                        </span>
                        <span class="text">Downvote</span></button>
                </form>
                {{-- comment button --}}
                <a href="/pertanyaan/{{ $question->id }}/komentarpertanyaan"
                    class="btn btn-light btn-icon-split btn-sm mx-1">
                    <span class="icon text-white-50">
                        <i class="far fa-comment"></i>
                    </span>
                    <span class="text">Komentar</span>
                </a>
            </div>
        </div>
        <a href="/pertanyaan" class="d-block"> &larr; Kembali</a>
        <hr>

        {{-- form jawaban --}}
        <h6 class="m-0 mb-3 font-weight-bold text-primary">
            <div class="text-gray-700">Jawaban:</div>
        </h6>

        @forelse ($answers as $answer)
        @if ($question->correct_answer_id == $answer->id)
        <div class="card border-left-info shadow mb-4">
            @else
            <div class="card shadow mb-4">
                @endif

                <!-- Answer Body -->
                <div class="card-body ">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{$answer->user['name']}}: </h6>

                        @auth
                        <div class="delete-button">
                            @if ($question->correct_answer_id == null)
                            @if ($question->user_id == Auth::user()->id)
                            <form action="/jawabanTepat/{{$answer->id}}" method="post" class="d-inline">
                                @csrf
                                @method('put')
                                <input type="hidden" name="question_id" value="{{$question->id}}">
                                <input type="hidden" name="user_id" value="{{$answer->user_id}}">
                                <button type="submit" class="btn btn-sm text-info">Jawaban Tepat</button>
                            </form>
                            @endif
                            @endif

                            @if ($answer->user_id == Auth::user()->id)
                            <a href="/jawaban/{{$answer->id}}/edit" class="btn btn-sm text-primary">Edit</a>
                            <form action="/jawaban/{{$answer->id}}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="question_id" value="{{$question->id}}">
                                <button type="submit" class="btn btn-sm text-danger">Hapus</button>
                            </form>
                            @endif
                        </div>
                        @endauth
                    </div>
                    {!!$answer->content!!}
                </div>
            </div>
            @empty
            <div class="card bg-light mb-3">
                <div class="card-body" align="center">
                    Belum ada jawaban
                </div>
            </div>
            @endforelse

            <form action="/jawaban" method="POST">
                @csrf
                <input type="hidden" value="{{$question->id}}" name="question_id">
                <div class="form-group">
                    <textarea name="content" id="isi"
                        class="form-control my-editor">{!! old('content', $content ?? '') !!}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Jawaban</button>
            </form>
        </div>
    </div>

    @endsection


    @push('scripts')
    <script>
        var editor_config = {
      path_absolute : "/",
      selector: "textarea.my-editor",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };

    tinymce.init(editor_config);
    </script>
    @endpush

    @push('upvote_downvote')
    <script>
        function disableBtn(flag){
      if(!flag) {
        document.getElementById('upvote').setAttribute("disabled", "true");
      } else {
        document.getElementById('upvote').removeAttribute("disabled");
        document.getElementById('upvote').focus();
      }

    }

    </script>
    @endpush
