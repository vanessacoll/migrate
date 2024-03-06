<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Subir Archivo .xls</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('upload.file') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="archivo">Seleccionar archivo .xls</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="archivo" name="archivo" accept=".xls,.xlsx">
                        <label class="custom-file-label" for="archivo">Elegir archivo...</label>
                    </div>
                    <small id="fileHelp" class="form-text text-muted">Solo archivos .xls y .xlsx son permitidos.</small>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Subir</button>
            </div>
        </form>
        </div>
    </div>
</div>
