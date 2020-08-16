<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\CommentAnswer;
use App\Answer;

class ForumKomentarJawabanController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $answer = Answer::find($id);
        return view('komentarjawaban.create', compact('answer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $answer = Answer::find($id);

        $comment = new CommentAnswer();
        $comment->content = $request["content"];
        $comment->answer_id = $request["answer_id"];
        $comment->user_id = Auth::id();
        $comment->save();

        Alert::success('Berhasil', 'Buat Komentar Berhasil');
        $link = '/pertanyaan/'.$request["question_id"].'/komentarpertanyaan';
        return redirect($link);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer = Answer::find($id);
        $comments = CommentAnswer::where('question_id', $id)->get();
        return view('komentarjawaban.show', compact('answer', 'comments'));
    }
}
