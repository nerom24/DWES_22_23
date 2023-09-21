<?php if (isset($this->mensaje)):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Mensaje </strong> <?= $this->mensaje; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>   
        </div>
<?php endif;?>