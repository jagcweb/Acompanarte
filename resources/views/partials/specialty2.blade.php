<div class="row mb-3 mt-4 font-22">
    <p class="text-center w-100">{{ __("Especialidad") }}*</p>
    <div class="col-md-12 d-flex justify-content-center mb-3">
        <input
            type="checkbox"
            value="1"
             class="todos"
            name="todos"
            @if(count(Auth::user()->professor_specialties) == 32) checked @endif
        />
        <label for="check-1" class="specialty-label ml-2 col-form-label">{{
            __("Todos")
        }}</label>
    </div>

    <div class="row col-md-12 d-flex justify-content-center">
        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Acordeón"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Acordeón'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Acordeón")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Arpa"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Arpa'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Arpa")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Cante Flamenco"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Cante Flamenco'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Cante Flamenco")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Canto"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Canto'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Canto")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Clarinete"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Clarinete'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Clarinete")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Contrabajo"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Contrabajo'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Contrabajo")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Coro"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Coro'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Coro")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Fagot"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Fagot'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Fagot")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Flauta"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Flauta'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Flauta")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Guitarra"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Guitarra'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Guitarra")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Música Antigua (Clavecinista)"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Música Antigua (Clavecinista)'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Música Antigua (Clavecinista)")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Música Antigua (Organista)"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Música Antigua (Organista)'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Música Antigua (Organista)")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Instrumentos de Púa"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Instrumentos de Púa'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Instrumentos de Púa")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Oboe"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Oboe'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Oboe")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Orquesta"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Orquesta'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Orquesta")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Percusión"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Percusión'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Percusión")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Saxofón"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Saxofón'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Saxofón")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Trombón"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Trombón'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Trombón")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Trompa"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Trompa'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Trompa")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Tuba"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Tuba'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Tuba")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Viola"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Viola'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Viola")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Violín"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Violín'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Violín")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Violonchelo"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Violonchelo'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Violonchelo")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Danza Clásica"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Danza Clásica'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Danza Clásica")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Danza Contemporánea"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Danza Contemporánea'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Danza Contemporánea")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Danza Española"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Danza Española'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Danza Española")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Flamenco"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Flamenco'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Flamenco")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Arte Dramático"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Arte Dramático'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Arte Dramático")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Música de Cámara"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Música de Cámara'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Música de Cámara")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Ópera y Oratorio"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Ópera y Oratorio'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Ópera y Oratorio")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Musicales"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Musicales'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Musicales")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Eventos varios"
                 class="especialidad"
                name="especialidad[]" @if(is_object(\GetSpecialties::getSpecialties('Eventos varios'))) checked @endif
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Eventos varios (Bodas, Ceremonias, etc.)")
            }}</label>
        </div>
    </div>

    @error('especialidad')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
