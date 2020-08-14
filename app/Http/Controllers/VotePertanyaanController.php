<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\UpvoteDownvoteQuestion;

class VotePertanyaanController extends Controller
{
    public function upvote(Request $request){

        $vote = UpvoteDownvoteQuestion::updateOrCreate(
        ['user_id' => Auth::id(), 'question_id' => $request["question_id"]],
        ['point' => 1]);

        Alert::success('Berhasil', 'Upvote berhasil');

        $link = "/pertanyaan/".$request["question_id"];
        return redirect($link);
    }

    public function downvote(Request $request){

        $vote = UpvoteDownvoteQuestion::updateOrCreate(
        ['user_id' => Auth::id(), 'question_id' => $request["question_id"]],
        ['point' => 0]);

        Alert::success('Berhasil', 'Downvote berhasil');

        $link = "/pertanyaan/".$request["question_id"];
        return redirect($link);
    }
}
