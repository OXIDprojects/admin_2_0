<?php

class Column extends Widget
{

    public $Width = "";
    public $Items = Array();

    public function output()
    {
        ob_start();
        ?>
        <div class="<?php echo (isset($this->Width)) ? "grid_" . $this->Width : "" ?>">
            <?php
            foreach ($this->Items as $item)
            {
                echo $item->output();
            }
            ?>
        </div>
        <?php
        $output = ob_get_clean();
        return $output;
    }

}
