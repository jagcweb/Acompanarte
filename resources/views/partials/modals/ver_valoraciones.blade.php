<div class="modal fade" id="ver-valoraciones" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-center" id="myCenterModalLabel">Valoraciones de {{$user->name}}</b></h4>
                <button type="button" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-4">
                @foreach ($user->ratings as $key=>$rate)
                    <div class="card mt-4" style="border:none; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="card-body">
                            <div style="display: flex; flex-direction: row;">
                                @if($rate->client->image)
                                <img src="{{url('mi-perfil/get-image/'.$rate->client->image)}}" alt="Acompañarte avatar"  class="rounded-circle" style="width:50px; height:50px!important;"/>
                                @else
                                <img src="{{url('assets')}}/images/user.png" alt="Acompañarte avatar" class="rounded-circle" style="width:50px; height:50px!important;" />
                                @endif
                                <p style="margin-left: -40px;" class="mt-3 w-100 mr-2 text-center">{{ucfirst(mb_substr($rate->client->name, 0, 1))}}***** - Valoración: {{$rate->rate}}</p>
                            </div>
                            @if(!is_null($rate->comment))
                                <blockquote class="mt-3 w-100">
                                    {{$rate->comment}}
                                </blockquote>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

