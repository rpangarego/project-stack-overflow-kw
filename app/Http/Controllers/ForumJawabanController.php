<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Question;
use App\Answer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ForumJawabanController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['store','destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::all();
        return view('pertanyaan.show', compact('answers'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        // $questions = Question::where('question_id', $id)->first();
        // $answers = Answer::where('answer_id' , $id)->first();
        $questions = Question::find($id);
        $answers = Answer::find();
        return view('jawaban.formedit' , compact('answers', 'questions'));
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
        $answers = Answer::where('id' , $id)->update(['content' => $request["content"]]);;
        Alert::success('Berhasil', 'Jawaban Berhasil Diedit');
        return redirect('/pertanyaan/'.$request["question_id"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $question = Question::where('id', $request['question_id'])->update(['correct_answer_id' => NULL]);
        $answers = Answer::where('id' , $id)->delete();
        Alert::success('Berhasil', 'Jawaban Berhasil Dihapus');
        $link = '/pertanyaan/'.$request['question_id'];
        return redirect($link);
    }

    public function correctAnswer(Request $request, $answer_id){
        // input id jawaban tepat
        $question = Question::where('id', $request['question_id'])->update(['correct_answer_id' =>  $answer_id]);

        // menambahkan 15 point ke user yg bertanya
        $user = User::find($request["user_id"]);
        $user["reputation_point"] = $user->reputation_point + 15;
        $user->save();

        Alert::success('Berhasil', 'Jawaban Tepat Dipilih');
        $link = '/pertanyaan/'.$request['question_id'];
        return redirect($link);
    }
}
