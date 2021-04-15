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
        //back end validation of the fields
        $validatedData = $request->validate([
            'name' => ['required', 'min:2', 'max:50'],
            'email' => ['required', 'email:rfc,dns'],
            'comments' => ['required', 'min:6', 'max:200'],
        ]);

        

        //saves the feedback
        $feedback = new Feedback;
        foreach(['name', 'email', 'comments'] as $field)
            $feedback->{$field} = $request->{$field};
        $feedback->save();

        return back()->with('success', 'Feedback saved!');   
    }
}
