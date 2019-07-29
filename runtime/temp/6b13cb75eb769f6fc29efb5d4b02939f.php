<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:96:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\public/../application/admin\view\user\detail\index.html";i:1564323358;s:83:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\layout\default.html";i:1547349022;s:80:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\meta.html";i:1547349022;s:90:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\user\detail\base_info.html";i:1564224053;s:92:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\user\detail\extend_info.html";i:1564340890;s:82:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\script.html";i:1547349022;}*/ ?>
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
                                
<style type="text/css">
    @media (max-width: 375px) {
        .edit-form tr td input {
            width: 100%;
        }

        .edit-form tr th:first-child, .edit-form tr td:first-child {
            width: 20%;
        }

        .edit-form tr th:nth-last-of-type(-n+2), .edit-form tr td:nth-last-of-type(-n+2) {
            display: none;
        }
    }

</style>
<div class="panel panel-default panel-intro">
    <div class="panel-heading">
        <?php echo build_heading(null, false); ?>
        <ul class="nav nav-tabs">
            <?php foreach($userInfo as $index=>$vo): ?>
            <li class="<?php echo !empty($vo['active'])?'active':''; ?>"><a href="#<?php echo $vo['field']; ?>" data-toggle="tab"><?php echo __($vo['tabtitle']); ?></a></li>
            <?php endforeach; ?>
            <li>
        </ul>
    </div>

    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="<?php echo $userInfo[0]['field']; ?>">
                <style>
    .table-marggin {
        margin-top: 15px;
        padding: 5px;;
    }

    .td-title {
        width: 20%
    }

    .bs-callout + .bs-callout {
        margin-top: -5px;
    }

    .bs-callout-danger {
        border-left-color: #ce4844;
    }
    .font-16{ font-size: 16px}
    .bs-callout {
        padding: 20px;
        margin: 20px 0;
        border: 1px solid #eee;
        border-left-width: 5px;
        border-radius: 3px;
    }
    .margin-lr8{
        margin: 0 8px;
    }
