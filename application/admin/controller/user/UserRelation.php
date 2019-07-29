<?php

namespace app\admin\controller\user;

use app\common\controller\Backend;
use think\Request;
use think\Validate;
use think\Db;

/**
 * 关联授权
 *
 * @icon fa fa-circle-o
 */
class UserRelation extends Backend
{

    /**
     * UserRelation模型对象
     * @var \app\admin\model\UserRelation
     */
    protected $model = null;

    public function _initialize()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        parent::_initialize();
        $this->model = new \app\admin\model\UserRelation;
        $this->view->assign("statusList", $this->model->getStatusList());
    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */


    public function index($ids = null, $rid = 0)
    {

        //设置过滤方法
        $this->request->filter(['strip_tags']);

        //第三方授权用户表id
        $userThirdId = $this->request->param('ids');

        //第三方授权用户表关联id
        $relationId = $this->request->param('rid');

        $userThird = \app\admin\model\UserThird::where('id', $userThirdId)->find()->toArray();
        //$userReltation = $userThird ? null : $userThird->toArray();

        if ($userThird['status'] == 1 && $userThird) {//关联客户

            $userReltation = \app\admin\model\UserRelation::where('id', $relationId)->find();

            $user = \app\admin\model\User::field(['store_id', 'name', 'cardnum', 'sex', 'mobile'])//field需要放在前面才能生效
            ->with(['store', 'group'])
                ->where('user.id', $userReltation['uid'])
                ->find();
            $data = [
                'name' => $user['name'],
                'sex' => $user['sex'],
                'mobile' => $user['mobile'],
                'cardnum' => $user['cardnum'],
                'level' => $user['group']['name'],
                'store' => $user['store']['storename']
            ];

            $this->view->assign('data', $data);

            $this->view->assign('userReltation', $userReltation);

        }
        if ($userThird['status'] == 2) {//关联员工

            $userReltation = \app\admin\model\UserRelation::where('id', $relationId)->find();
            $admin = \app\admin\model\Admin::field(['store_ids', 'name', 'sex', 'cellphone'])//field需要放在前面才能生效
            ->with(['store'])
                ->where('admin.id', $userReltation['uid'])
                ->find();
            $data = [
                'name' => $admin['name'],
                'sex' => $admin['sex'],
                'cardnum' => '-',
                'mobile' => $admin['cellphone'],
                'level' => '员工',
                'store' => $admin['store']['storename']
            ];
            $this->view->assign('data', $data);
            $this->view->assign('userReltation', $userReltation);
        }

        $this->view->assign('userThird', $userThird);
        $this->assignconfig("admin", ['id' => $this->auth->id]);
        return $this->view->fetch();
    }

