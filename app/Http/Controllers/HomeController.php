<?php

/*
In the route files, any URI must be only connected to controller methods. Putting application logic inside a route file is NOT allowed.
Controllers passing only pass an associative array called viewData to the views
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMail;

class HomeController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Home Page - Online Store";
    return view('home.index')->with("viewData", $viewData);
  }

  public function about()
  {
    $viewData = [];
    $viewData["title"] = "About us - Online Store";
    $viewData["subtitle"] = "About us";
    $viewData["description"] = "This is an about page ...";
    $viewData["author"] = "Developed by: Kalu";
    return view('home.about')->with("viewData", $viewData);

  }

  public function send(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'to' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $name = $validatedData['name'];
        $to = $validatedData['to'];
        $subject = "Name: " . $name;
        $subject .= "Subject: " . $validatedData['subject'];
        $message = $validatedData['message'];

        Mail::to($to)->send(new CustomMail($subject, $message)); // CustomMail is your Mailable class

        return redirect()->route('home.about')->with('success', 'Email sent successfully!');
    }
}
