[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{ if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="adm2rest_api">
</form>

<form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
[{ $oViewConf->getHiddenSid() }]
<input type="hidden" name="cl" value="adm2rest_api">
<input type="hidden" name="fnc" value="">
<input type="hidden" name="oxid" value="[{ $oxid }]">
<input type="hidden" name="oxidAPI" value="[{ $oxidAPI }]">

<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%">
<tr>
    <td width="15"></td>
    <td valign="top" class="edittext">
        <table cellspacing="0" cellpadding="0" border="0">
        [{ if $edit->adm2rest_api__oxapiaccesskey->value }]
            <tr>
                <td class="edittext">
                [{ oxmultilang ident="ADM2REST_API_ACCESS" }]
                </td>
                <td class="edittext">
                    <input type="hidden" name="editval[adm2rest_api__oxapiaccess]" value='0'>
                    <input class="edittext" type="checkbox" name="editval[adm2rest_api__oxapiaccess]" value='1'[{ if $edit->adm2rest_api__oxapiaccess->value }]checked [{ /if }][{ $readonly}]>
                </td>
            </tr>
        [{ /if}]
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="ADM2REST_API_ACCESS_KEY" }]
            </td>
            <td class="edittext">
            [{ if $edit->adm2rest_api__oxapiaccesskey->value}]
                <input type="text" class="editinput" size="25" maxlength="[{$edit->adm2rest_api__oxapiaccesskey->fldmax_length}]" name="editval[adm2rest_api__oxapiaccesskey]" value="[{$edit->adm2rest_api__oxapiaccesskey->value}]" style="width: 220px; background: #f0f0f0;" readonly>
                [{ oxinputhelp ident="HELP_ADM2REST_API_ACCESS_KEY" }]
            [{ else}]
                <input type="submit" class="edittext" value=" [{ oxmultilang ident="GET_ADM2REST_API_ACCESS_KEY" }] " onClick="Javascript:document.myedit.fnc.value='getApiKey'"" [{ $readonly}]>
            [{ /if}]
            </td>
        </tr>
        [{ if $edit->adm2rest_api__oxapiaccesskey->value }]
            <tr>
                <td class="edittext">
                </td>
                <td class="edittext"><br>
                <input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'"" [{ $readonly}]>
                </td>
            </tr>
        [{ /if}]
        </table>
    </td>
    </tr>
</table>
</form>

[{include file="bottomnaviitem.tpl"}]

[{include file="bottomitem.tpl"}]
