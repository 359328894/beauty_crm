<?php

namespace app\admin\controller\user;

use app\common\controller\Backend;

/**
 * 会员拓展信息
 *
 * @icon fa fa-circle-o
 */
class UserExtend extends Backend
{

    /**
     * UserExtend模型对象
     * @var \app\admin\model\UserExtend
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\UserExtend;

    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */

    /**
     * 编辑
     */

    public function edit($ids = NUll)
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        $params = $this->request->param();
        $extendInfo = \app\admin\model\UserExtend::where('user_id', $params['user_id'])->find();

        $author = \app\admin\model\Admin::find($this->auth->id);
        if ($this->request->isPost()) {
            $params = $this->request->param('row/a');

           // $redata = ['code' => 0, 'data' => '', 'msg' => '操作失败', 'url' => '', 'wait' => 3];
            $data=[];
            if ($params['health'] != $extendInfo['health']) {
                $data =array_merge($data,['health' => $params['health'], 'health_lastendtime' => time(), 'health_lastendauthor' => $author['name']]);

            }

            if ($params['family'] != $extendInfo['family']) {
                $data =array_merge($data, ['family' => $params['family'], 'family_lastendtime' => time(), 'family_lastendauthor' => $author['name']]);
            }

            if ($params['income'] != $extendInfo['income']) {

                $data =array_merge($data,['income' => $params['income'], 'income_lastendtime' => time(), 'income_lastendauthor' => $author['name']]);
            }

            if ($params['ability'] != $extendInfo['ability']) {
                $data =array_merge($data,['ability' => $params['ability'], 'ability_lastendtime' => time(), 'ability_lastendauthor' => $author['name']]);
            }

            if ($params['likes'] != $extendInfo['likes']) {
                $data =array_merge($data,['likes' => $params['likes'], 'likes_lastendtime' => time(), 'likes_lastendauthor' => $author['name']]);
            }

            if ($params['character'] != $extendInfo['character']) {
                $data =array_merge($data,['character' => $params['character'], 'character_lastendtime' => time(), 'character_lastendauthor' => $author['name']]);
            }

            if ($params['needs'] != $extendInfo['needs']) {
                $data =array_merge($data,['needs' => $params['needs'], 'needs_lastendtime' => time(), 'needs_lastendauthor' => $author['name']]);
            }
            $user_id=$params['user_id'];
            if(!empty($data)){
                $result = \app\admin\model\UserExtend::where('user_id', $params['user_id'])->update($data);
            }
            $resdata = \app\admin\model\UserExtend::where('user_id', $params['user_id'])->find();

            $this->success('操作成功','',$resdata,3);

        }

        $this->view->assign("row", $extendInfo);
        return $this->view->fetch();
    }

}
