@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols">
        <div class="col-4">
            hahah
        </div>
        <div class="col-4">
            <form>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary bg-dark" style="background-color:red">Submit</button>
                <button>Submit</button>
              </form>
        </div>
        <div class="col-4">
            hahah
        </div>
    </div>
</div>
@endsection