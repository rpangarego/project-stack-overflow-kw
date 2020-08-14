@extends('layouts.master')

@section('title')
<title>Stack Overflow</title>
@endsection

@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
<div class="row">
    <div class="col">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><span class="text-gray-700">Pertanyaan:
                    </span>{{$question->title}}</h6>

                @guest
                <div></div>
                @else
                @if ($question->user_id == Auth::user()->id)
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
                @endif
                @endguest

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Deskripsi: {!!$question->content!!}</p>
                <div class="text-muted" style="font-size: 14px">Ditanyakan oleh: {{$question->user['name']}}</div>
                <hr>
                <div>
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
                        <a href="/pertanyaan/{{ $question->question_id }}/komentarpertanyaan/create"
                            class="btn btn-light btn-icon-split btn-sm mx-1">
                            <span class="icon text-white-50">
                                <i class="far fa-comment"></i>
                            </span>
                            <span class="text">Beri Komentar</span>
                        </a>
                    </div>
                </div>
                <a href="/pertanyaan/{{ $question->question_id }}" class="d-block"> &larr; Kembali</a>

                <hr>
                {{-- form jawaban --}}
                <h6 class="m-0 mb-3 font-weight-bold text-primary">
                    <div class="text-gray-700">Komentar:</div>
                </h6>

                @forelse ($comments as $comment)
                <div class="card shadow mb-4">
                    <!-- Answer Body -->
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{$comment->user['name']}}: </h6>

                            @guest
                            <div></div>
                            @else
                            @if ($comment->user_id == Auth::user()->id)
                            <div class="delete-button">
                                <form action="/pertanyaan/{{$question->question_id}}/komentarpertanyaan" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="comment_id" value="{{$comment->comment_id}}">
                                    <button type="submit" class="btn btn-sm text-danger">Hapus</button>
                                </form>
                            </div>
                            @endif
                            @endguest

                        </div>

                        {!!$comment->content!!}
                    </div>
                </div>
                @empty
                <div class="card-body text-center">
                    <p>Tidak ada komentar</p>
                </div>
                @endforelse
            </div>
        </div>

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
