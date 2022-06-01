<div style="padding:15px; width:100%;">
    <p style="width:100%; font-size:15px;">¡Hola {{$user->fullname}}! tienes una nueva solicitud de contacto. <a href="{{route('contact_request.detail', ['id' => \Crypt::encryptString($contact_request->id)])}}">Haz click aquí para verla</a></a></p>
    <p style="width:100%; font-size:15px;">¡Un saludo! El equipo, Encuentra Pianista.</p>
</div>