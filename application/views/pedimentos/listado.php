<?php

    if(isset($title)){
        echo '<h1>'.$title.'</h1>';
    }
?>
<div class='mainInfo'>
    <div class="row">

        <div align="center">
            <?php
            echo $output;
            ?>
        </div>
    </div>
</div>

<?php
if(!$this->ion_auth->is_admin())
{
    ?>
    <div align="right">
        <a href="#" class="btn small primary">Imprimir pedimentos</a>
    </div>
    <?php
}
?>


