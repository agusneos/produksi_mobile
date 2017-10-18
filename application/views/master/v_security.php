<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<body>
    <div class="easyui-navpanel" >
        <table id="grid-master_security"
            data-options="singleSelect:true,border:false,fit:true,fitColumns:true,scrollbarSize:0">
            <thead>
                <tr>
                    <th data-options="field:'m_security_id',width:30" align="center" >Code</th>
                    <th data-options="field:'m_security_name',width:80" halign="center" >Name</th>
                    <th data-options="field:'m_security_username',width:80" halign="center" >Username</th>
                </tr>
            </thead>
        </table>
        <header>
            <div class="m-toolbar">
                <div class="m-left">
                    <a href="javascript:void(0)" class="easyui-linkbutton m-back" plain="true" outline="true" onclick="$.mobile.back();">Back</a>
                </div>
                <div class="m-title">Master Security</div>
                <div class="m-right">
                    <a href="javascript:void(0)" class="easyui-menubutton" data-options="iconCls:'icon-more',menu:'#menu-master_security',menuAlign:'right',hasDownArrow:false"></a>
                </div>
            </div>
        </header>
        <div id="menu-master_security" class="easyui-menu" style="width:150px;">
            <div onclick="masterSecurityCreate();" data-options="iconCls:'icon-add'"     >Add</div>
            <div onclick="masterSecurityUpdate();" data-options="iconCls:'icon-edit'"    >Edit</div>
            <div onclick="masterSecurityDelete();" data-options="iconCls:'icon-remove'"  >Delete</div>
        </div>
        
        <div id="dlg-master_security" class="easyui-dialog" style="padding:20px 6px;width:80%;" data-options="inline:true,closed:true">
            <form id="fm-master_security" method="post" novalidate>
                <div style="margin-bottom:10px">
                    <input class="easyui-textbox" id="m_security_name" name="m_security_name" label="Full name:" prompt="Full name" style="width:100%" required="true">
                </div>
                <div style="margin-bottom:10px">
                    <input class="easyui-textbox" id="m_security_username" name="m_security_username" label="Username:" prompt="Username" style="width:100%" required="true">
                </div>
                <div style="margin-bottom:10px">
                    <input class="easyui-passwordbox" id="m_security_password" name="m_security_password" label="Password:" prompt="Password" style="width:100%">
                </div>
                <div class="dialog-button">
                    <a href="javascript:void(0)" class="easyui-linkbutton" style="width:100%;height:35px" iconCls="icon-ok" onclick="masterSecuritySave();">Save</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" style="width:100%;height:35px" iconCls="icon-cancel" onclick="$('#dlg-master_security').dialog('close');">Cancel</a>
                </div>
            </form>
        </div>
    </div>
<script>
    $('#grid-master_security').datagrid({
        url : '<?php echo site_url('master/security/index'); ?>?grid=true'
    });
    
    function masterSecurityCreate() {
        $('#dlg-master_security').dialog({modal: true}).dialog('open').dialog('center').dialog('setTitle','Add Data');
        $('#fm-master_security').form('clear');
        url = '<?php echo site_url('master/security/create'); ?>';
    }
    
    function masterSecurityUpdate() {
        var row = $('#grid-master_security').datagrid('getSelected');
        if(row){
            $('#dlg-master_security').dialog({modal: true}).dialog('open').dialog('center').dialog('setTitle','Edit Data');
            $('#fm-master_security').form('clear');
            $('#fm-master_security').form('load',row);
            url = '<?php echo site_url('master/security/update'); ?>/' + row.m_security_id;
        }
        else{
             $.messager.alert('Info','Data not selected !','info');
        }
    }
    
    function masterSecuritySave(){
        $('#fm-master_security').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    $('#dlg-master_security').dialog('close');
                    $('#grid-master_security').datagrid('reload');
                    $.messager.show({
                        title   : 'Info',
                        msg     : '<div class="messager-icon messager-info"></div><div>Save Successfully</div>'
                    });
                }
                else{
                    var win = $.messager.show({
                        title   : 'Error',
                        msg     : '<div class="messager-icon messager-error"></div><div>Save Failed !</div>'+result.error
                    });
                    win.window('window').addClass('bg-error');
                }
            }
        });
    }
    
    function masterSecurityDelete(){
        var row = $('#grid-master_security').datagrid('getSelected');
        if (row){
            var win = $.messager.confirm('Confirm','Are you sure you want to delete '+row.m_security_name+' ?',function(r){
                if (r){
                    $.post('<?php echo site_url('master/security/delete'); ?>',{m_security_id:row.m_security_id},function(result){
                        if (result.success){
                            $('#grid-master_security').datagrid('reload');
                            $.messager.show({
                                title   : 'Info',
                                msg     : '<div class="messager-icon messager-info"></div><div>Deleted Successfully</div>'
                            });
                        }
                        else{
                            $.messager.show({
                                title   : 'Error',
                                msg     : '<div class="messager-icon messager-error"></div><div>Deleted Failed !</div>'+result.error
                            });
                        }
                    },'json');
                }
            });
            win.find('.messager-icon').removeClass('messager-question').addClass('messager-warning');
            win.window('window').addClass('bg-warning');
        }
        else{
             $.messager.alert('Info','Data not selected !','info');
        }
    }
</script>
<style type="text/css">
    .bg-error{ 
        background: red;
    }
    .bg-error .panel-title{
        color:#fff;
    }
    .bg-warning{ 
        background: yellow;
    }
    .bg-warning .panel-title{
        color:#000;
    }
</style>
</body>
</html>

<!-- End of file v_main.php -->
<!-- Location: ./application/views/v_main.php -->