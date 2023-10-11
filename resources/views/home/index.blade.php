@extends('layouts.app')
@section('title', $viewData["title"])
@section('content')
<div class="row">
 <div class="col-md-6 col-lg-4 mb-2">
   <img src="{{ asset('/img/cosmetics.jpg') }}" class="img-fluid rounded">
 </div>
 <div class="col-md-6 col-lg-4 mb-2">
   <img src="{{ asset('/img/cream.jpg') }}" class="img-fluid rounded">
  </div>
  <div class="col-md-6 col-lg-4 mb-2">
    <img src="{{ asset('/img/protein.jpg') }}" class="img-fluid rounded">
  </div>
</div>
@endsection
