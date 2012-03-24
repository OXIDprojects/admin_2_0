<?php

class Form extends Widget
{

    public $Method = "POST";
    public $Items = Array();

    public function output()
    {
        ob_start();
        ?>
        <form action="index.php" method="<?php ($this->Method != "") ? $this->Method : "POST" ?>">
            <?php
            foreach ($this->Items as $item)
            {
                echo $item->output();
            }
            ?>
        </form>
        <?php
        $output = ob_get_clean();
        return $output;
    }

}
?>