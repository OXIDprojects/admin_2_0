<?php

class Columns extends Widget
{

    public $Items = Array();

    public function output()
    {

        ob_start();
        ?>
        <div class="container_16">
            <?php
            foreach ($this->Items as $item)
            {
                echo $item->output();
            }
            ?>
            <div class="clearfix"></div>
        </div>
        <?php
        $output = ob_get_clean();
        return $output;
    }

}
?>