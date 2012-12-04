[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{ if $readonly}]
    [{assign var="readonly" value='readonly="readonly" disabled="disabled"'}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
[{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="admin2rest">
</form>

<script type="text/javascript" src="[{$oViewConf->getModuleUrl('admin20')}]admin2/utils.js"></script>
<script type="text/javascript">
<!--
window.onload = function ()
{
    [{ if $updatelist == 1}]
        top.oxid.admin.updateList('[{ $oxid }]');
    [{ /if}]
    top.reloadEditFrame();
}
function editThis( sID )
{
    var oTransfer = top.basefrm.edit.document.getElementById( "transfer" );
    oTransfer.oxid.value = sID;
    oTransfer.cl.value = top.basefrm.list.sDefClass;

    //forcing edit frame to reload after submit
    top.forceReloadingEditFrame();

    var oSearch = top.basefrm.list.document.getElementById( "search" );
    oSearch.oxid.value = sID;
    oSearch.actedit.value = 0;
    oSearch.submit();
}
function processUnitInput( oSelect, sInputId )
{
    document.getElementById( sInputId ).disabled = oSelect.value ? true : false;
}
//-->
</script>
<h3>[{ oxmultilang ident="ADMIN2_API_HEAD_TITLE" }]</h3>
<h4>[{ oxmultilang ident="ADMIN2_API_DESCRIPTION" }]</h4>

<form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-left:15px;">
        <tr>
            <td>
                [{ $oViewConf->getHiddenSid() }]
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                <input type="hidden" name="fnc" value="save">
                <input type="hidden" name="oxid" value="[{ $oxid }]">
                <input type="hidden" name="editval[user__oxid]" value="[{ $oxid }]">
            </td>
            <td valign="top" class="edittext">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td class="edittext">
                            <label for="apiKey">[{ oxmultilang ident="ADMIN2_API_KEY" }]:</label>
                        </td>
                        <td class="edittext">
                            <input id="apiKey" type="text" name="editval[oxuser__apikey]" value="[{$edit->oxuser__apikey->value}]" style="width:300px;" [{ $readonly}]>
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                        <label for="apiSecret">[{ oxmultilang ident="ADMIN2_API_SECRET" }]:</label>
                        </td>
                        <td class="edittext">
                            <input type="password" id="apiSecret" name="editval[oxuser__apisecret]" value="[{$edit->oxuser__apisecret->value}]" style="width:300px;" [{ $readonly}]>
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                        </td>
                        <td class="edittext"><br>
                            <button type="button" onclick="admin2.setInputType('apiSecret', 'text');admin2.setInputValue('apiKey', admin2.generateString(8));admin2.setInputValue('apiSecret', admin2.generateString(32));">[{oxmultilang ident="ADMIN2_GENERATE_KEY_SECRET"}]</button>
                            <button type="button" onclick="admin2.setInputType('apiSecret', 'text');">[{oxmultilang ident="ADMIN2_SHOW_API_SECRET"}]</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                        </td>
                        <td class="edittext"><br>
                            <input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" [{ $readonly}]>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>

[{include file="bottomnaviitem.tpl"}]

[{include file="bottomitem.tpl"}]
