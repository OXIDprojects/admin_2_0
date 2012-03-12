<div>
    <Label class="input" for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
    <input id="<?php echo $info->Id ?>" Type="number" value="<?php echo (isset($info->Value)) ? $info->Value : "" ?>" />
</div>