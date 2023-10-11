<?php

/*
In the route files, any URI must be only connected to controller methods. Putting application logic inside a route file is NOT allowed.
Controllers passing only pass an associative array called viewData to the views
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    $viewData["author"] = "Developed by: Your Name";
    return view('home.about')->with("viewData", $viewData);

  }
}
