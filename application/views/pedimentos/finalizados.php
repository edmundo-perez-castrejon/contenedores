<div class=well style="background-image: url('<?php echo base_url().'images/system/finalizado.jpg'?>');
    background-size:180px 120px;
    background-repeat:no-repeat;
    background-position:right;">
    <h2>
        <?php
        if(isset($title)){
            echo $title;
        }
        ?>
    </h2>
</div>

<script src="http://localhost/contenedores/assets/grocery_crud/js/jquery_plugins/jquery-ui-1.8.10.custom.min.js"></script>
<link type="text/css" rel="stylesheet" href="http://localhost/contenedores/assets/grocery_crud/css/ui/simple/jquery-ui-1.8.10.custom.css" />

<div class='mainInfo'>
    <div class="row">

        <div align="center">
            <?php
            echo $output;
            ?>
        </div>
    </div>
</div>
