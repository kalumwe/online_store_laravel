
@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="container">
 <div class="row">
  <div class="col-lg-4 ms-auto">
   <p class="lead">{{ $viewData["description"] }}</p>
  </div>
  <div class="col-lg-4 me-auto">
    <p class="lead">{{ $viewData["author"] }}</p>
  </div>
  </div>
</div>
<div class="card-body">
<h4>Contact Us for more</h4>
<form method="POST" action="{{ route('home.send') }}">
    @csrf

    <div class="row m-5">
          <div>
            <label class="col-lg-1 col-md-6 col-sm-12 col-form-label">Name:</label>
            <div class="col-lg-10 col-md-6 col-sm-12 mb-4">
              <input name="name" value="{{ old('name') }}" type="text" class="form-control">
            </div>
          </div>

          <div>
            <label class="col-lg-1 col-md-6 col-sm-12 col-form-label">Email:</label>
            <div class="col-lg-10 col-md-6 col-sm-12 mb-4">
              <input name="email" value="{{ old('email') }}" type="email" class="form-control">
            </div>
          </div>

            <div>
              <label class="col-lg-1 col-md-6 col-sm-12 col-form-label">Subject:</label>
              <div class="col-lg-10 col-md-6 col-sm-12 mb-4">
                <input name="subject" value="{{ old('subject') }}" type="text"  class="form-control @error('email') is-invalid @enderror">
              </div>
             </div>
            <div class="mb-3 ml-3">
            <label class="form-label">Message:</label>
            <textarea class="form-control" name="message"
              rows="4" cols="50"></textarea>
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Send Email</button>
          </div>
      </div>

    </form>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
</div>
@endsection
