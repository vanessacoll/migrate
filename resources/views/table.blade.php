<div class="card">
    <div class="card-header">
        <h3 class="card-title">Datos para migrar</h3>
        <div class="card-tools">
            <a href="{{ route('migrar.conceptos') }}" class="btn btn-sm btn-primary">Migrar Conceptos</a>
        </div>
    </div>
    <div class="card-body table-responsive p-0" style="height: 350px;">
        <table class="table table-head-fixed text-nowrap">
            <thead>
            <tr>
            <th>Cedula</th>
            <th>Concepto</th>
            <th>Cantidad</th>
            <th>Monto</th>
            <th>Fecha</th>
            </tr>
            </thead>
            <tbody>
                @foreach($auxiliar as $item)
                    <tr>
                        <td>{{ $item->cedula }}</td>
                        <td>{{ $item->codcon }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>{{ $item->monto }}</td>
                        <td>{{ $item->fecha }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


