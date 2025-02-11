<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Kreait\Firebase\Database;

class FeedbackController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'customerfeedbacks';
    }
   public function store(Request $request)
   {
    
    $postData = [
        'name' => $request->name,
        'email'=> $request->email,
        'phonenumber'=> $request->phone,
        'feedback'=> $request->feedback,
    ];
    $postRef = $this->database->getReference($this->tablename)->push($postData);
    if ($postRef) {
        return redirect('feedback')->with('status','Feedback added successfully');
   }else{
    return redirect('feedback')->with('status','feedback not added');
   }
 }
}
