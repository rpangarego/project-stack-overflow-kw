@extends('layouts.master')

@section('title')
    <title>Stack Overflow</title>
@endsection

@push('script-head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
<h3 class="text-center">Buat Komentar</h3>
<div class="container bg-white">
    <form class="p-3" action="/pertanyaan/{{ $question->question_id }}/komentarpertanyaan" method="POST">
        @csrf
        <input type="hidden" value="{{$question->question_id}}" name="question_id">

        <div class="form-group">
            <label for="content">Komentar</label>
            <textarea name="content" id="isi" class="form-control my-editor">{!! old('content', $content ?? '') !!}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Buat Komentar</button>
        </div>
    </form>
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
