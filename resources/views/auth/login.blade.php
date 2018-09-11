@extends('layouts.front')

@section('contenido')

<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>FDG</b>Guayas</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Logearse para iniciar session</p>
        <form  method="post" action="{{ url('/login') }}" >
            {{ csrf_field() }}
            <!--Email-->
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div> <!-- End Email-->
         <!--Password-->
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div> <!--End Password-->
         <div class="row">
                <div class="col-xs-8 col-md-6 col-md-offset-4">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Recordarme
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4 col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-btn fa-sign-in"></i>Entrar</button>
                </div>
                <!-- /.col -->
         </div>
        </form>
     {{--<a class="btn btn-link" href="{{ url('/password/reset') }}">Olvide mi contraseña</a><br>--}}
   </div>
    <!-- /.login-box-body -->
</div>

@endsection

