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
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
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
                        @if (session('status') == 'verification-link-sent')


                            <img src="{{asset("images/login/mail.png")}}" width="80"  alt="">
                            <h1 class="mt-3 mb-0">Success !</h1>
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}

                            @else
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            <hr>
                            <form method="POST"  class="mb-4" action="{{ route('verification.send') }}">
                                @csrf
                                <div class="form-group">
                                    <x-jet-button  class="btn btn-success" type="submit">
                                        {{ __('Resend Verification Email') }}
                                    </x-jet-button>
                                </div>
                            </form>
                            <hr>
                        {{_('You Can Logout here ')}}
                            <br><br>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-info">
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
