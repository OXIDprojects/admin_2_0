<section id="" class="listentry <?php echo (isset($info->Width)) ? "grid_" . $info->Width : "" ?>">
    <header class="panelHead<?php echo (isset($info->Active) && $info->Active) ? " open" : "" ?>"><?php echo $info->Title ?></header>
    <section>
        <?php
        Field_Definitions::renderItems($info);
        ?>
    </section>
</section>