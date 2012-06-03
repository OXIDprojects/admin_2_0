<?php

class Text extends Widget
{

    public $Class = "";

    public function output()
    {
        ob_start();
        ?>
        <p><?php echo $this->Text ?></p>
        <?php
        $output = ob_get_clean();
        return $output;
    }

}
