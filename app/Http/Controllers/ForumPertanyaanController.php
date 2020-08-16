<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Question;
use App\Answer;
use App\CommentQuestion;
use App\UpvoteDownvoteQuestion;

class ForumPertanyaanController extends Controller
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
        $questions = Question::all();
        $voteQuestions = UpvoteDownvoteQuestion::all();
        return view('pertanyaan.index', compact('questions','voteQuestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pertanyaan.formpertanyaan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question;
        $question->title = $request["title"];
        $question->content = $request["content"];
        $question->tags = $request["tags"];
        $question->user_id = Auth::id();
        $question->save();

        Alert::success('Berhasil', 'Buat Pertanyaan Berhasil');
        return redirect('/pertanyaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        $answers = Answer::where('question_id', $id)->get();
        $voteQuestions = UpvoteDownvoteQuestion::all();
        return view('pertanyaan.show', compact('question' , 'answers', 'voteQuestions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('pertanyaan.edit', compact('question'));
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
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $question = DB::table('questions')
              ->where('id', $id)
              ->update([
                  'title' => $request->title,
                  'content' => $request->content
                ]);

        Alert::success('Berhasil', 'Ubah Pertanyaan Berhasil');

        return redirect('/pertanyaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upvotedownvote = UpvoteDownvoteQuestion::where('question_id' , $id)->delete();
        $commentquestion = CommentQuestion::where('question_id' , $id)->delete();
        $answer = Answer::where('question_id' , $id)->delete();
        $question = Question::where('id', $id)->delete();

        Alert::success('Berhasil', 'Hapus Pertanyaan Berhasil');

        return redirect('/pertanyaan');
    }

    public function pertanyaanku(){
        $questions = Question::where('user_id',Auth::id())->get();
        return view('pertanyaan.user', ['questions' => $questions]);
    }
}
