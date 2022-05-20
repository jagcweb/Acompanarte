<div class="row mb-3 mt-4 font-22">
    <p class="text-center w-100">{{ __("Evento a acompañar") }}*</p>
    <div class="col-md-12 d-flex justify-content-center mb-3">
        <input
            type="checkbox"
            value="1"
            class="form-control todos_acompañamiento"
            name="todos"
        />
        <label for="check-1" class="specialty-label ml-2 col-form-label">{{
            __("Todos")
        }}</label>
    </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Pruebas de acceso a Conservatorio Profesional"
                class="form-control acompañamiento"
                name="acompañamiento[]"
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Pruebas de acceso a Conservatorio Profesional")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Pruebas de acceso a Conservatorio Superior"
                class="form-control acompañamiento"
                name="acompañamiento[]"
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Pruebas de acceso a Conservatorio Superior")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Oposiciones"
                class="form-control acompañamiento"
                name="acompañamiento[]"
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Oposiciones")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Conciertos"
                class="form-control acompañamiento"
                name="acompañamiento[]"
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Conciertos")
            }}</label>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 d-flex justify-content-start">
            <input
                type="checkbox"
                value="Otros"
                class="form-control acompañamiento"
                name="acompañamiento[]"
            />
            <label for="check-1" class="specialty-label ml-2 col-form-label">{{
                __("Otros")
            }}</label>
        </div>

    @error('especialidad')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