</style>
<div class="panel panel-default panel-intro">
    <div class="bs-callout ">
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('NameCardnum'); ?>:</label>
            <div class="col-xs-12 col-sm-8"><span class="font-16 color-danger"><strong><?php echo $baseInfo['cardnum']; ?> / <?php echo $baseInfo['name']; ?> </strong></span></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('mobile'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><strong><?php echo $baseInfo['mobile']; ?> </strong></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Group.name'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo $baseInfo['group']['name']; ?> </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sex'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo !empty($baseInfo['sex'])?'男':'女'; ?> </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Birthday'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo $baseInfo['birthday']; ?> </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('MoneyScore'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><span class="color-primary"><strong><?php echo $baseInfo['money']; ?>元 / <?php echo $baseInfo['score']; ?>分 </strong></span></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Storename'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo $baseInfo['store']['storename']; ?> </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Jointime'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo date("Y-m-d H:m:s",$baseInfo['jointime']); ?> </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Address'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo $baseInfo['address']; ?> </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php if($baseInfo['status'] == '1'): ?><span class="label label-info">正常</span><?php else: ?><span class="label label-default">封禁</span><?php endif; ?></div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Remarks'); ?>：</label>
            <div class="col-xs-12 col-sm-8"><?php echo $baseInfo['remarks']; ?> </div>
        </div>
    </div>


    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <a href="javascript:;" id="refresh" class="btn btn-primary  btn-embossed btn-refresh"><i class="fa fa-refresh"> 刷新</i></a>
            <a href="user/user/edit/ids/<?php echo $baseInfo['id']; ?>" id="edit" class="btn btn-success btn-embossed btn-dialog"><?php echo __('Edit'); ?></a>
            <span class="color-danger margin-lr8"> * 编辑后需要刷新该页面，才显示最新数据</span>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src=https://cdn.staticfile.org/jquery/2.1.4/jquery.min.js></script>
<script>
    $(function () {
        $("#refresh").on("click", function () {
            window.location.reload();
        });

    });
</script>


            </div>
            <div class="tab-pane fade" id="<?php echo $userInfo[1]['field']; ?>">
                <style>
    .table-marggin {
        margin-top: 15px;
        padding: 5px;;
    }

    .td-title {
        width: 20%
    }

    .bs-callout + .bs-callout {
        margin-top: -5px;
    }

    .bs-callout-danger {
        border-left-color: #ce4844;
    }
    .font-16{
        font-size: 16px
    }
    .margin-lr8{
        margin: 0 8px;
    }
    .bs-callout {
        padding: 20px;
        margin: 20px 0;
        border: 1px solid #eee;
        border-left-width: 5px;
        border-radius: 3px;
    }
.form-group{ line-height: 28px}
</style>
<div class="panel panel-default panel-intro">
    <div class="bs-callout ">
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Health'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <span id="a-health"><?php echo $extendInfo['health']; ?></span>
                <span class="color-gray margin-lr8"  id="n-health">
                    <?php if(!empty($extendInfo['health_lastendtime'])): ?>
                    <?php echo $extendInfo['health_lastendauthor']; ?> / <?php echo date("Y-m-d H:m:s",$extendInfo['health_lastendtime']); endif; ?>
                </span>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Family'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <span id="a-family"><?php echo $extendInfo['family']; ?></span>
                <span class="color-gray margin-lr8" class="n-family">
                    <?php if(!empty($extendInfo['family'])): ?>
                    <?php echo $extendInfo['family_lastendauthor']; ?> / <?php echo date("Y-m-d H:m:s",$extendInfo['family_lastendtime']); endif; ?>
                </span>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Income'); ?>：</label>
            <div class="col-xs-12 col-sm-8">
                <span id="a-income"><?php echo $extendInfo['income']; ?></span>
                <span class="color-gray margin-lr8" id="n-income">
                    <?php if(!empty($extendInfo['income'])): ?>
                    <?php echo $extendInfo['income_lastendauthor']; ?> / <?php echo date("Y-m-d H:m:s",$extendInfo['income_lastendtime']); endif; ?>
                    </span>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Ability'); ?>：</label>
            <div class="col-xs-12 col-sm-8">
                <span id="a-ability"><?php echo $extendInfo['ability']; ?></span>
                <span class="color-gray margin-lr8"  id="n-ability">
                    <?php if(!empty($extendInfo['ability'])): ?>
                    <?php echo $extendInfo['ability_lastendauthor']; ?> / <?php echo date("Y-m-d H:m:s",$extendInfo['ability_lastendtime']); endif; ?>
                </span>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Likes'); ?>：</label>
            <div class="col-xs-12 col-sm-8">
                <span id="a-likes"><?php echo $extendInfo['likes']; ?></span>
                <span class="color-gray margin-lr8" id="n-likes">
                    <?php if(!empty($extendInfo['likes'])): ?>
                    <?php echo $extendInfo['likes_lastendauthor']; ?> / <?php echo date("Y-m-d H:m:s",$extendInfo['likes_lastendtime']); endif; ?>
                </span>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Character'); ?>：</label>
            <div class="col-xs-12 col-sm-8">
                <span id="a-character"><?php echo $extendInfo['character']; ?></span>
                <span class="color-gray margin-lr8" id="n-character">
                    <?php if(!empty($extendInfo['character'])): ?>
                    <?php echo $extendInfo['character_lastendauthor']; ?> / <?php echo date("Y-m-d H:m:s",$extendInfo['character_lastendtime']); endif; ?>
                </span>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Needs'); ?>：</label>
            <div class="col-xs-12 col-sm-8">
                <span id="a-needs"><?php echo $extendInfo['needs']; ?></span>
                <span class="color-gray margin-lr8" id="n-needs">
                <?php if(!empty($extendInfo['needs'])): ?>
                <?php echo $extendInfo['needs_lastendauthor']; ?> / <?php echo date("Y-m-d H:m:s",$extendInfo['needs_lastendtime']); endif; ?>
                </span>
            </div>
        </div>
    </div>


    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <a href="user/user_extend/edit/user_id/<?php echo $baseInfo['id']; ?>" id="edit" class="btn btn-success btn-embossed btn-dialog"><?php echo __('Edit'); ?></a>
        </div>
    </div>
</div>



            </div>
            <div class="tab-pane fade" id="<?php echo $userInfo[2]['field']; ?>">
                授权信息
            </div>
            <div class="tab-pane fade" id="<?php echo $userInfo[3]['field']; ?>">
                <div id="toolbar1" class="toolbar">
                    <?php echo build_toolbar('refresh,add,edit,delete'); ?>
                </div>
                <table id="table1" class="table table-striped table-bordered table-hover" width="100%">
                </table>
            </div>
            <div class="tab-pane fade" id="<?php echo $userInfo[4]['field']; ?>">
                <div id="toolbar2" class="toolbar">
                    <?php echo build_toolbar('refresh,add,edit,delete'); ?>
                </div>
                <table id="table2" class="table table-striped table-bordered table-hover" width="100%">
                </table>
            </div>
            <div class="tab-pane fade" id="<?php echo $userInfo[5]['field']; ?>">
                <div id="toolbar3" class="toolbar">
                    <?php echo build_toolbar('refresh,add,edit,delete'); ?>
                </div>
                <table id="table3" class="table table-striped table-bordered table-hover" width="100%">
                </table>
            </div>
            <div class="tab-pane fade" id="<?php echo $userInfo[6]['field']; ?>">
                <div  class="toolbar">
                    <?php echo build_toolbar('refresh,add,delete'); ?>
                </div>
                <table  class="table table-striped table-bordered table-hover" width="100%">
                </table>
            </div>
        </div>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>