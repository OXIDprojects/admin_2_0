<?php

class Numberbox extends Widget
{

    public $Id = "";
    public $Label = "";
    public $Value = "";

    public function output()
    {
        ob_start();
        ?>
        <div>
            <Label class="input" for="<?php echo $this->Id ?>"><?php echo $this->Label ?></Label>
            <input id="<?php echo $this->Id ?>" Type="number" value="<?php echo (isset($this->Value)) ? $this->Value : "" ?>" />
        </div>
        <?php
        $output = ob_get_clean();
        return $output;
    }

}
