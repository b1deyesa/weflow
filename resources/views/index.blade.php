<x-layout.app>
    <section class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center justify-content-center p-5 vh-100">
                    <div class="d-flex flex-column gap-1 w-100" style="max-width: 350px">
                        <h5 class="fs-4 fw-bold mb-4">Welcome Back!</h5>
                        @if(session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('auth.login.post') }}" method="POST">
                            @csrf
                            <x-input label="Email Address" type="email" name="email" />
                            <x-input label="Password" type="password" name="password" />
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="remember">
                                        <label class="form-check-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="">Forget Password?</a>
                                </div>
                            </div>
                            <x-button type="submit" class="w-100">Login</x-button>
                          </form>
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <img src="{{ asset('img/business.jpg') }}" alt="Wallpaper" class="w-100 vh-100 object-fit-cover">
                </div>
            </div>
        </div>
    </section>
    
</x-layout.app>