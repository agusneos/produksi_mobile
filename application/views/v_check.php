<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<body>
    <div class="easyui-navpanel" >
        <table id="grid-master_check"
            data-options="singleSelect:true,border:false,fit:true,fitColumns:true,scrollbarSize:0">
            <thead>
                <tr>
                    <th data-options="field:'m_students_id',width:30"   align="center">Code</th>
                    <th data-options="field:'m_students_name',width:100" halign="center">Name</th>
                    <th data-options="field:'t_leave_time',width:100"    align="center">Date & Time</th>
                </tr>
            </thead>
        </table>
        <header>
            <div class="m-toolbar">
                <div class="m-left">
                    <a href="javascript:void(0)" class="easyui-linkbutton m-back" plain="true" outline="true" onclick="$.mobile.back();">Back</a>
                </div>
                <div class="m-title">Leave</div>
            </div>
        </header>
    </div>
<script>
    $('#grid-master_check').datagrid({
        url : '<?php echo site_url('check/index'); ?>?grid=true',
        rowStyler:function(index,row){
            if (row.t_leave_time != null){
                return 'background-color:#F49AC2;color:#000;';
            }
            else{
                return 'background-color:#77DD77;color:#000;';
            }
        }
    });
</script>
</body>
</html>

<!-- End of file v_main.php -->
<!-- Location: ./application/views/v_main.php -->