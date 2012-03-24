<?php

class Select extends Widget
{

    public $Id = "";
    public $Label = "";
    public $Options = Array();

    public function output()
    {
        ob_start();
        ?>
        <div class="select">

            <Label for="<?php echo $this->Id ?>"><?php echo $this->Label ?></Label>
            <select id="<?php echo $this->Id ?>" Type="checkbox" >
                <?php
                foreach ($this->Options as $option => $value)
                {
                    ?>
                    <option value="<?php echo $value ?>"> <?php echo $option ?><option>
                        <?php
                    }
                    ?>
            </select>
        </div>
        <?php
        $output = ob_get_clean();
        return $output;
    }

}
?>