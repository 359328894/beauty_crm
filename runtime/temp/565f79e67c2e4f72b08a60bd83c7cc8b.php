<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:103:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\public/../application/admin\view\user\user_relation\index.html";i:1563939915;s:83:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\layout\default.html";i:1547349022;s:80:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\meta.html";i:1547349022;s:82:"C:\phpStudy\PHPTutorial\WWW\fastadmin.im\application\admin\view\common\script.html";i:1547349022;}*/ ?>
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
                                
<!-- jQuery -->
<script src=https://cdn.staticfile.org/jquery/2.1.4/jquery.min.js></script>

<!-- Bootstrap Core JavaScript -->
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdn.staticfile.org/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<div class="panel panel-default panel-intro">

    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <label> 选择客户/员工->填写姓名、手机号、会员卡号</label>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <!--显式的operate操作符-->
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <select class="form-control operate" data-name="classify" name="classify"
                                                id="classify" style="width:80px;">
                                            <option value="0" selected>选择</option>
                                            <option value="1">客户</option>
                                            <option value="2">员工</option>
                                        </select>
                                    </div>
                                    <input class="form-control" placeholder="姓名/手机号/会员卡号" type="text" name="userinfo"
                                           id="userinfo" data-rule="required"/>
                                    <input  type="hidden" name="classify" id="classify" value="" />
                                    <input  type="hidden" name="id" id="id" value=""/>
                                    <input  type="hidden" name="userThird" id="thirdid" value="<?php echo $userThird['id']; ?>"/>

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <input type="submit" id="search" class="btn btn-success btn-block" value="搜索"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($userThird['status'] == '0'): ?>
                <!--未关联数据-->
                <div class="row">
                    <div style="margin-top: 20px; height: 20px;"></div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <table class="table table-nowrap" width="30%">
                            <thead>
                            <tr>
                                <th style="vertical-align: middle;">
                                    <div class="th-inner ">微信Id</div>

                                </th>
                                <th style=" vertical-align: middle; font-size: 12px">
                                    <div class="th-inner ">微信头像</div>

                                </th>
                                <th style=" vertical-align: middle; font-size: 12px">
                                    <div class="th-inner ">微信昵称</div>
                                </th>
                            </tr>
                            </thead>
                            <tr>
                                <td style="vertical-align: middle; "><?php echo $userThird['id']; ?></td>
                                <td style="vertical-align: middle;"><img width="50" height="50px"
                                                                         style="border-radius:100%"
                                                                         src="<?php echo $userThird['avatar']; ?>"></td>
                                <td style="vertical-align: middle; "><?php echo $userThird['nickname']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 hide" id="associationBox">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <input id="association" style="margin-top: 20px" type="submit" class="btn btn-danger btn-block" value="关联数据"/>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row hide" id="searchResult" style="background: #e6f7f5">
                    <div class="col-xs-12 col-sm-12 col-md-5">
                        <table class="table table-nowrap" >
                            <thead>
                            <tr>
                                <th style="vertical-align: middle;">
                                    <div class="th-inner ">姓名</div>
                                </th>
                                <th style="vertical-align: middle;">
                                    <div class="th-inner ">卡号</div>
                                </th>
                                <th style="vertical-align: middle;">
                                    <div class="th-inner ">级别</div>
                                </th>
                                <th style=" vertical-align: middle; font-size: 12px">
                                    <div class="th-inner ">性别</div>
                                </th>
                                <th style=" vertical-align: middle; font-size: 12px">
                                    <div class="th-inner ">电话</div>
                                </th>
                                <th style=" vertical-align: middle; font-size: 12px">
                                    <div class="th-inner ">所属店铺</div>
                                </th>
                            </tr>
                            </thead>
                            <tr>
                                <td style="vertical-align: middle;"><span id="name"></span></td>
                                <td style="vertical-align: middle;"><span id="cardnum"></span></td>
                                <td style="vertical-align: middle;"><span id="level"></span></td>
                                <td style="vertical-align: middle;"><span id="sex"></span></td>
                                <td style="vertical-align: middle;"><span id="mobile"></span></td>
                                <td style="vertical-align: middle;"><span id="store"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
                    $(function () {

                        $("#search").on("click", function () {
                            if ($("#userinfo").val() == '' || $("#userinfo").val() == 0) {
                                Layer.msg("请填写查询数据！");
                                return false;
                            }
                            if ($("#classify").val() == '' || $("#classify").val() == 0) {
                                Layer.msg("请选择查询类别！");
                                return false;
                            }
                            $("#associationBox").addClass("hide");
                            $("#searchResult").addClass("hide");
                            $.ajax({
                                type: "POST",
                                url: 'user.user_relation/search',
                                data: {
                                    "classify": $("#classify").val(),
                                    "userinfo": $("#userinfo").val(),
                                },
                                dataType: "json",
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                success: function (data) {
                                    if(data.code){
                                        Layer.msg(data.msg);
                                        $("#classify").val(data.data.classify);
                                        $("#id").val(data.data.id);
                                        $("#name").html(data.data.name);
                                        $("#level").html(data.data.level);
                                        $("#cardnum").html(data.data.cardnum);
                                        $("#mobile").html(data.data.mobile);
                                        $("#sex").html(data.data.sex?'男':'女');
                                        $("#store").html(data.data.store);
                                        $("#associationBox").removeClass("hide");
                                        $("#searchResult").removeClass("hide");
                                    }else{
                                        Layer.msg(data.msg);
                                    }

                                }
                            });

                        });
                        $("#association").on("click", function () {
                            var id=$("#id").val();
                            var classify=$("#classify").val();
                            var thirdid=$("#thirdid").val();
                            $.ajax({
                                url: 'user.user_relation/association/id/'+id+'/classify/'+classify+'/thirdid/'+thirdid,
                                dataType: "json",
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                success: function (data) {
                                    if(data.code){
                                        Layer.alert(data.msg);
                                        setTimeout(function () { parent.location.reload(); }, 2000);

                                    }else{
                                        Layer.alert(data.msg);
                                    }
                                }
                            });

                        });

                    });
                </script>
                <?php else: ?>
                <!--已关联数据-->
                <div class="row">
                    <div style="margin-top: 20px; height: 20px;"></div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <table class="table table-nowrap" width="30%">
                            <thead>
                            <tr>
                                <th style="vertical-align: middle;">
                                    <div class="th-inner ">微信Id</div>

                                </th>
                                <th style=" vertical-align: middle; font-size: 12px">
                                    <div class="th-inner ">微信头像</div>

                                </th>
                                <th style=" vertical-align: middle; font-size: 12px">
                                    <div class="th-inner ">微信昵称</div>
                                </th>
                            </tr>
                            </thead>
                            <tr>
                                <td style="vertical-align: middle; "><?php echo $userThird['id']; ?></td>
                                <td style="vertical-align: middle;"><img width="50" height="50px"
                                                                         style="border-radius:100%"
                                                                         src="<?php echo $userThird['avatar']; ?>"></td>
                                <td style="vertical-align: middle; "><?php echo $userThird['nickname']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3" id="disassociationBox">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <input id="disassociation" style="margin-top: 20px" type="submit" class="btn btn-warning btn-block" value="取消关联"/>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" id="searchResult" style="background: #e6f7f5">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <table class="table table-nowrap" width="30%">
                            <thead>
                            <tr>
                                <th style="vertical-align: middle;">
                                    <div class="th-inner ">姓名</div>
                                </th>
                                <th style="vertical-align: middle;">
                                    <div class="th-inner ">卡号</div>
                                </th>
                                <th style="vertical-align: middle;">
                                    <div class="th-inner ">级别</div>
                                </th>
                                <th style=" vertical-align: middle; font-size: 12px">
                                    <div class="th-inner ">性别</div>

                                </th>
                                <th style=" vertical-align: middle; font-size: 12px">
                                    <div class="th-inner ">电话</div>
                                </th>
                                <th style=" vertical-align: middle; font-size: 12px">
                                    <div class="th-inner ">所属店铺</div>
                                </th>
                            </tr>
                            </thead>
                            <tr>
                                <td style="vertical-align: middle;"><span id="name"><?php echo $data['name']; ?></span></td>
                                <td style="vertical-align: middle;"><span id="cardnum"><?php echo $data['cardnum']; ?></span></td>
                                <td style="vertical-align: middle;"><span id="level"><?php echo $data['level']; ?></span></td>
                                <td style="vertical-align: middle;"><span id="sex"><?php echo !empty($data['sex'])?'男':'女'; ?></span></td>
                                <td style="vertical-align: middle;"><span id="mobile"><?php echo $data['mobile']; ?></span></td>
                                <td style="vertical-align: middle;"><span id="store"><?php echo $data['store']; ?></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>

                    $(function () {
                        $("#search").on("click", function () {
                            if ($("#userinfo").val() == '' || $("#userinfo").val() == 0) {
                                Layer.msg("请填写查询数据！");
                                return false;
                            }
                            if ($("#classify").val() == '' || $("#classify").val() == 0) {
                                Layer.msg("请选择查询类别！");
                                return false;
                            }
                            $.ajax({
                                type: "POST",
                                url: 'user.user_relation/search',
                                data: {
                                    "classify": $("#classify").val(),
                                    "userinfo": $("#userinfo").val(),
                                },
                                dataType: "json",
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                success: function (data) {
                                    if(data.code){
                                        //Layer.msg(data.msg);

                                        $("#name").html(data.data.name);
                                        $("#level").html(data.data.level);
                                        $("#mobile").html(data.data.mobile);
                                        $("#sex").html(data.data.sex?'男':'女');
                                        $("#store").html(data.data.store);
                                        $("#relationBox").removeClass("hide");
                                        $("#searchResult").removeClass("hide");
                                    }else{
                                        Layer.msg(data.msg);
                                    }

                                }
                            });

                        });
                        $("#disassociation").on("click", function () {
                            var thirdid=<?php echo $userThird['id']; ?>;
                            $.ajax({
                                url: 'user.user_relation/disassociation/thirdid/'+thirdid,
                                dataType: "json",
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                success: function (data) {
                                    if(data.code){
                                        Layer.alert(data.msg);
                                        setTimeout(function () { parent.location.reload(); }, 2000);

                                    }else{
                                        Layer.alert(data.msg);
                                    }
                                }
                            });

                        });
                    });
                </script>
                <?php endif; ?>
                <hr>

                <div style="color: #666">说明：前端微信获取的用户信息，需要和后台数据的用户或者管理信息管理，前端才能收到消息等</div>
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