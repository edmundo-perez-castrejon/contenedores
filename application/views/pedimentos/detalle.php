<div class="well">
    <h1>Pedimento No. <?php echo $datos_pedimento->pedimento;?></h1>
</div>
<div class="container-fluid">

    <div class="sidebar" style="width:180px; font-size: 11px;">
        <div class="well">
            <span class="label warning">CLIENTE:</span><br/><b><?php echo $datos_cliente->first_name.' '.$datos_cliente->last_name;?></b><br/><br/>
            <span class="label warning">PROVEEDOR:</span><br/><b><?php echo $datos_proveedor->nombre.' <br/> '.$datos_proveedor->rfc;?></b><br/><br/>
            <span class="label warning">FACTURAS:</span><br/><b><?php echo $datos_proveedor->facturas;?></b><br/><br/>
            <span class="label warning">CONTENEDORES:</span><br/><b><?php echo $datos_pedimento->cantidad_contenedores;?></b><br/><br/>
            <span class="label warning">CONOCIMIENTO EMBARQUE:</span><br/><b><?php echo $datos_pedimento->conocimiento_embarque;?></b><br/><br/>
            <?php

            if($datos_pedimento->numero_cuenta_gastos>0)
            {
                ?>
                <span class="label notice">CUENTA DE GASTOS:</span><br/><b><?php echo $datos_pedimento->numero_cuenta_gastos;?></b><br/><br/>
                <?php
            }

            if($datos_pedimento->fecha_cuenta_gastos<>'0000-00-00')
            {
                ?>
                <span class="label notice">FECHA DE CUENTA:</span><br/><b><?php echo $datos_pedimento->fecha_cuenta_gastos;?></b><br/><br/>
                <?php
            }

            ?>
            <a href="#" class="btn small primary">IMPRIMIR DETALLE</a>
        </div>
     </div>
    <div class="content" style="margin-left: 185px;">
        <div class="hero-unit" style="padding-top: 5px;">
            <?php
                echo $output->output;
            ?>
        </div>
    </div>
</div>

<?php
print_r($datos_pedimento);
//print_r($datos_cliente);
//print_r($datos_proveedor);
?>

<!--    <div class='mainInfo'>
        <div class="row">

            <div align="center">
                <
            </div>
        </div>
    </div>
-->



<!--<div align="right">

</div>-->