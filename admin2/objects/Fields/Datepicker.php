<div>
    <Label class="input" for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
    <input id="<?php echo $info->Id ?>" type="date" value=""/>
</div>
<script>
    $(function(){
        $("input[type='date']").datepicker({
            dateFormat: "dd.mm.yy",
            altFormat: 'yy-mm-dd'
            <?php
                echo (isset($info->MinDate)) ? ",minDate: new Date('{$info->MinDate}')" : "";
                echo (isset($info->MaxDate)) ? ",minDate: new Date('{$info->MaxDate}')" : "";
            ?>
        }).datepicker('setDate', '<?php echo $info->Date ?>'); 
    });
</script>