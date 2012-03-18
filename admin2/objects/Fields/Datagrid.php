<div class="datagrid">
    <h3><?php echo $info->Label ?></h3>
    <table id="table_<?php echo $info->Id ?>">
        <thead>
        <tr>

            <?php
            foreach ($info->Fields as $field)
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
            $data = $restClient->getData($info->dataUrl);
            $data = $data;
            foreach ($data as $row) { ?>
                <tr>
                    <?php
                    foreach ($row as $cell) { ?>
                        <td><?php echo $cell ?></td><?php
                    } ?>
                </tr><?php
            } ?>
        </tbody>
    </table>
    <script>
        $('#table_<?php echo $info->Id ?>').dataTable({
            "bJQueryUI":true,
            "sPaginationType":"full_numbers"
        });
    </script>
</div>