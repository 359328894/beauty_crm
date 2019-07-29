<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:94:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\public/../application/admin\view\other\character.html";i:1564235772;s:83:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\layout\default.html";i:1547349022;s:80:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\meta.html";i:1547349022;s:82:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\script.html";i:1547349022;}*/ ?>
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
</style>
<div class="panel panel-default panel-intro">
    <div class="panel-heading">
        <p>人的性格</p>
    </div>
    <div style="margin-top: 40px">
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">1．开放性：</label>
            <div class="col-xs-12 col-sm-8">描述是否愿意与人交往，注重和谐发展；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">2．完美性：</label>
            <div class="col-xs-12 col-sm-8">描述追求完美，重视目标计划的程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">3．较真性：</label>
            <div class="col-xs-12 col-sm-8">描述对事物的钻研和完善程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">4．认知性：</label>
            <div class="col-xs-12 col-sm-8">描述是否重视积累知识，包括聪明程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">5．成就性：</label>
            <div class="col-xs-12 col-sm-8">描述是否注重成就的程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">6．力量性：</label>
            <div class="col-xs-12 col-sm-8">描述是否愿意支配和影响他人；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">7．浪漫性：</label>
            <div class="col-xs-12 col-sm-8">描述在浪漫程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">8．给予性：</label>
            <div class="col-xs-12 col-sm-8">描述是否愿意给予他人，包含仁爱，慈孝，正义等；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">9．活跃性：</label>
            <div class="col-xs-12 col-sm-8">描述情绪的兴奋和活跃程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">10．形体性：</label>
            <div class="col-xs-12 col-sm-8">描述形体特征的状况以及重视享受的程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">11．疑惑性：</label>
            <div class="col-xs-12 col-sm-8">描述是否倾向于探究他人的动机；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">12．随和性：</label>
            <div class="col-xs-12 col-sm-8">描述和平、随和与安静的程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">13．传统性：</label>
            <div class="col-xs-12 col-sm-8">14．自由性：描述重视自由的程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">14．自由性：</label>
            <div class="col-xs-12 col-sm-8">描述重视自由的程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">15．智慧性：</label>
            <div class="col-xs-12 col-sm-8">描述创造能力，智慧程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">16．想象性：</label>
            <div class="col-xs-12 col-sm-8">描述重视想象，追求至善的程度。</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">17．多面性：</label>
            <div class="col-xs-12 col-sm-8">描述性格复杂程度；</div>
        </div>
        <div class="form-group row">
            <label class="control-label col-xs-12 col-sm-1">18．多变性：</label>
            <div class="col-xs-12 col-sm-8">描述机敏的程度；</div>
        </div>
    </div>
</div>
 <hr>
<div class="form-group row">
    <label class="control-label col-xs-12 col-sm-1">说明*：</label>
    <div class="col-xs-12 col-sm-8 color-danger">一个人可以拥有多种性格！</div>
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