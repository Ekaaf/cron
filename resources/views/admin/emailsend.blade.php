@extends('admin.layout')

@section('content')

<main role="main" class="container">

  <div class="starter-template">
    <h1>emailsend</h1>
    
    <form action="{{URL::to('chunkemail')}}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
	  List of emails
	  <div class="form-group row">
	    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
	    <div class="col-sm-10">
	      <button type="submit" class="btn btn-primary float-left">Send</button>
	    </div>
	  </div>
	  
	</form>
</main>
@stop