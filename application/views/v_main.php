<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>   
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Input Hasil Produksi</title>
    <link rel="icon" type="image/png" href="<?=base_url('assets/easyui/themes/icons/screw.png')?>">
    
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/easyui/themes/default/easyui.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/easyui/themes/color.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/easyui/themes/mobile.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/easyui/themes/icon.css')?>">
    <script type="text/javascript" src="<?=base_url('assets/easyui/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/easyui/jquery.easyui.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/easyui/jquery.easyui.mobile.js')?>"></script>
    
    <script type="text/javascript">
        function startTime() {
            var months  = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            var myDays  = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
            var date    = new Date();
            var day     = date.getDate();
            var month   = date.getMonth();
            var thisDay = date.getDay(),
                thisDay = myDays[thisDay];
            var yy      = date.getYear();
            var year    = (yy < 1000) ? yy + 1900 : yy;

            var today   = new Date(),
            curr_hour   = today.getHours(),
            curr_min    = today.getMinutes(),
            curr_sec    = today.getSeconds();
            curr_hour   = checkTime(curr_hour);
            curr_min    = checkTime(curr_min);
            curr_sec    = checkTime(curr_sec);
            $('#clock').linkbutton({text:thisDay + ', ' + day + ' ' + months[month] + ' ' + year + ' - ' + curr_hour+":"+curr_min+":"+curr_sec});
            }
        function checkTime(i) {
            if (i<10) {
                i="0" + i;
            }
            return i;
        }
        setInterval(startTime, 500);
    </script>
</head>
<body>
<style type="text/css">
    .ftitle{
        font-size:14px;
        font-weight:bold;
        padding:5px 0;
        margin-bottom:10px;
        border-bottom:1px solid #ccc;
    }
    .fitem{
        margin-bottom:5px;
    }
    .fitem label{
        display:inline-block;
        width:80px;
    }        
    .fitem input{
        font-size:20px;
    }
    .easyui-numberbox {
        text-align: center;
    }
    .easyui-textbox {
        text-align: center;
    }
    .messager-body{
            font-size: 20px;
    }
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
    .textbox .textbox-text,
    .textbox .textbox-prompt{
            font-size: 20px;
    }
</style>    
    <div id="p-main" class="easyui-navpanel">
        <header>
            <div class="m-toolbar">
                <div class="m-title">Main Menu</div>
                <div class="m-left">
                    <a href="<?php echo site_url('main/logout'); ?>" class="easyui-linkbutton" data-options="iconCls:'icon-logout'" style="width:70px">Logout</a>
                </div>
            </div>
        </header>
        <div id="mm" class="easyui-menu" style="width:150px;" data-options="itemHeight:30,noline:true">
            <div href="<?php echo site_url('main/logout'); ?>" data-options="iconCls:'icon-logout'">Logout</div>
        </div>
        
        <div id="tt-main" class="easyui-tabs" data-options="tabHeight:60,fit:true,tabPosition:'bottom',border:false,pill:true,narrow:true,justified:true">
            <div style="padding:10px">
                <div class="panel-header tt-inner">
                    <img src='<?=base_url('assets/easyui/themes/icons/custom/qrcode.png')?>'/><br>SCAN
                </div>
                <h3 align="center"><?php echo strtoupper($this->session->userdata('name'));?></h3>
                <h2 align="center">INPUT PROSES <?php echo strtoupper($this->session->userdata('proc'));?></h2>  

                <form id="form-scan" method="post" novalidate onsubmit="return false">
                    <div style="font-size:20px;margin-bottom:20px">
                        <input id="lineId" name="lineId" class="easyui-numberbox" required="true" label="LINE" labelPosition="left" style="width:80%;height:40px;padding:12px" tabindex="1">
                    </div>
                    <div style="font-size:20px;margin-bottom:20px">
                        <input id="machId" name="machId" class="easyui-numberbox" required="true" label="MESIN" labelPosition="left" style="width:80%;height:40px;padding:12px" tabindex="2">
                    </div>
                    <div style="font-size:20px;margin-bottom:20px">
                        <input id="scanId" name="scanId" class="easyui-numberbox" required="true" label="KARTU" labelPosition="left" style="width:80%;height:40px;padding:12px" tabindex="3">
                    </div>                         
                </form>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload'" onclick="buttonReset();">RESET</a>
            </div>
            <div style="padding:10px;background-color:#66ff99">
                <div class="panel-header tt-inner">
                    <img src='<?=base_url('assets/easyui/themes/icons/large_smartart.png')?>'/><br>UPDATE
                </div>
                <h3 align="center"><?php echo strtoupper($this->session->userdata('name'));?></h3>
                <h2 align="center">UPDATE PROSES <?php echo strtoupper($this->session->userdata('proc'));?></h2>  

                <form id="form-update" method="post" novalidate onsubmit="return false">
                    <div style="font-size:20px;margin-bottom:20px">
                        <input id="upScanId" name="upScanId" class="easyui-numberbox" required="true" label="KARTU" labelPosition="left" style="width:80%;height:40px;padding:12px" tabindex="4">
                    </div>
                    <div style="font-size:20px;margin-bottom:20px">
                        <input id="idPros" name="idPros" class="easyui-numberbox" label="Proc. Id" labelPosition="left" data-options="min:0,precision:0" style="width:80%;height:40px;padding:12px" readonly>
                    </div>
                    <div style="font-size:20px;margin-bottom:20px">
                        <input id="currentKg" name="currentKg" class="easyui-numberbox" label="Before" labelPosition="left" data-options="min:0,precision:2" style="width:80%;height:40px;padding:12px" readonly><a> Kg</a>
                    </div>
                    <div style="font-size:20px;margin-bottom:20px">
                        <input id="grPcs" name="grPcs" class="easyui-numberbox" label="Gr/Pcs" labelPosition="left" data-options="min:0,precision:2" style="width:80%;height:40px;padding:12px" readonly><a> Gr</a>
                    </div>
                    <div style="font-size:20px;margin-bottom:20px">
                        <input id="afterKg" name="afterKg" class="easyui-numberbox" required="true" label="After" labelPosition="left" data-options="min:0,precision:2" style="width:80%;height:40px;padding:12px" tabindex="5"><a> Kg</a>
                    </div>
                </form>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload'" onclick="updateButtonReset();">RESET</a>
            </div>
            <div style="padding:10px;background-color:#ff6666">
                <div class="panel-header tt-inner">
                    <img src='<?=base_url('assets/easyui/themes/icons/custom/problem-icon.png')?>'/><br>KBM
                </div>
                <h3 align="center"><?php echo strtoupper($this->session->userdata('name'));?></h3>
                <h2 align="center">KBM PROSES <?php echo strtoupper($this->session->userdata('proc'));?></h2>
                <form id="form-update" method="post" novalidate onsubmit="return false">
                    <div style="font-size:20px;margin-bottom:20px">
                        <input id="kbmScanId" name="kbmScanId" class="easyui-numberbox" required="true" label="KARTU" labelPosition="left" style="width:80%;height:40px;padding:12px" tabindex="4">
                    </div>
                </form>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload'" onclick="kbmButtonReset();">RESET</a>
            </div>
        </div>
        <style scoped>
            .tt-inner{
                 display:inline-block;
                 line-height:12px;
                 padding-top:5px;
             }
             p{
                 line-height:150%;
             }
         </style>
        <ul id="dl" class="easyui-datalist" ></ul>
        
    </div>
    <div id="p2" class="easyui-navpanel" ></div>

