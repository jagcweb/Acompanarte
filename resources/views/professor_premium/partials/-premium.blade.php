<div class="container">
    <p class="w-100 text-center">Suscripción activa hasta {{Carbon\Carbon::parse(Auth::user()->suscription->ended_at)->format('d/m/Y')}}</p>

    @if(Auth::user()->suscription->auto_renew == 1)
    <a href="{{ route('configuration_premium.auto_renew') }}" class="w-100 btn btn-dark text-center mt-3"
        style="color:#fff;">No renovar suscripción</a>
    @else
    <a href="{{ route('configuration_premium.auto_renew') }}" class="w-100 btn btn-dark text-center mt-3"
    style="color:#fff;">Renovar suscripción automáticamente</a> 
    @endif
</div>