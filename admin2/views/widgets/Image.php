<?php

class Image extends Widget
{


    public $Source = "";
    public $Title = "";
    public $Alt = "";
    public $Class = "";

    public function output()
    {
        ob_start();
        ?>
        <img src="<?php echo $this->Source ?>" title="<?php echo (isset($this->Label)) ? $this->Label : "" ?>" />
        <?php
        $output = ob_get_clean();
        return $output;
    }

}
