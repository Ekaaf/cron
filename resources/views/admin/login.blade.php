@extends('admin.layout')

@section('content')

<main role="main" class="container">

  <div class="starter-template">
    <h1>Login</h1>
    @if(session()->has('message'))
	    <div class="alert alert-danger" role="alert">
	        {{ session()->get('message') }}
	    </div>
	@endif
	<form action="{{URL::to('postlogin')}}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="form-group row">
	    <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
	      @if ($errors->has('email'))
	      <span style="color: red;">{{ $errors->first('email') }}</span>
		  @endif
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
	    <div class="col-sm-10">
	      <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
	      @if ($errors->has('password'))
	      <span style="color: red;">{{ $errors->first('password') }}</span>
		  @endif
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
	    <div class="col-sm-10">
	      <button type="submit" class="btn btn-primary float-left">Login</button>
	    </div>
	  </div>
	  
	</form>

</main>
@stop