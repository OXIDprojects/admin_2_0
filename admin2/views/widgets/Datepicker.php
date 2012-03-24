<?php

class Datepicker extends Widget
{

    public $Id = "";
    public $Label = "";
    public $Date = "";
    public $MinDate = "";
    public $MaxDate = "";
    public $bHasJsDoc = true;

    public function output()
    {
        ob_start();
        ?>
        <div>
            <Label class="input" for="date_<?php echo $this->Id ?>"><?php echo $this->Label ?></Label>
            <input id="date_<?php echo $this->Id ?>" type="date" value=""/>
        </div>

        <?php
        $output = ob_get_clean();
        return $output;
    }

    public function getJsDocReady()
    {
        return "$(function(){
                $('#date_{$this->Id}').datepicker({
                    dateFormat: 'dd.mm.yy',
                    altFormat: 'yy-mm-dd'" .
                (($this->MinDate != "") ? ",minDate: new Date('{$this->MinDate}')" : "") .
                (($this->MaxDate != "") ? ",minDate: new Date('{$this->MaxDate}')" : "") .
                " }).datepicker('setDate', '{$this->Date} '); 
            });";
    }

}
?>