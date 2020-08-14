<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Answer;
use Illuminate\Support\Facades\Auth;

class ForumJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::all();
        dd($answers->all());
        return view('pertanyaan.show', compact('answers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $answer = new Answer;
        $answer->content = $request["content"];
        $answer->vote_point = 10;
        $answer->user_id = Auth::id();
        $answer->question_id = $request["question_id"];
        $answer->save();

        $link ="/pertanyaan/".$request["question_id"];
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
        //
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
        $answers = Answer::where('answer_id' , $id)->delete();

        Alert::success('Berhasil', 'Jawaban Berhasil Dihapus');
        $link = '/pertanyaan/'.$request['question_id'];
        return redirect($link);
    }
}
