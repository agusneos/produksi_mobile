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
                    <a href="javascript:void(0)" class="easyui-menubutton" data-options="iconCls:'icon-user',plain:true,hasDownArrow:false,menu:'#mm',menuAlign:'right'">
                        <?php echo $this->session->userdata('name');?>
                    </a>
                </div>
            </div>
        </header>
        <div id="mm" class="easyui-menu" style="width:150px;" data-options="itemHeight:30,noline:true">
            <div href="<?php echo site_url('main/logout'); ?>" data-options="iconCls:'icon-logout'">Logout</div>
        </div>
        
        <div class="easyui-tabs" data-options="tabHeight:60,fit:true,tabPosition:'bottom',border:false,pill:true,narrow:true,justified:true">
            <div style="padding:10px">
                <div class="panel-header tt-inner">
                    <img src='<?=base_url('assets/easyui/themes/icons/large_picture.png')?>'/><br>SCAN
                </div>
                    <h1 align="center"><a href="javascript:void(0)" class="easyui-linkbutton" id="clock" data-options="plain:true,iconCls:'icon-time'"></a></h1>
                    <h1 align="center">PROSES <?php echo strtoupper($this->session->userdata('proc'));?></h1>  

                    <form id="form-scan" method="post" novalidate onsubmit="return false">
                        <div style="font-size:20px;margin-bottom:20px">
                            <input id="lineId" name="lineId" class="easyui-numberbox" label="LINE" labelPosition="left" style="width:80%;height:40px;padding:12px" tabindex="1">
                        </div>
                        <div style="font-size:20px;margin-bottom:20px">
                            <input id="machId" name="machId" class="easyui-numberbox" label="MESIN" labelPosition="left" style="width:80%;height:40px;padding:12px" tabindex="2">
                        </div>
                        <div style="font-size:20px;margin-bottom:20px">
                            <input id="scanId" name="scanId" class="easyui-numberbox" label="KARTU" labelPosition="left" style="width:80%;height:40px;padding:12px" tabindex="3">
                        </div>                         
                    </form>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload'" onclick="buttonReset();">RESET</a>

                
            </div>
            <div style="padding:10px">
                <div class="panel-header tt-inner">
                    <img src='<?=base_url('assets/easyui/themes/icons/large_picture.png')?>'/><br>UPDATE
                </div>
                <p>In computing, an image scanner—often abbreviated to just scanner—is a device that optically scans images, printed text, handwriting, or an object, and converts it to a digital image.</p>
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
    $('#dl').datalist({
        onClickRow      : function(index,row){
            $('#p2').navpanel({
                href:row.uri
            });
        },
        textFormatter: function(value){
            return '<a href=\'javascript:void(0)\'  onclick=\'$.mobile.go("#p2")\' class=\'datalist-link\'>' + value + '</a>';
        },
        url     : '<?php echo site_url('menu/index'); ?>',
        method  : 'get',
        fit     : true,
        lines   : true,
        border  : false
    });
    $(function(){    
        $('#scanId').textbox('disable');
        $('#scanId').textbox('setValue', '');
        $('#lineId').next().find('input').focus();
     /*   $('#shifId').textbox('textbox').keypress(function(e){
            if (e.keyCode == 13){
                $('#lineId').next().find('input').focus();
            }
        });
        */
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
                //alert('horay');
                
                var scid = $('#scanId').textbox('getValue');
                //var shid = $('#shifId').textbox('getValue');
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
    }
</script>
</body>
</html>

<!-- End of file v_main.php -->
<!-- Location: ./application/views/v_main.php -->