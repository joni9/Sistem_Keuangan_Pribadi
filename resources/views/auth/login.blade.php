@extends('layouts.auth', ['title' => 'Login'])

@section('content')

      <div class="container">
  
        <div class="row">
          <div class="col-md-12">
            <div class="form-sub-main">
              <div class="_main_head_as">
                <a href=""><img src="assets-login/images/vector.png"></a>
              </div>
              <h4 class="mt-2 text-white">Sistem Keuangan Pribadi</h4>
              <form action="{{ route('login') }}" method="post">
                @csrf
              <div class="form-group">
                  <input id="email" name="email" class="form-control _ge_de_ol" type="email" placeholder="Email" required="required" aria-required="true">
              </div>

              <div class="form-group">
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required="required">
                <label for="showPassword" class="show-password-label">
                  <input type="checkbox" id="showPassword" style="display: none;">
                  <i id="eyeIcon" class="fa fa-eye" aria-hidden="true"></i>
                </label>
              </div>
              <div class="form-group">
                <div class="btn_uy">
                  <button type="submit" class="btn btn-success"><span>Login</span></button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>

@endsection