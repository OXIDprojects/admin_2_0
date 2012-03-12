<div class="select">

    <Label for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
    <select id="<?php echo $info->Id ?>" Type="checkbox" >
        <?php
        foreach ($info->option as $option => $value)
        {
            ?>
            <option value="<?php echo $value ?>"> <?php echo $option ?><option>
            <?php
        }
        ?>
    </select>
</div>