<?php

class Datagrid extends Widget
{


    public $Id = "";
    public $Label = "";
    public $Fields = Array();
    public $DataUrl = "";
    public $Data = "";
    public $bHasJs = true;
    public $bHasJsDoc = true;

    public $jsLibs = array("jquery.dataTables.min");

    public function output()
    {
        ob_start();
        ?>

        <div class="datagrid">
            <h3><?php echo $this->Label  ?></h3>
            <table id="table_<?php echo $this->Id ?>">
                <thead>
                    <tr>

                        <?php
                        foreach ($this->Fields as $field)
                        {
                            ?>
                            <th><?php echo $field->Label ?></th>
                            <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $restClient = new Rest_Client();
                    $data = $restClient->getData($this->DataUrl);

                    foreach ($data as $row)
                    {
                        ?>
                        <tr>
                            <?php foreach ($row as $cell)
                            {
                                ?>
                                <td><?php echo $cell ?></td><?php }
            ?>
                        </tr><?php }
        ?>
                </tbody>
            </table>

        </div>

        <?php
        $output = ob_get_clean();
        return $output;
    }
    public function getJsDocReady()
    {
        return "$('#table_{$this->Id}').dataTable({
                    'bJQueryUI':true,
                    'sPaginationType':'full_numbers'
                });";
    }

}
