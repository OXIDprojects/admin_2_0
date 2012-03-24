<?php

class Youtube extends Widget
{

    public $Width = "";
    public $Height = "";
    public $Source = "";

    public function output()
    {
        ob_start();
        ?>
        <iframe width="<?php echo $this->Width ?>" height="<?php echo $this->Height ?>" src="<?php echo $this->Source ?>" frameborder="0" allowfullscreen></iframe>

        <?php
        $output = ob_get_clean();
        return $output;
    }

}
?>