<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index(){
        return view('pages.feedback');
    }

    public function addFeedback(request $request){
        //saves the feedback
        $feedback = new Feedback;
        foreach(['name', 'email', 'comments'] as $field)
            $feedback->{$field} = $request->{$field};
        $feedback->save();

        return back()->with('success', 'Feedback saved!');   
    }
}
