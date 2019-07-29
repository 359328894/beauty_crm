<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:96:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\public/../application/admin\view\service\items\add.html";i:1564340651;s:83:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\layout\default.html";i:1547349022;s:80:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\meta.html";i:1547349022;s:82:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\script.html";i:1547349022;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action=""
      xmlns="http://www.w3.org/1999/html">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('NameCardnum'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="form-control color-danger" disabled><strong><?php echo $row['cardnum']; ?> / <?php echo $row['name']; ?></strong></div>
            <input  type="hidden" name="row[user_id]"  value=<?php echo $row['id']; ?>>
            <input  type="hidden" name="row[store_id]" value=<?php echo $row['store']['id']; ?>>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Store.storename'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="form-control" disabled><strong><?php echo $row['store']['storename']; ?></strong></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Servicename'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-servicename" data-rule="required" class="form-control" name="row[servicename]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Identifier'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-identifier"   class="form-control" name="row[identifier]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Totalnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-totalnumber" data-rule="required" class="form-control" name="row[totalnumber]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Specificnumbe'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-specificnumbe" class="form-control" name="row[specificnumbe]" type="number" >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
            <label for="row[status]-<?php echo $key; ?>"><input id="row[status]-<?php echo $key; ?>" name="row[status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"ongoing"))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Adminname'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select data-placeholder="请选择技师" data-rule="required"  multiple class="form-control selectpicker" name="row[admin_ids][]" type="text" >
                <?php if(is_array($admins) || $admins instanceof \think\Collection || $admins instanceof \think\Paginator): $k = 0; $__LIST__ = $admins;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad): $mod = ($k % 2 );++$k;?>
                <option value="<?php echo $ad['id']; ?>" ><?php echo $ad['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Remarks'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-remarks" class="form-control" name="row[remarks]" type="text" rows="5"></textarea>
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>