<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\CommentQuestion;
use App\Question;

class ForumKomentarPertanyaanController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = CommentQuestion::all();
        return view('komentarpertanyaan.index', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $question = Question::where('question_id', $id)->first();
        return view('komentarpertanyaan.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $question = Question::where('question_id', $id)->first();

        $comment = new CommentQuestion();
        $comment->content = $request["content"];
        $comment->question_id = $request["question_id"];
        $comment->user_id = Auth::id();
        $comment->save();

        Alert::success('Berhasil', 'Buat Komentar Berhasil');

        $link = "/pertanyaan/".$request["question_id"]."/komentarpertanyaan";

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
        $question = Question::where('question_id', $id)->first();
        $comments = CommentQuestion::where('question_id', $id)->get();
        return view('komentarpertanyaan.show', compact('question', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $comment = CommentQuestion::where('comment_id', $request['comment_id'])->delete();

        Alert::success('Berhasil', 'Hapus Komentar Berhasil');

        $link = "/pertanyaan/".$request["question_id"];

        return redirect($link);
    }
}
