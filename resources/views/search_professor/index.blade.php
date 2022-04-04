@extends('layouts.app')
@section('css')
<link href="{{ url('assets') }}/css/search_professor.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center d-block mb-2">Profesores disponibles en:</h2>
            @for($i=0; $i<=5; $i++)
            <div class="card mb-2">
              <div class="card-body" style="display:flex; justify-content:space-between; border:none;">
                <div style="display:flex; justify-content: center; align-items: center;">
                  <img src="{{url('assets')}}/images/user.png" alt="user-image" class="rounded-circle" width="85" />
                </div>
                <div style="width:100%; display:flex; flex-direction:column; justify-content: center; align-items: center;">
                  <h3>Profesor name</h3>
                  <span>Ciudad</span>
                  <span>Trabajos</span>
                  <span>Valoración</span>
                  <span>★★★★☆</span>
                </div>
              </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection
