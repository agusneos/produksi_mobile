<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>    
    <meta charset="UTF-8">    
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login</title>    
    <link rel="icon" type="image/png" href="<?=base_url('assets/easyui/themes/icons/login.png')?>">
    
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/easyui/themes/default/easyui.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/easyui/themes/mobile.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/easyui/themes/icon.css')?>">
    <script type="text/javascript" src="<?=base_url('assets/easyui/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/easyui/jquery.easyui.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/easyui/jquery.easyui.mobile.js')?>"></script>
</head>
<body>
    <div class="easyui-navpanel">
        <header>
            <div class="m-toolbar">
                <span class="m-title">Login to System</span>
            </div>
        </header>
        
        <div style="margin:20px auto;width:100px;height:100px;border-radius:100px;overflow:hidden">
            <img src="<?=base_url('assets/easyui/themes/icons/maxi_login.png')?>" style="margin:0;width:100%;height:100%;">
        </div>
        
        <div style="padding:0 20px">
            <form id="form-login" method="post" novalidate onsubmit="return false">
                <div>
                    <input id="password" name="password" class="easyui-textbox" type="password" data-options="prompt:'ID Operator'" tabindex="1" required="true" style="width:100%;height:38px">
                </div>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function(){	
        $('#password').next().find('input').focus();
    });
    
    $(function(){    
        $('#password').textbox('textbox').keypress(function(e){
            if (e.keyCode == 13){
                login();
            }
        });
    });
    
    function login(){
        var ip = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
        var id = $('#password').passwordbox('getValue');
        $.post('<?php echo site_url('main/init'); ?>',{ip:ip, id:id},function(result){            
            if (result.success == 'machine not register'){
                $('#form-login').form('clear');
                $.messager.show({
                    title   : 'Error',
                    msg     : '<div class="messager-icon messager-error"></div><div>Komputer Belum Diregister !</div>',
                    showType: 'fade',
                    timeout : 1000,
                    height  : 120, 
                    style   : {
                                right:'',
                                bottom:''
                    }
                });
            }
            
            else if(result.success == 'user not register'){
                $('#form-login').form('clear');
                $.messager.show({
                    title   : 'Error',
                    msg     : '<div class="messager-icon messager-error"></div><div>Operator Belum Diregister !</div>',
                    showType: 'fade',
                    timeout : 1000,
                    height  : 120,
                    style   : {
                                right:'',
                                bottom:''
                    }
                });
            }
            else{
                progress();
            }
        },'json');
    }
    
    function progress(){
        $.messager.progress({
            title   :'Please wait',
            msg     :'Loading data...'
        });
        setTimeout(function(){
            $.messager.progress('close');
            window.location.assign('<?php echo site_url("")//redirect ke index; ?>');
        },1000);
    }
    
    
</script>
 
</html>

<!-- End of file v_login.php -->
<!-- Location: ./application/views/v_login.php -->