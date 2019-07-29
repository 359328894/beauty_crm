<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:102:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\public/../application/admin\view\user\detail\extend_edit.html";i:1564247467;s:83:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\layout\default.html";i:1547349022;s:80:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\meta.html";i:1547349022;s:82:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\script.html";i:1547349022;}*/ ?>
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
.form-group{ line-height: 28px}
</style>
<form id="edit_extend-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">
<div class="panel panel-default panel-intro">
    <input name="row[item]" value="<?php echo $item; ?>" type="hidden">
    <input name="row[ids]" value="<?php echo $row['id']; ?>" type="hidden">
    <div class="panel-heading">
        <p>客户拓展资料</p>
    </div>
    <div style="margin-top: 40px">
        <div class="form-group row">
            <?php switch($item): case "1": ?>
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Health'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <textarea id="c-health" class="c-content form-control" name="row[health]" type="text" rows="8"><?php echo $row['health']; ?></textarea>
            </div>
            <?php break; case "2": ?>
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Family'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <textarea id="c-family" class="c-content form-control" name="row[family]" type="text" rows="8"><?php echo $row['family']; ?></textarea>
            </div>
            <?php break; case "3": ?>
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Income'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <textarea id="income" class="c-content form-control" name="row[income]" type="text" rows="8"><?php echo $row['income']; ?></textarea>
            </div>
            <?php break; case "4": ?>
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Ability'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <textarea id="c-ability" class="c-content form-control" name="row[ability]" type="text" rows="8"><?php echo $row['ability']; ?></textarea>
            </div>
            <?php break; case "5": ?>
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Likes'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <textarea id="c-likes" class="c-content form-control" name="row[likes]" type="text" rows="8"><?php echo $row['likes']; ?></textarea>
            </div>
            <?php break; case "6": ?>
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Character'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <textarea id="c-character" class="c-content form-control" name="row[character]" type="text" rows="8"><?php echo $row['character']; ?></textarea>

                <a href="/admin/Other/character"  target="_blank" style="margin-top: 10px; display: block;">查看18种性格类型</a>
            </div>
            <?php break; case "7": ?>
            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Needs'); ?>:</label>
            <div class="col-xs-12 col-sm-8">
                <textarea id="c-needs" class="c-content form-control" name="row[family]" type="text" rows="8"><?php echo $row['needs']; ?></textarea>
            </div>
            <?php break; default: ?>

            <label class="control-label col-xs-12 col-sm-2"></label>
            <div class="col-xs-12 col-sm-8">
                ERROR
            </div>
            <?php endswitch; ?>

        </div>
        <div class="form-group row">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
        <div class="color-danger" style="margin-top: 10px"><?php echo __('Notice'); ?>:</div>
        </div>
        </div>
    </div>
</div>
<hr>
<div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
<!--            <a href="user/detail/extendEdit/ids/<?php echo $row['id']; ?>/item/<?php echo $item; ?>"class="btn  btn-success  btn-dialog"><?php echo __('OK'); ?></a>-->
            <button type="button" id="extendEdit" class="btn btn-success btn-embossed "><?php echo __('OK'); ?></button>
            <button type="button" id="close" class="btn btn-default btn-embossed"><?php echo __('Close'); ?></button>
        </div>
    </div>
</form>
<!-- jQuery -->
<script src=https://cdn.staticfile.org/jquery/2.1.4/jquery.min.js></script>

<!-- Bootstrap Core JavaScript -->
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdn.staticfile.org/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<script>
    $(function () {
        $("#close").on("click", function () {
            var mylay = parent.layer.getFrameIndex(window.name);
            parent.Toastr.success('22222222222');
            parent.$("#test").html('测试');

            parent.layer.close(mylay); //关闭弹窗
        });
        $("#extendEdit").on("click", function () {

          if($('.c-content').val()==''||$('.c-content').val()==null){
              Layer.msg("必要数据未填写！");
              return false;
          }else{
              //var index = layer.load(0, {shade: false});
              $.ajax({
                  type: "POST",
                  url: 'user/detail/extendEdit',
                  data: {
                      "content": $('.c-content').val(),
                      "item": <?php echo $item; ?>,
                      "ids": <?php echo $row["id"]; ?>,
                  },
                  dataType: "json",
                  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                  success: function (data) {
                      if(data.code){
                          var mylay = parent.layer.getFrameIndex(window.name);
                          parent.layer.close(mylay); //关闭弹窗

                          parent.Toastr.success(data.msg);

                          var a_param='#a-'+data.data.param;
                          var n_param='#n-'+data.data.param;
                          parent.$(a_param).html(data.data.content);
                          parent.$(n_param).html(data.data.sign);
                      }else{
                          Layer.msg(data.msg);
                      }

                  }
              });
          }
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