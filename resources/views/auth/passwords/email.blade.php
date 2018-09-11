@extends('layouts.front')

<!-- Main Content -->
@section('contenido')

    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>FDG</b>Guayas</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Reiniciar mi contraseña</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form  role="form" method="POST" action="{{ url('/password/email') }}" >
                {{ csrf_field() }}
                 <!--Email-->
                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Dirección de Email...">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar link</button>
                   @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif


                </div> <!-- End Email-->

            </form>

        </div>
        <!-- /.login-box-body -->
    </div>

@endsection
