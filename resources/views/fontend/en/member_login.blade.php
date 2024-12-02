@extends('layouts.fontend_master')

@section('content')

<style>
.page{background: #fbfafa;}

@font-face {
  font-family: 'password';
  font-style: normal;
  font-weight: 400;
  src: url(https://jsbin-user-assets.s3.amazonaws.com/rafaelcastrocouto/password.ttf);
}
input.myclass{font-family: 'password';width: 250px;border: 1px solid #f5a63f;}
input.textboxsize{width: 250px;border: 1px solid #f5a63f;}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card" style="padding-top:50px;padding-bottom:50px;">
                <div>
                    <h5> Are you thinking to add your product in our auction, please login</h5>
                    <br>
                </div>
                <div class="card-header" style="background: #f4f3f3;padding:10px;font-size: 16px;font-weight: bold;color: #151515;">
                    Member Login
                </div>

                <div class="card-body" style="background: #f4f3f3;">
                    
                    <form method="POST" action="{{ route('check_member_logininfo') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="loginid" class="col-md-4 col-form-label text-md-right">LoginID</label>

                            <div class="col-md-6">
                                <input id="loginid" type="search" autocomplete="off" class="textboxsize form-control @error('loginid') is-invalid @enderror" name="loginid" value="{{ old('loginid') }}" required  autofocus>

                                @error('loginid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"  class="form-control myclass @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0" style="padding-bottom: 25px;">
                            <label class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
