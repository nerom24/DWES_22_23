<?php if (isset($mensaje)):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Mensaje</strong> <?= $mensaje; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>   
        </div>
<?php endif;?>