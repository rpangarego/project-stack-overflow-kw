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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $answer = Answer::where('answer_id', $id)->first();
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
        $answer = Answer::where('answer_id', $id)->first();

        $comment = new CommentAnswer();
        $comment->content = $request["content"];
        $comment->naswer_id = $request["answer_id"];
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
        $answer = Answer::where('question_id', $id)->first();
        $comments = CommentAnswer::where('question_id', $id)->get();
        return view('komentarjawaban.show', compact('answer', 'comments'));
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
    public function destroy($id)
    {
        //
    }
}
