<?php

namespace app\admin\controller\service;

use app\common\controller\Backend;


/**
 * 客勤管理
 *
 * @icon fa fa-users
 */
class Items extends Backend
{

    /**
     * Items模型对象
     * @var \app\admin\model\service\Items
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\service\Items;
        $this->view->assign("statusList", $this->model->getStatusList());
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

                $total = $this->model
                    ->with(['user', 'store'])
                    ->where('fa_service_items.store_id', 'in', $this->storeIds)
                    ->where($where)
                    ->count();

                $list = $this->model
                    ->with(['user', 'store'])
                    ->where('fa_service_items.store_id', 'in', $this->storeIds)
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            foreach ($list as $row) {

                $row->getRelation('user')->visible(['name', 'mobile', 'avatar', 'cardnum']);
                $row->getRelation('store')->visible(['storename']);
            }
            // $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 查看
     */
    public function detail()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);


        $row = $this->model
            ->with(['user', 'store'])
            ->where('fa_service_items.id', $this->request->param('ids'))
            ->find();
        $this->view->assign('row', $row);
        return $this->view->fetch();
    }

    /**
 * 编辑
 */
    public function edit($ids = null)
    {
        //设置过滤方法
        $this->request->filter(['strip_tags', 'htmlspecialchars']);
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                //将服务技师数组转化为字符串

                $params['adminname'] = implode("/", $params['adminname']);

                $result=$this->model->where('id',$ids)->update($params);
                if ($result === false) {
                    $this->error($result->getError());
                }
                $this->success();
            }
            $this->error();
        }

        $row = $this->model
            ->with(['user', 'store'])
            ->where('fa_service_items.id', $this->request->param('ids'))
            ->find();

        //获取店铺列表
        $store = \app\admin\model\Store::field('id,storename')->find($row['store_id']);

        //获取该店所有技师

        $admins = \app\admin\model\Admin::field('id,name,store_ids')->where('store_ids', 'like', $row['store_id'])->select();
        $storeAdmins = [];
        foreach ($admins as $k => $v) {
            $storeAdmins[$v['id']] = $v['name'];
        }
        //获取该该服务所有技师
        $serviceItems = \app\admin\model\service\Items::field('adminname')->where('id', $ids)->find();
        $serviceAmdmins = explode('/', $serviceItems['adminname']);

        $this->view->assign('row', $row);
        $this->view->assign("store", $store);
        $this->view->assign("storeAdmins", $storeAdmins);
        $this->view->assign("serviceAmdmins", $serviceAmdmins);

        return $this->view->fetch();
    }


    /**
     * 添加
     */
    public function add($ids=null)
    {
        $row = \app\admin\model\User::field('name,cardnum,id,store_id')->with('store')->find(['id' => $ids]);

        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");

            if ($params) {
                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }

                $admin = \app\admin\model\Admin::field('name')->where('id','in' , $params['admin_ids'])->select();
                $params['admin_ids'] = implode(',', $params['admin_ids']);

                foreach ($admin as $k=>$v){
                    $adminname[]=$v['name'];
                }
                $params['adminname'] = implode('/', $adminname);

                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validate($validate);
                    }
                    $result = $this->model->allowField(true)->save($params);
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error($this->model->getError());
                    }
                } catch (\think\exception\PDOException $e) {
                    $this->error($e->getMessage());
                } catch (\think\Exception $e) {
                    $this->error($e->getMessage());
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $admins = \app\admin\model\Admin::field('id,name,store_ids')->where('store_ids', 'like', $row['store_id'])->select();

        $this->view->assign("admins", $admins);
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }


}