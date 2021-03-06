<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:93:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\public/../application/admin\view\user\user\edit.html";i:1564241748;s:83:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\layout\default.html";i:1547349022;s:80:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\meta.html";i:1547349022;s:82:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\script.html";i:1547349022;}*/ ?>
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

        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Store.storename'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo build_select('row[store_id]', $storeslist, $row['store_id'], ['class'=>'form-control selectpicker','data-rule'=>'required']); ?>
        </div>
    </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Group.name'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <?php echo build_select('row[group_id]', $grouplist, $row['group_id'], ['class'=>'form-control selectpicker','data-rule'=>'required']); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Cardnum'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <input id="c-cardnum" class="form-control" name="row[cardnum]" type="text" value="<?php echo $row['cardnum']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <input id="c-sex" data-rule="required" class="form-control" type="text"  name="row[name]"  value="<?php echo $row['name']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sex'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <?php echo build_radios('row[sex]', ['0'=>__('Sex 0'),'1'=>__('Sex 1')], $row['sex']); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Mobile'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <input id="c-mobile" data-rule="required" class="form-control" name="row[mobile]" type="text" value="<?php echo $row['mobile']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Birthday'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <input id="c-birthday" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" name="row[birthday]" type="text" value="<?php echo $row['birthday']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Money'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <input id="c-money" data-rule="required" class="form-control" step="0.01" name="row[money]"
                       type="number" value="<?php echo $row['money']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Score'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <input id="c-score" data-rule="required" class="form-control" name="row[score]" type="number"
                       value="<?php echo $row['score']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Jointime'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <input id="c-jointime" data-rule="required" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[jointime]" type="text" value="<?php echo date('Y-m-d H:i:s',$row['jointime']); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Address'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <input id="c-address" class="form-control" name="row[address]" type="text" value="<?php echo $row['address']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Remarks'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <textarea id="c-remarks" class="form-control" name="row[remarks]" type="text" rows="5"><?php echo $row['remarks']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <?php echo build_radios('row[status]', ['1'=>__('Status 1'), '0'=>__('Status 0')], $row['status']); ?>
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