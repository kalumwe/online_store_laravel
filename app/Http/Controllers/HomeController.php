<?php

/*
In the route files, any URI must be only connected to controller methods. Putting application logic inside a route file is NOT allowed.
Controllers passing only pass an associative array called viewData to the views
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Mail\MailService;
use Illuminate\Support\Facades\Log;
//use App\Mail\CustomMail;

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

  public function send(Request $request, MailService $mailService)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);


        $name = $validatedData['name'];
        $to = $validatedData['email'];
        $subject = "Name: " . $name;
        $subject .= "Subject: " . $validatedData['subject'];
        $messageBody = $validatedData['message'];


        $sendMail = $mailService->sendEmail($to, $subject, $messageBody); // CustomMail is your Mailable class
        /*
        $sendMail = Mail::raw($messageBody, function ($mail) use ($to, $subject) {
            $mail->to($to)->subject($subject);
        });*/

        if ($sendMail) {
            return redirect()->route('home.about')->with('success', 'Email sent successfully!');
        } else {
            return redirect()->route('home.about')->with('error', 'Email not sent!');
        }
    }
}