    /**
     *查询
     */
    public function search(Request $request)
    {

        //过滤提交数据
        $redata = ['code' => 0, 'data' => '', 'msg' => '操作失败', 'url' => '', 'wait' => 3];
        $this->request->filter(['strip_tags', 'htmlspecialchars']);

        $classify = $this->request->param('classify');
        $userinfo = $this->request->param('userinfo');

        //数据验证
        $validate = new Validate([
            'classify' => 'require',
            'userinfo' => 'require'
        ]);
        if (!$validate->check($this->request->param())) {
            $redata['code'] = 0;
            $redata['msg'] = '提交数据错误!';
            return json($redata);
        }
        if ($this->request->isAjax()) {
            if ($classify == 1) { //关联的是客户数据

                $user = \app\admin\model\User::field(['store_id', 'name', 'id', 'cardnum', 'sex', 'mobile'])//field需要放在前面才能生效
                ->with(['store', 'group'])
                    ->where('user.name', $userinfo)
                    ->whereOr('user.cardnum', $userinfo)
                    ->whereOr('user.mobile', $userinfo)
                    ->find();
                if ($user) {
                    $user = $user->toArray();
                    $redata = [
                        'code' => 1,
                        'msg' => '查询成功！',
                        'data' => [
                            'name' => $user['name'],
                            'classify' => $classify,
                            'id' => $user['id'],
                            'sex' => $user['sex'],
                            'mobile' => $user['mobile'],
                            'cardnum' => $user['cardnum'],
                            'level' => $user['group']['name'],
                            'store' => $user['store']['storename']
                        ]
                    ];

                } else {
                    $redata = [
                        'code' => 0,
                        'msg' => '未查询到数据！',
                    ];
                }

                return json($redata);
            } else if ($classify == 2) {//关联的是员工数据

                $admin = \app\admin\model\Admin::field(['store_ids', 'name', 'id', 'sex', 'cellphone'])//field需要放在前面才能生效
                ->with(['store'])
                    ->where('admin.name', $userinfo)
                    ->whereOr('admin.cellphone', $userinfo)
                    ->find();
                if ($admin) {
                    $admin = $admin->toArray();
                    $redata = [
                        'code' => 1,
                        'msg' => '查询成功！',
                        'data' => [
                            'name' => $admin['name'],
                            'classify' => $classify,
                            'id' => $admin['id'],
                            'sex' => $admin['sex'],
                            'cardnum' => '员工',
                            'mobile' => $admin['cellphone'],
                            'level' => '-',
                            'store' => $admin['store']['storename']
                        ]
                    ];
                } else {
                    $redata = [
                        'code' => 0,
                        'msg' => '未查询到数据！',
                    ];
                }

                return json($redata);
            } else {//未做关联
                $redata = [
                    'code' => 0,
                    'msg' => '未做关联！',
                ];
            }

        }
    }

    /**
     *关联数据
     */

    public function association()
    {

        $redata = ['code' => 0, 'data' => '', 'msg' => '操作失败', 'url' => '', 'wait' => 3];

        $this->request->filter(['strip_tags', 'htmlspecialchars']);
        $classify = $this->request->param('classify');
        $id = $this->request->param('id');
        $thirdid = $this->request->param('thirdid');
        if ($classify == 1) { //关联客户
            $user = \app\admin\model\User::field(['store_id', 'name', 'id'])->where('id', $id)->find()->toArray();

            if (!$user) {
                $redata = [
                    'code' => 0,
                    'msg' => '关联出错，未查询到需要关联的客户资料！',
                ];

            } else {
                $userRelstion = \app\admin\model\UserRelation::where('uid', $id)->where('name', $user['name'])->find();;

                //判断需要关联的客户是否已经被关联

                if ($userRelstion) {
                    $redata = [
                        'code' => 0,
                        'msg' => '该客户已经被关联！',
                    ];
                } else {

                    //判断需要关联的客户所在的store_id 是否在管理员所在的store_ids里面
                    if (in_array($user['store_id'], $this->storeIds)) {
                        Db::startTrans();
                        try {
                            $relationdata = ['uid' => $user['id'], 'name' => $user['name']];
                            $insertid = Db::name('UserRelation')->insertGetId($relationdata);
                            Db::name('UserThird')->where('id', $thirdid)->update(['relation_id' => $insertid, 'status' => '1']);
                            // 提交事务
                            Db::commit();
                            $redata = [
                                'code' => 1,
                                'msg' => '关联成功！',
                            ];

                        } catch (\Exception $e) {
                            // 回滚事务
                            Db::rollback();
                        }
                    } else {
                        $redata = [
                            'code' => 0,
                            'msg' => '该客户不是您店铺的客户，无权关联！',
                        ];
                    }
                }

            }

        }
        if ($classify == 2) {//关联员工

            $admin = \app\admin\model\Admin::field(['store_ids', 'name', 'id'])->where('id', $id)->find()->toArray();

            if (!$admin) {
                $redata = [
                    'code' => 0,
                    'msg' => '关联出错，未查到要关联员工户资料！',
                ];

            } else {

                $userRelstion = \app\admin\model\UserRelation::where('uid', $id)->where('name', $admin['name'])->find();

                //判断需要关联的客户是否已经被关联

                if ($userRelstion) {
                    $redata = [
                        'code' => 0,
                        'msg' => '该客户已经被关联！',
                    ];
                } else {

                    //判断需要关联的客户所在的store_id 是否在管理员所在的store_ids里面
                    if (in_array($admin['store_ids'], $this->storeIds)) {

                        Db::startTrans();
                        try {
                            $relationdata = ['uid' => $admin['id'], 'name' => $admin['name']];
                            $insertid = Db::name('UserRelation')->insertGetId($relationdata);
                            Db::name('UserThird')->where('id', $thirdid)->update(['relation_id' => $insertid, 'status' => '2']);
                            // 提交事务
                            Db::commit();
                            $redata = [
                                'code' => 1,
                                'msg' => '关联成功！',
                            ];

                        } catch (\Exception $e) {
                            // 回滚事务
                            Db::rollback();
                            $redata = [
                                'code' => 0,
                                'msg' => '关联失败，可以联系管理员操作！',
                            ];
                        }
                    } else {
                        $redata = [
                            'code' => 0,
                            'msg' => '该员工不是您店铺下，无权关联！',
                        ];
                    }
                }

            }
        }
        return json($redata);
    }


