<hr class="mt-5 mb-5">
@if(count($history)>0)
<p class="w-100 text-center">Historial de pagos de suscripción</p>
<table style="font-size: 15px" data-toggle="table" data-locale="es-ES" data-filter-control="true" data-search="true"
    data-page-list="[10, 20, 30]" data-page-size="10" data-buttons-class="xs btn-light" data-pagination="true" class="table-borderless">
    <thead class="thead-light">
        <tr>
            <th data-field="type" data-align="center" data-filter-control="input">Tipo</th>
            <th data-field="date" data-align="center" data-filter-control="input">Fecha<br>cobro</th>
            <th data-field="date2" data-align="center" data-filter-control="input">Fecha<br>finalización</th>
            <th data-field="pdf" data-align="center" data-filter-control="input">PDF Factura</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($history as $hist)
        
            <tr>
                <td>{{ucfirst($hist->type)}}</td>
                <td>{{\Carbon\Carbon::parse($hist->created_at)->format('d/m/Y')}}</td>
                <td>{{\Carbon\Carbon::parse($hist->ended_at)->format('d/m/Y')}}</td>
                <td><a href="{{url('configuracion-premium/get-invoice/'.$hist->pdf)}}" target="_blank" class="text-dark" style="font-size:24px;"><i class="fa-solid fa-file-pdf"></i></a></td>
            <tr>

        @endforeach
    </tbody>
</table>
@else
<p class="w-100 text-center">Aún no hay ningún registro en el historial de suscripciones.</p>
@endif