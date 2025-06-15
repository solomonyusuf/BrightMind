<div>
    <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-6">
            <div class="card auth-card border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">Forgot Password</h2>
                        <p class="text-muted">Reset your account password</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                Continue
                            </button>
                        </div>


                    
                        <div class="text-center">
                            <p class="text-muted">Don't have an account?</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                Create Account
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
