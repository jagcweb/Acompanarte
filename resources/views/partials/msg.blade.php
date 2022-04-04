@if(Session::has('error'))
<div class="alert alert-danger" style="margin-top: 85px;">
    {{ Session::get('error') }}
    @php
        Session::forget('error');
    @endphp
</div>
@endif

@if(Session::has('exito'))
<div class="alert alert-success" style="margin-top: 85px;">
    {!! Session::get('exito') !!}
    @php
        Session::forget('exito');
    @endphp
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger" style="margin-top: 85px;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif