
<div class="row">
    <div class="span16" align="center">
        <h2><?php echo $datos_pedimento->pedimento;?></h2>
    </div>
    <div class="span8"><b>Cliente</b>
        <span class="label notice">
            <?php
            echo $datos_cliente->first_name.' '.$datos_cliente->last_name;
            ?>
        </span>

        <BR/>
        <b>Proveedor</b>
        <span class="label notice">
            <?php
            echo $datos_proveedor->nombre.'/'.$datos_proveedor->rfc;
            ?>
        </span>
    </div>
    <div class="span8" align="right">
        <b>Conocimiento embarque</b>
        <span class="label notice"><?php echo $datos_pedimento->conocimiento_embarque;?></span>
        <br/>
        <b>Cantidad de contenedores</b>
        <span class="label notice"><?php echo $datos_pedimento->cantidad_contenedores;?></span>
    </div>
</div>





