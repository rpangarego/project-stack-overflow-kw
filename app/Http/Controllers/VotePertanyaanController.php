<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\UpvoteDownvoteQuestion;
use App\User;
use App\Question;

class VotePertanyaanController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function upvote(Request $request){
        // tambah ke tabel upvote_downvote_question
        $vote = UpvoteDownvoteQuestion::updateOrCreate(
        ['user_id' => Auth::id(), 'question_id' => $request["question_id"]],
        ['point' => 1]);

        // menambahkan 10 point ke user yg bertanya
        $user = User::find($request["user_id"]);
        $user["reputation_point"] = $user->reputation_point + 10;
        $user->save();

        Alert::success('Berhasil', 'Upvote berhasil');

        $link = "/pertanyaan/".$request["question_id"];
        return redirect($link);
    }

    public function downvote(Request $request){

        $vote = UpvoteDownvoteQuestion::updateOrCreate(
        ['user_id' => Auth::id(), 'question_id' => $request["question_id"]],
        ['point' => 0]);

        // cek poin reputasi user
        $user = User::find(Auth::id());
        // dd($user);
        if ($user->reputation_point < 15) {
            Alert::error('Gagal', 'Minimal reputasi point 15 untuk melakukan downvote');
            $link = "/pertanyaan/".$request["question_id"];
            return redirect($link);
            exit();
        }

        // mengurangi 1 point ke user yg memberikan downvote
        $user = User::find(Auth::id());
        $user["reputation_point"] = $user->reputation_point - 1;
        $user->save();

        Alert::success('Berhasil', 'Downvote berhasil');
        $link = "/pertanyaan/".$request["question_id"];
        return redirect($link);
    }
}
