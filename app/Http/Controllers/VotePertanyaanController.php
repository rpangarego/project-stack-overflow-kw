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
        // dd($request->all());

// If there's a flight from Oakland to San Diego, set the price to $99.
// If no matching model exists, create one.
// $flight = App\Flight::updateOrCreate(
//     ['departure' => 'Oakland', 'destination' => 'San Diego'],
//     ['price' => 99, 'discounted' => 1]
// );

        $vote = UpvoteDownvoteQuestion::where('question_id',$request["question_id"]);

        if ($vote::all()) {
            return 'true';
        }else{
            return 'false';
        }

        // $vote = UpvoteDownvoteQuestion::updateOrCreate(
        //     ['user_id' => Auth::id(), 'question_id' => $request["question_id"]],
        //     ['point'] =>
        // )

        // $vote = new UpvoteDownvoteQuestion;
        // $vote->point = ;
        // $vote->user_id = Auth::id();
        // $vote->question_id = $request["tags"];
        // $vote->save();

        // Alert::success('Berhasil', 'Upvote berhasil');

        // return redirect('/pertanyaan');
    }
}
