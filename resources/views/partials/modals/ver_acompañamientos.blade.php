<div class="modal fade" id="ver-acompañamientos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-center" id="myCenterModalLabel">Eventos a acompañar de {{$user->name}}</b></h4>
                <button type="button" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-4">
                @foreach ($user->professor_accompaniments as $key=>$acompañamiento)
                    <a href="#" style="cursor: inherit;">
                        {{$acompañamiento->accompaniment}}@if (++$key != count($user->professor_accompaniments)),@else.@endif
                    </a>
                @endforeach
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

