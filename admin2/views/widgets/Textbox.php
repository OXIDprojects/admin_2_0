<?php

class Textbox extends Widget
{

    public $Id = "";
    public $Label = "";
    public $Name = "";
    public $Value = "";

    public function output()
    {
        ob_start();
        ?>
        <div>
            <Label class="input" for="<?php echo $this->Id ?>"><?php echo $this->Label ?></Label>
            <input id="<?php echo $this->Id ?>" name="<?php ?>" Type="text" value="<?php echo (isset($this->value)) ? $this->value : "" ?>" />
        </div>
        <?php
        $output = ob_get_clean();
        return $output;
    }

}
?>