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

        //checks if more than two were sent in the past hour
        $count = Feedback::where('email', $request->email)->where('created_at', '>', date('Y-m-d H:i:s', strtotime('-1 hours')))->count();
        if($count > 1)
            return back()->with('error', 'You cannot send more than 2 messages per hour per email!');   

        //saves the feedback
        $feedback = new Feedback;
        foreach(['name', 'email', 'comments'] as $field)
            $feedback->{$field} = $request->{$field};
        $feedback->save();

        return back()->with('success', 'Feedback saved!');   
    }
}
