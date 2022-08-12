<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center d-block">Modificar mis datos</h2>
            <div class="card">
                
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text"   class="@error('name') is-invalid @enderror" name="name" value="{{ \Auth::user()->name }}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Apellido') }}</label>

                            <div class="col-md-12">
                                <input id="surname" type="text"   class="@error('surname') is-invalid @enderror" name="surname" value="{{ \Auth::user()->surname }}" required>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email"   class="@error('email') is-invalid @enderror" name="email" value="{{ \Auth::user()->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Imagen de perfil') }}</label>

                            <div class="col-md-12">
                                <label for="image" class="type-file">
                                    <i class="fa-solid fa-cloud-arrow-up mr-2"></i>{{ __('Escoger imagen') }}
                                </label>
                                <input id="image" type="file" class="d-none @error('image') is-invalid @enderror" name="image" accept=".gif,.jpg,.jpeg,.png,.webp">
                                <br>
                                <span class="selected-img"></span>

                                @if(\Auth::user()->image)
                                <span>Avatar Actual:</span>
                                    <img src="{{url('mi-perfil/get-image/'.Auth::user()->image)}}" alt="Encuentra Pianista avatar"  class="rounded-circle" width="100"/>
                                @endif

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

<script>
    $( document ).ready(function() {
        $("#image").on("change", function(e) {
            const img = $(this).val().split("\\");
            $('.selected-img').text(`Imagen seleccionada: ${img[2]}`);
        });
    });

</script>