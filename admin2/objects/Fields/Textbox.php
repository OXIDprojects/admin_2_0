<div>
    <Label class="input" for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
    <input id="<?php echo $info->Id ?>" Type="text" value="<?php echo (isset($info->value)) ? $info->value : "" ?>" />
</div>