<script type="text/javascript">
    $(function(){    
        $('#tt-main').tabs({
            border:false,
            onSelect:function(title,index){
                if(index==0){
                    buttonReset();
                }
                else if(index==1){
                    updateButtonReset();
                }
                else if(index==2){
                    $('#kbmScanId').next().find('input').focus();
                    $('#kbmScanId').textbox('setValue', '');
                }
            }
        });
        ///scan
        $('#scanId').textbox('disable');
        $('#scanId').textbox('setValue', '');
        $('#lineId').next().find('input').focus();
        $('#lineId').textbox('textbox').keypress(function(e){
            if (e.keyCode == 13){
                $('#machId').next().find('input').focus();
            }
        });
        $('#machId').textbox('textbox').keypress(function(e){
            if (e.keyCode == 13){
                var namaProses  = '<?php echo strtoupper($this->session->userdata('proc'));?>';
                var liid        = $('#lineId').textbox('getValue');
                var mcid        = $('#machId').textbox('getValue');
                $.post('<?php echo site_url('scan/machCheck'); ?>',{liid:liid,mcid:mcid},function(result){
                    if (result.success){
                        $('#scanId').textbox('enable');
                        $('#scanId').next().find('input').focus();
                        $('#lineId').textbox('disable');
                        $('#machId').textbox('disable');
                         mesin = result.machineId;
                    }
                    else{
                        var win = $.messager.alert('Error','Gagal !'+('<br/>')+namaProses+('<br/>')+'Line : '+liid+('<br/>')+'Mesin : '+mcid+('<br/>')+'Tidak Ada !','error', function(){
                            $('#scanId').textbox('disable');
                            $('#scanId').textbox('setValue', '');
                            $('#lineId').textbox('setValue', '');
                            $('#machId').textbox('setValue', '');
                            $('#lineId').next().find('input').focus();
                        });
                        win.window('window').addClass('bg-error');
                    }
                },'json');
            }
        });
        $('#scanId').textbox('textbox').keypress(function(e){
            if (e.keyCode == 13){
                var scid = $('#scanId').textbox('getValue');
                if(scid!=''){
                    $.post('<?php echo site_url('scan/create'); ?>',{scid:scid,mcid:mesin},function(result){
                        if (result.success){
                            if (result.warning){
                                 var warn = $.messager.alert('Informasi',result.info,'warning', function(){
                                    $('#scanId').next().find('input').focus();
                                    $.messager.show({
                                        title   : 'Info',
                                        msg     : '<div class="messager-icon messager-info"></div><div>Data Berhasil Diinput</div>'
                                    });
                                });
                                warn.window('window').addClass('bg-warning');
                            }
                            else{
                                $.messager.show({
                                    title   : 'Info',
                                    msg     : '<div class="messager-icon messager-info"></div><div>Data Berhasil Diinput</div>'
                                });
                            }                                    
                        }
                        else{
                            var win = $.messager.alert('Error','Gagal !'+('<br/>')+result.error,'error', function(){
                                $('#scanId').next().find('input').focus();
                            });
                            win.window('window').addClass('bg-error');
                        }
                        $('#scanId').textbox('setValue', '');
                    },'json');
                }
            }
        });
        /// update
        $('#upScanId').textbox('textbox').keypress(function(e){
            if (e.keyCode == 13){
                var upScanId        = $('#upScanId').textbox('getValue');
                $.post('<?php echo site_url('scan/cardCheck'); ?>',{upScanId:upScanId},function(result){
                    if (result.success){
                        $('#afterKg').textbox('enable');
                        $('#afterKg').next().find('input').focus();
                        $('#currentKg').textbox('setValue', result.current);
                        $('#grPcs').textbox('setValue', result.grpcs);
                        $('#idPros').textbox('setValue', result.prosid);
                        $('#upScanId').textbox('disable');
                    }
                    else{
                        //var win = $.messager.alert('Error','Gagal !'+('<br/>')+'Data Tidak Ditemukan'+('<br/>'),'error', function(){
                        var win = $.messager.alert('Error','Gagal !'+('<br/>')+result.error,'error', function(){
                            updateButtonReset();
                        });
                        win.window('window').addClass('bg-error');
                    }
                },'json');
            }
        });
        $('#afterKg').textbox('textbox').keypress(function(e){
            if (e.keyCode == 13){
                var idPros  = $('#idPros').textbox('getValue');
                var grPcs   = $('#grPcs').textbox('getValue');
                var afterKg = $('#afterKg').textbox('getValue');
                if(afterKg!=''){
                    $.post('<?php echo site_url('scan/update'); ?>',{idPros:idPros,grPcs:grPcs,afterKg:afterKg},function(result){
                        if (result.success){
                            $.messager.show({
                                title   : 'Info',
                                msg     : '<div class="messager-icon messager-info"></div><div>Data Berhasil Diubah</div>'
                            });
                            updateButtonReset();
                        }
                        else{
                            var win = $.messager.alert('Error','Gagal !'+('<br/>')+result.error,'error', function(){
                                $('#scanId').next().find('input').focus();
                            });
                            win.window('window').addClass('bg-error');
                        }
                   /*     $('#scanId').textbox('setValue', '');
                        $('#afterKg').textbox('setValue', '');
                        $('#currentKg').textbox('setValue', '');
                        $('#grPcs').textbox('setValue', '');
                        $('#idPros').textbox('setValue', '');
                        $('#afterKg').textbox('disable');
                        $('#upScanId').textbox('enable');
                        $('#scanId').next().find('input').focus(); */
                    },'json');
                }
            }
        });
        
        //kbm
        $('#kbmScanId').textbox('textbox').keypress(function(e){
            if (e.keyCode == 13){
               var kbmScanId        = $('#kbmScanId').textbox('getValue');
               if(kbmScanId!=''){
                    $.post('<?php echo site_url('scan/kbm'); ?>',{kbmScanId:kbmScanId},function(result){
                        if (result.success){
                            $.messager.show({
                                title   : 'Info',
                                msg     : '<div class="messager-icon messager-info"></div><div>Data Berhasil Diubah</div>'
                            });
                            $('#kbmScanId').next().find('input').focus();
                            $('#kbmScanId').textbox('setValue', '');
                        }
                        else{
                            var win = $.messager.alert('Error','Gagal !'+('<br/>')+result.error,'error', function(){
                                $('#kbmScanId').next().find('input').focus();
                                $('#kbmScanId').textbox('setValue', '');
                            });
                            win.window('window').addClass('bg-error');
                        }
                    },'json');
                }
            }
        });
    });
    
    function buttonReset(){
        $('#lineId').textbox('enable');
        $('#lineId').textbox('setValue', '');
        $('#lineId').next().find('input').focus();
        $('#machId').textbox('enable');
        $('#machId').textbox('setValue', '');
        $('#scanId').textbox('disable');
        $('#scanId').textbox('setValue', '');
    };
    function updateButtonReset(){
        $('#upScanId').textbox('enable');
        $('#upScanId').textbox('setValue', '');
        $('#upScanId').next().find('input').focus();
        $('#idPros').textbox('setValue', '');
        $('#currentKg').textbox('setValue', '');
        $('#grPcs').textbox('setValue', '');
        $('#afterKg').textbox('setValue', '');
        $('#afterKg').textbox('disable');
    };
    function kbmButtonReset(){
        $('#kbmScanId').next().find('input').focus();
        $('#kbmScanId').textbox('setValue', '');
    };
</script>
</body>
</html>

<!-- End of file v_main.php -->
<!-- Location: ./application/views/v_main.php -->