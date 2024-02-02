@extends('frontend')
@section('content')

<div class="bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center p-5">
                    {!! displayAlert() !!}

                    <div class="card-body">
                        <form method="POST" action="{{ route('unit-login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" maxlength="45" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="captcha text-md-end col-md-6">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                                <div class="col-md-4">
                                <input id="captcha" type="text" maxlength="7" class="form-control" placeholder="Enter Captcha" name="captcha">
                            </div>
                            <div class="col-md-12 mt-2 p-2">
                            <button type="submit" class="btn btn-primary text-center float-right ml-2">
                                        {{ __('Login') }}
                                    </button>
                                 
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                    </div>
                        </div>
                            
                            
                                
                            
                           {{-- <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>--}}

                            {{--<div class="row mb-0 text-center">
                                <div class="col-md-4 text-center offset-md-4">
                                    <div style="float:center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                 
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                    </div>
                                </div>
                            </div>--}}
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$('#reload').click(function () {
    $.ajax({
        type: 'GET',
        url: 'reload-captcha',
        success: function (data) {
            $(".captcha span").html(data.captcha);
        }
    });
});
</script>
@endsection