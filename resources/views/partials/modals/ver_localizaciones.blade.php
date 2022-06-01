<div class="modal fade" id="ver-localizaciones" tabindex="-1" role="dialog" aria-hidden="true">e
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-center" id="myCenterModalLabel">Localizaciones de {{$user->name}}</b></h4>
                <button type="button" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-4">
                <span class="mb-3 d-block text-center">Total de localizaciones: {{count($user->professor_locations)}}</span>
                <br>
                @foreach ($user->professor_locations as $i=>$location)
                    <span class="mb-3 d-block text-center">{{$i+1}}: Disponibilidad geográfica: {{$location->availability}}</span>
                    @switch($location->availability)
                    @case('Comunidad Autónoma')
                    <span class="mb-3 d-block text-center">Comunidad autónoma: {{$location->community}}</span>
                    @break
            
                    @case('Provincial')
                    <span class="mb-3 d-block text-center">Comunidad autónoma: {{$location->community}}</span>
                    <span class="mb-3 d-block text-center">Provincia: {{$location->province}}</span>
                    @break
            
                    @case('Población')
                    <span class="mb-3 d-block text-center">Comunidad autónoma: {{$location->community}}</span>
                    <span class="mb-3 d-block text-center">Provincia: {{$location->province}}</span>
                    <span class="mb-3 d-block text-center">Población: {{$location->city}}</span>
                    @break
                    @endswitch
                    <br>
                @endforeach
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

