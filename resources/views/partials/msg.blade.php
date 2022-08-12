@if(Session::has('error'))
<div class="alert alert-danger" style="position: absolute; top: 0; right: 0;">
    {{ Session::get('error') }}
    @php
        Session::forget('error');
    @endphp
</div>
@endif

@if(Session::has('exito'))
<div class="alert alert-success" style="position: absolute; top: 0; right: 0;">
    {!! Session::get('exito') !!}
    @php
        Session::forget('exito');
    @endphp
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger" style="position: absolute; top: 0; right: 0;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif