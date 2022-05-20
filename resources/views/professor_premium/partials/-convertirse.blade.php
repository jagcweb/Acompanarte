<div class="container">
    <p class="text-center w-100">Ventajas de convertirse en premium</p>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Free
                </div>
                <div class="card-body">
                    <p>- Publica anuncios.</p>
                    <p>- Calendario de disponibilidad.</p>
                    <p>- Planificador de ensayos.</p>
                    <p>- Recepción de partituras en PDF.</p>    
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Premium
                </div>
                <div class="card-body">
                    <p>- Todas las ventajas del modelo gratuito.</p>   
                    <p>- Tus anuncios se mostrarán de forma prioritaria.</p>   
                    <p>- Podrás <a style="color:black; text-decoration:underline;" href="#"><b>verificar tu perfil*</b></a>.</p>   
                    <p>- Obtendrás el teléfono y/o e-mail de las personas que contacten contigo.</p>   
            
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Suscripción trimestral
                </div>
                <div class="card-body">
                    @if(!is_null($quarterly->discount))
                    <p><del>{{number_format($quarterly->price, 2)}}€</del> - {{number_format($quarterly->price - ($quarterly->price * $quarterly->discount / 100), 2)}}€</p>
                    @else
                    <p>{{number_format($quarterly->price, 2)}}€</p>
                    @endif
                    <a href="{{ route('configuration_premium.payment2', ['param' => 'trimestral']) }}" class="w-100 btn btn-dark text-center mt-3" style="color:#fff;">Elegir suscripción trismestral</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Suscripción anual
                </div>
                <div class="card-body">
                    @if(!is_null($annual->discount))
                    <p><del>{{number_format($annual->price, 2)}}€</del> - {{number_format($annual->price - ($annual->price * $annual->discount / 100), 2)}}€</p>
                    @else
                    <p>{{number_format($annual->price, 2)}}€</p>
                    @endif
                    <a href="{{ route('configuration_premium.payment2', ['param' => 'anual']) }}" class="w-100 btn btn-dark text-center mt-3" style="color:#fff;">Elegir suscripción anual</a>

                </div>
            </div>
        </div>
    </div>
</div>