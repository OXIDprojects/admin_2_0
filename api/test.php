<?php
/**
 *  This file is part of Admin 2.0 project for OXID eShop CE/PE/EE.
 *
 *  The Admin 2.0 sourcecode is free software: you can redistribute it and/or modify
 *  it under the terms of the MIT License.
 *
 *  @link      http://admin20.de
 *  @copyright (C) 2012 :: Admin 2.0 Developers
 */

$publicUrl = dirname($_SERVER['SCRIPT_NAME']);
$srcDir = '../admin2/views/src';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Testing API REST methods</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $srcDir;?>/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $srcDir;?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $srcDir;?>/css/fluid_grid.css">

    <style type="text/css">
        #varInputDialog {
            display:none;
        }
    </style>

    <script type="text/javascript" src="<?php echo $srcDir;?>/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $srcDir;?>/js/jquery-ui-1.8.18.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo $srcDir;?>/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div>
        <form id="testingForm" action="<?php echo $publicUrl; ?>/rest/" onsubmit="return false;">
            <table>
                <tr>
                    <th nowrap="nowrap"><label for="method">Request method:</label></th>
                    <td>
                        <select id="method" name="method">
                            <option value="GET" selected="selected">GET</option>
                            <option value="POST">POST</option>
                            <option value="PUT">PUT</option>
                            <option value="DELETE">DELETE</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="baseUrl">Base URL:</label></th>
                    <td><input type="text" name="baseUrl" id="baseUrl" value="<?php echo $publicUrl; ?>/rest/"></td>
                </tr>
                <tr>
                    <th><label for="apiVersion">API version:</label></th>
                    <td>
                        <select id="apiVersion" name="apiVersion">
                            <option value="v1" selected="selected">Version 1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="controller">Controller:</label></th>
                    <td><input type="text" id="controller" name="controller"></td>
                </tr>
                <tr>
                    <th><label for="entity">Entity:</label></th>
                    <td><input type="text" id="entity" name="entity"></td>
                </tr>
                <tr>
                    <th><label for="format">Request format:</label></th>
                    <td><select id="format" name="format">
                        <option value="json" selected="selected">JSON</option>
                        <option value="html">HTML</option>
                        <option value="csv">CSV (not recommended)</option>
                    </select></td>
                </tr>
                <tr>
                    <th>Request data:</th>
                    <td>
                        <table id="dataTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Key</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button type="submit">Submit</button>
                        <button type="button" id="addVariable">Add variable</button>
                    </td>
                </tr>
                <tr>
                    <th>Response:</th>
                    <td id="result-div"></div>
                </tr>
            </table>
        </form>
    </div>

    <div id="varInputDialog">
        <form action="#" method="get" onsubmit="return false;">
            <table>
                <tr>
                    <th>Variable name:</th>
                    <td><input type="text" id="varName"></td>
                </tr>
                <tr>
                    <th>Variable value:</th>
                    <td><input type="text" id="varValue"></td>
                </tr>
            </table>
        </form>
    </div>

    <script type="text/javascript">
        var restUrl = <?php echo json_encode($publicUrl . '/rest/'); ?>;
        $(function() {
            $('#testingForm').bind('submit', function () {
                var url = restUrl + $('#apiVersion').val() + '/' + $('#controller').val();
                var entity = $('#entity').val();
                if (entity != '') {
                    url += '/' + entity;
                }

                url += '.' + $('#format').val();
                var rawData = $('#dataTable').dataTable().fnGetData();
                var data = {};
                for (var i = 0; i < rawData.length; i++) {
                    var row = rawData[i];
                    data[row[1]] = row[2];
                }

                $.ajax({
                    "type":$('#method').val(),
                    "url":url,
                    "data":data,
                    "success":function (r) {
                        if ($('#format').val() == 'json') {
                            $('#result-div').html('See firebug console');
                        } else {
                            $('#result-div').html(r);
                        }
                        console.debug(r);
                    }
                });
                return false;
            });

            $('#dataTable').dataTable({
                "bPaginate":false,
                "bFilter":false,
                "bSort":false
            });

            $('button').button({});

            $('#addVariable').bind('click', function () {
                $('#varName').val('');
                $('#varValue').val('');
                $('#varInputDialog').dialog({
                    "modal":true,
                    "title":"Add a variable to request",
                    "width":"500px",
                    "buttons":{
                        "ok": {
                            "text":"OK",
                            "click":function () {
                                $('#dataTable').dataTable().fnAddData([
                                    '<a href="#" onclick="removeRow(this);return false;">remove<\/a>',
                                    $('#varName').val(),
                                    $('#varValue').val()
                                ]);

                                $(this).dialog('close');
                            }
                        },
                        "cancel":{
                            "text":"Cancel",
                            "click":function () {
                                $(this).dialog('close');
                            }
                        }
                    }
                });
            });
        });
        function removeRow(anchorNode)
        {
            if ($('#dataTable').dataTable().fnGetData().length == 1) {
                $('#dataTable').dataTable().fnClearTable();
                return;
            }
            var trNode = $(anchorNode).parent().parent();
            $('#dataTable').dataTable().fnDeleteRow(trNode);
        }
    </script>
</body>
</html>
