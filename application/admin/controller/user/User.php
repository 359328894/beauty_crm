<?php

namespace app\admin\controller\user;

use app\common\controller\Backend;

/**
 * 顾客管理
 *
 * @icon fa fa-user
 */
class User extends Backend
{

    /**
     * User模型对象
     * @var \app\admin\model\User
     */
    protected $model = null;

    //快速搜索字段
    protected $searchFields = 'cardnum,name,mobile';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\User;

        $group = \app\admin\model\UserGroup::field('id,name,status')->select();
        $usergrouplist = collection($group)->toArray();


        //会员级别表降维为一维数组
        $grouplist = [];
        foreach ($usergrouplist as $k => $v) {
            $grouplist[$v['id']] = $v['name'];
        }
        $this->view->assign("storeslist", $this->storeNames);
        $this->view->assign("grouplist", $grouplist);
    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */


    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            //判断是不是最高管理员
            if ($this->auth->isSuperAdmin()) {
                $total = $this->model
                    ->with(['group', 'store'])
                    ->where($where)
                    ->order($sort, $order)
                    ->count();
                $list = $this->model
                    ->with(['group', 'store'])
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();
            } else {
                $total = $this->model
                    ->with(['group', 'store'])
                    ->where('store_id', 'in', $this->storeIds)
                    ->where($where)
                    ->order($sort, $order)
                    ->count();
                $list = $this->model
                    ->field(['password', 'salt', 'token'], true)
                    ->with(['group', 'store'])
                    ->where($where)
                    ->where('store_id', 'in', $this->storeIds)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();
            }

            foreach ($list as $row) {

                $row->getRelation('group')->visible(['name', 'rules']);
                $row->getRelation('store')->visible(['storename']);
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 编辑
     */
    public function edit($ids = NULL)
    {
        $row = $this->model->get(['id' => $ids]);

        if (!$row)
            $this->error(__('No Results were found'));

        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {

                //这里需要针对mobile做唯一验证
                $validate = \think\Loader::validate('User');
                $result = $row->validate('User.edit')->save($params);
                if ($result === false) {
                    $this->error($row->getError());
                }

                $this->success();
            }
            $this->error();
        }

        $this->view->assign("row", $row);

        return $this->view->fetch();
    }

    /**
     * 查询
     */
    public function search($ids = NULL)
    {
        $row = $this->model->get(['id' => $ids]);

        if (!$row)
            $this->error(__('No Results were found'));
        $this->view->assign("row", $row);

        return $this->view->fetch();
    }
}
