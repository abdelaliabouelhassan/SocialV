<x-guest-layout>

    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Sign in Start -->
    <section class="sign-in-page">
        <div id="container-inside">
            <div id="circle-small"></div>
            <div id="circle-medium"></div>
            <div id="circle-large"></div>
            <div id="circle-xlarge"></div>
            <div id="circle-xxlarge"></div>
        </div>
        <div class="container p-0">
            <div class="row no-gutters">
                <div class="col-md-6 text-center pt-5">
                    <div class="sign-in-detail text-white">
                        <a class="sign-in-logo mb-5" href="#"><img src="{{asset("images/logo-full.png")}}" class="img-fluid" alt="logo"></a>
                        <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                            <div class="item">
                                <img src="{{asset("images/login/1.png")}}" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Find new friends</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                            </div>
                            <div class="item">
                                <img src="{{asset("images/login/2.png")}}" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Connect with the world</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                            </div>
                            <div class="item">
                                <img src="{{asset("images/login/3.png")}}" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Create new events</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-white pt-5">
                    <div class="sign-in-from">
                        @if (session('status'))
                            <img src="{{asset("images/login/mail.png")}}" width="80"  alt="">
                            <h1 class="mt-3 mb-0">Success !</h1>
                            {{ __('A new reset password  link has been sent to the email address you provided ') }}

                            @else
                            <h1 class="mb-0">Reset Password</h1>
                            <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                            <x-jet-validation-errors style="color:  red" class="mb-4" />
                            <form method="POST" class="mt-4" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                    <x-jet-input id="email" class="form-control mb-0" type="email" name="email" :value="old('email')" required autofocus />
                                </div>

                                <div class="d-inline-block w-100">

                                    <button type="submit" class="btn btn-primary float-right">  {{ __('Email Password Reset Link') }}</button>
                                </div>

                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
