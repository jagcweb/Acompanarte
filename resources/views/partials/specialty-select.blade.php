<div class="row mb-3">
    <label for="geografica" class="col-md-4 col-form-label text-md-end">{{ __('Especialidad') }}*</label>

    <div class="col-md-12">
        <select id="especialidad" class="especialidad form-control @error('especialidad') is-invalid @enderror" name="especialidad" required>
            <option selected hidden disabled>Selecciona un tipo de especialidad...</option>
            <option value="Acordeón">Acordeón</option>
            <option value="Arpa">Arpa</option>
            <option value="Cante Flamenco">Cante Flamenco</option>
            <option value="Canto">Canto</option>
            <option value="Clarinete">Clarinete</option>
            <option value="Contrabajo">Contrabajo</option>
            <option value="Coro">Coro</option>
            <option value="Fagot">Fagot</option>
            <option value="Flauta">Flauta</option>
            <option value="Guitarra">Guitarra</option>
            <option value="Música Antigua (Clavecinista)">Música Antigua (Clavecinista)</option>
            <option value="Música Antigua (Organista)">Música Antigua (Organista)</option>
            <option value="Instrumentos de Púa">Instrumentos de Púa</option>
            <option value="Oboe">Oboe</option>
            <option value="Orquesta">Orquesta</option>
            <option value="Percusión">Percusión</option>
            <option value="Saxofón">Saxofón</option>
            <option value="Trombón">Trombón</option>
            <option value="Trompa">Trompa</option>
            <option value="Tuba">Tuba</option>
            <option value="Viola">Viola</option>
            <option value="Violín">Violín</option>
            <option value="Violonchelo">Violonchelo</option>
            <option value="Danza Clásica">Danza Clásica</option>
            <option value="Danza Contemporánea">Danza Contemporánea</option>
            <option value="Danza Española">Danza Española</option>
            <option value="Flamenco">Flamenco</option>
            <option value="Arte Dramático">Arte Dramático</option>
            <option value="Música de Cámara">Música de Cámara</option>
            <option value="Ópera y Oratorio">Ópera y Oratorio</option>
            <option value="Musicales">Musicales</option>
            <option value="Eventos varios">Eventos varios (Bodas, Ceremonias, etc.)</option>
        </select>

        @error('especialidad')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>