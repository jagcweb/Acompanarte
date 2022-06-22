<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center d-block">Cambiar contraseña</h2>
            <div class="card">
                
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update_password') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Actual contraseña') }}</label>

                            <div class="col-md-12">
                                <input id="current_password" type="password"   class="@error('current_password') is-invalid @enderror" name="current_password" required>

                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Nueva contraseña') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password"   class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            
                            <button type="submit" style="height:40px;" class="w-100">
                                {{ __('Modificar') }}
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>