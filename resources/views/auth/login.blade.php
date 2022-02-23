@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center login-wrapper">
        <div class="col-md-4 col-md-offset-4 p-0 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card" style="margin-bottom: 92px;margin-top: 40px;border: 1px solid #e2e2e2; background-color: #fff; box-shadow: 0 0 7px 1px rgba(0,0,0,.2); border-radius: 10px;padding: 20px">
                    <div class="text-center">
                        <h4>Hesaba daxil ol</h4>
                        <hr>
                    </div>
                    <div class="form-group">
                        <input id="email" placeholder="E-mail ünvanınız" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Şifrəniz">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="form-group"> --}}
                        <input type="hidden" id="remember" name="remember" value="1">
                    {{-- </div> --}}

                    <div class="form-group">
                        <div>
                            @if (Route::has('password.request'))
                            <a href="/password/reset">Şifrəni unutmusan?</a>
                            @endif
                            <a class="pull-right" href="/register">Hesabınız yoxdur?</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-md btn-block btn-success">Daxil ol</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