    /**
     *取消关联数据
     */

    public function disassociation()
    {

        $redata = ['code' => 0, 'data' => '', 'msg' => '操作失败', 'url' => '', 'wait' => 3];

        $this->request->filter(['strip_tags', 'htmlspecialchars']);
        $thirdid = $this->request->param('thirdid');

        $userThird = new \app\admin\model\UserThird;
        $userThirdData = $userThird->field('id,relation_id,status')->find($thirdid);

        if (!$userThirdData) {
            return json($redata);
        }
        $userRelation = new \app\admin\model\UserRelation;
        $userRelationData = $userRelation->field('id,name,uid')->find($userThirdData['relation_id']);

        if ($userThirdData['status'] == 1) { //取消关联客户
            $user = \app\admin\model\User::field(['store_id', 'name', 'id'])->where('id', $userRelationData['uid'])->find();
            //判断需要关联的客户所在的store_id 是否在管理员所在的store_ids里面
            if (in_array($user['store_id'], $this->storeIds) || !$user) {
                Db::startTrans();
                try {

                    Db::name('UserThird')->where('id', $thirdid)->update(['relation_id' => 0, 'status' => 0]);
                    Db::name('UserRelation')->delete($userThirdData['relation_id']);
                    // 提交事务
                    Db::commit();
                    $redata = [
                        'code' => 1,
                        'msg' => '取消关联，操作成功！',
                    ];

                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();
                    $redata = [
                        'code' => 0,
                        'msg' => '关联失败，可以联系管理员操作！',
                    ];
                }
            } else {
                $redata = [
                    'code' => 0,
                    'msg' => '该客户不是您店铺的客户，无权关联！',
                ];
            }

        }
        if ($userThirdData['status'] == 2) {//关联员工

            $admin = \app\admin\model\Admin::field(['store_ids', 'name', 'id'])->where('id', $userRelationData['uid'])->find()->toArray();

            //判断需要关联的客户所在的store_id 是否在管理员所在的store_ids里面
            if (in_array($admin['store_ids'], $this->storeIds) || !$admin) {

                Db::startTrans();
                try {
                    Db::name('UserThird')->where('id', $thirdid)->update(['relation_id' => 0, 'status' => 0]);
                    Db::name('UserRelation')->delete($userThirdData['relation_id']);
                    // 提交事务
                    Db::commit();
                    $redata = [
                        'code' => 1,
                        'msg' => '取消关联，操作成功！',
                    ];

                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();
                    $redata = [
                        'code' => 0,
                        'msg' => '关联失败，可以联系管理员操作！',
                    ];
                }
            } else {
                $redata = [
                    'code' => 0,
                    'msg' => '该员工不是您店铺下，无权关联！',
                ];
            }
        }

        return json($redata);
    }
}
