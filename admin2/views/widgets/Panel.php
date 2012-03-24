<?php

class Panel extends Widget
{

    public $Width = "";
    public $Active = true;
    public $Title = "";
    public $Items = Array();

    public function output()
    {
        ob_start();
        ?>
        <section class="listentry <?php echo (isset($this->Width)) ? "grid_" . $this->Width : "" ?>">
            <header class="panelHead<?php echo (isset($this->Active) && $this->Active) ? " open" : "" ?>"><?php echo $this->Title ?></header>
            <section>
                <?php
                foreach ($this->Items as $item)
                {
                    echo $item->output();
                }
                ?>
            </section>
        </section>
        <?php
        $output = ob_get_clean();
        return $output;
    }

}
?>