<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:99:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\public/../application/admin\view\service\items\detail.html";i:1564341037;s:83:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\layout\default.html";i:1547349022;s:80:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\meta.html";i:1547349022;s:82:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\script.html";i:1547349022;}*/ ?>
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
                                <style>
    .table-marggin {
        margin-top: 15px;
        padding: 5px;;
    }

    .td-title {
        width: 20%
    }

    .color-primary {
        color: #337ab7;
    }

    .color-success {
        color: #5cb85c;
    }

    .color-info {
        color: #5bc0de;
    }

    .color-warning {
        color: #5bc0de;
    }

    .color-warning {
        color: #f0ad4e;
    }

    .color-danger {
        color: #d9534f;
    }

    .color-gray {
        color: #666;
    }

    .bs-callout + .bs-callout {
        margin-top: -5px;
    }

    .bs-callout-danger {
        border-left-color: #ce4844;
    }

    .bs-callout {
        padding: 20px;
        margin: 20px 0;
        border: 1px solid #eee;
        border-left-width: 5px;
        border-radius: 3px;
    }
</style>
<div class="panel panel-default panel-intro">
    <div class="panel-heading">
        <p>客户项目详情</p>
    </div>
    <div class="bs-callout ">
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Cardnum'); ?>:</label>
            <div class="col-xs-12 col-sm-8"><span class="color-danger"><strong><?php echo $row['user']['cardnum']; ?></strong></span></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('User.name'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><strong><?php echo $row['user']['name']; ?></strong><span class="color-gray"> (<?php echo $row['user']['mobile']; ?> ) </span></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Servicename'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><strong><?php echo $row['servicename']; ?></strong></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Identifier'); ?>:</label>
            <div class="col-xs-12 col-sm-8"><strong><?php echo $row['identifier']; ?></strong></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Adminname'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo $row['adminname']; ?></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php if($row['status'] == 'ongoing'): ?><span class="label label-info">进行中..</span><?php else: ?><span class="label label-default">已结束</span><?php endif; ?></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Totalnumber'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><strong ><?php echo $row['totalnumber']; ?> /次</strong></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Specificnumbe'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><strong ><?php echo $row['specificnumbe']; ?> /次</strong></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Createtime'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo date("Y-m-d H:m:s",$row['createtime']); ?></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Lastservicetime'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo date("Y-m-d H:m:s",$row['lastservicetime']); ?></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Store.storename'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><strong><?php echo $row['store']['storename']; ?></strong></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Remarks'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo $row['remarks']; ?></div>
        </div>

    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <!--<button type="button" id="edit" class="btn btn-success btn-embossed"><?php echo __('Edit'); ?></button>-->
            <button type="button" id="close" class="btn btn-default btn-embossed"><?php echo __('Close'); ?></button>

        </div>
    </div>
</div>
<!-- jQuery -->
<script src=https://cdn.staticfile.org/jquery/2.1.4/jquery.min.js></script>
<script>

    $(function () {
        $("#close").on("click", function () {
            var mylay = parent.layer.getFrameIndex(window.name);
            parent.layer.close(mylay); //关闭弹窗
        });
    });
</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>