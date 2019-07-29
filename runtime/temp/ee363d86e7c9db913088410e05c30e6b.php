<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:103:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\public/../application/admin\view\service\service_log\edit.html";i:1564206075;s:83:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\layout\default.html";i:1547349022;s:80:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\meta.html";i:1547349022;s:82:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\script.html";i:1547349022;}*/ ?>
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
                                
<form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('User.name.cardnum'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="form-control" disabled><strong><?php echo $row['user']['name']; ?> / <?php echo $row['user']['cardnum']; ?></strong></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Serviceitems'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="form-control" disabled><?php echo $row['service_items']['servicename']; ?></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Adminname'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="form-control" disabled><?php echo $artificer['name']; ?></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Createtime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="form-control" disabled><?php echo date('Y-m-d H:i:s',$row['createtime']); ?></div>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-content" data-rule="required"  placeholder="请认真填写客勤，帮助我们了解客户，300字内"  class="form-control" name="row[content]" type="text" rows="5"><?php echo $artificer['customer_log']['content']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Remarks'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-remarks" placeholder="如：下次对该客户如何销售项目"  class="form-control" name="row[remarks]" type="text" rows="3"><?php echo $artificer['customer_log']['remarks']; ?></textarea>
            <input type="hidden" name="id" value="<?php echo $artificer['customer_log']['id']; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Serviceedit'); ?>：</label>
        <div class="col-xs-12 col-sm-8 margin-top8 color-gray">
            <span><?php echo $artificer['customer_log']['lasteditadmin']; ?> <?php echo !empty($artificer['customer_log']['lasteditetime'])?'/'.date('Y-m-d H:m:s',$artificer['customer_log']['lasteditetime']):''; ?></span>
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