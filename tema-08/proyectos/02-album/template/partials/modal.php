<form action="<?= URL . 'albumes/subir/' . $album->id?>" method="POST" enctype="multipart/form-data">
<!-- Modal Subir Archivos -->
<div id="subir<?=$album->id?>" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Subir Archivos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <!-- Campo oculo validación tamaño archivo 4194304 -->
            <input type="hidden" name="MAX_FILE_SIZE" value="4194304">
            <input type="file" name="archivos[]"  multiple="multiple">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" name="subirArchivo">Subir</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Fin Modal Subir Archivos -->


