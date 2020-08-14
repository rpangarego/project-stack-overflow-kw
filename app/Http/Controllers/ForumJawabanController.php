<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Answer;
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
<<<<<<< HEAD

=======
        $answers = Answer::all();
        // dd($answers->all());
        return view('pertanyaan.show', compact('answers'));
>>>>>>> 88db02274b84d879d7f41c98fe0b405dcfec11ac
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
        $answers = Answer::where('answer_id' , $id);
        return view('jawaban.formedit' , compact('answers'));
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
        $answers = Answer::where('answer_id' , $id);

        $answers->content = $request["content"];
        $answers->save();

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
        $answers = Answer::where('answer_id' , $id)->delete();

        Alert::success('Berhasil', 'Jawaban Berhasil Dihapus');
        $link = '/pertanyaan/'.$request['question_id'];
        return redirect($link);
    }
}
