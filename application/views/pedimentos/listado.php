<div class=well style="background-image: url('<?php echo base_url().'images/system/pedimento.jpg'?>');
    background-size:180px 100px;
    background-repeat:no-repeat;
    background-position:right;">

<?php    if(!isset($title)){ ?>
        <h2>Administracion de Pedimentos</h2>
<?php
}else{
        echo '<h2>'.$title.'</h2>';
    }

?>
</div>

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


