[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{ if $readonly}]
    [{assign var="readonly" value='readonly="readonly" disabled="disabled"'}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
[{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="adm2rest_api">
</form>

<script type="text/javascript" src="[{$oViewConf->getResourceUrl()}]admin2/utils.js"></script>

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
            </td>
            <td valign="top" class="edittext">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td class="edittext">
                            <label for="apiKey">[{ oxmultilang ident="ADMIN2_API_KEY" }]:</label>
                        </td>
                        <td class="edittext">
                            <input id="apiKey" type="text" name="admin2[apiKey]" value="[{ $edit.apiKey|escape }]" style="width:300px;" [{ $readonly}]>
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                        <label for="apiSecret">[{ oxmultilang ident="ADMIN2_API_SECRET" }]:</label>
                        </td>
                        <td class="edittext">
                            <input type="password" id="apiSecret" name="admin2[apiSecret]" value="[{ $edit.apiSecret|escape }]" style="width:300px;" [{ $readonly}]>
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
