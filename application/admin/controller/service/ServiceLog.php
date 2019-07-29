<?php

namespace app\admin\controller\service;

use app\common\controller\Backend;
use think\Db;
use fast\Arrays;

/**
 * 服务记录
 *
 * @icon fa fa-circle-o
 */
class ServiceLog extends Backend
{

    /**
     * ServiceLog模型对象
     * @var \app\admin\model\ServiceLog
     */
    protected $model = null;
    //快速搜索字段
    protected $searchFields = 'user.cardnum,user.name';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\ServiceLog;

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
        $param=$this->request->param('item_id');

        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            echo $this->request->param('item');
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

                $total = $this->model
                    ->with(['user'])
                    ->where('fa_service_log.store_id', 'in', $this->storeIds)
                    ->where($where)
                    ->count();

                $list = $this->model
                    ->with(['user', 'serviceItems', 'store'])
                    ->where('fa_service_log.store_id', 'in', $this->storeIds)
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();


            //实例化admin模型
            $admin = new \app\admin\model\Admin;

            //实例化commentLog模型
            $commentLog = new \app\admin\model\CommentLog;

            //实例化customerLog模型
            $customerLog = new \app\admin\model\CustomerLog;

            foreach ($list as $k => $row) {

                $adminRes = $admin->field('id,name')->where('id', 'in', $row['admin_ids'])->select();
                $adminRes = collection($adminRes)->toArray();
                $tempString = '';
                $customerLogRes = [];
                foreach ($adminRes as $i => $r) {

                    //将技师ids转为字符串如：1，3转为 李武/赵氏
                    $tempString = $tempString . '/' . $r['name'];

                    //查询服务记录对应的技师客勤记录
                    $customerLogRes [] = $customerLog->field('id,admin_id,content')->where('admin_id', $r['id'])->where('service_id', $row['id'])->select();
                    $customerLogRes[$i]['name'] = $r['name'];
                    $customerLogRes[$i]['service_id'] = $row['id'];
                    //查询服务的评价
                    $commentLogRes = $commentLog->field('level')->where('admin_id', $r['id'])->where('service_id', $row['id'])->select();

                }


                $row['admin_name'] = ltrim($tempString, "/");
                $row['customer_log'] = $customerLogRes;
                $row['comment_log'] = $commentLogRes;

                $row->getRelation('user')->visible(['group_id', 'cardnum', 'username', 'name']);
                $row->getRelation('service_items')->visible(['servicename']);
                $row->getRelation('store')->visible(['storename']);
            }

            $list = collection($list)->toArray();

            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }


    /**
     * 详情
     */
    public function detail($ids = null)
    {

        $this->request->filter(['strip_tags']);
        $serviceLog = \app\admin\model\ServiceLog::with(['user', 'store', 'serviceItems'])->where('service_log.id', $this->request->param("ids"))->find();

        //实例化admin模型
        $admin = new \app\admin\model\Admin;

        //实例化commentLog模型
        $commentLog = new \app\admin\model\CommentLog;

        //实例化customerLog模型
        $customerLog = new \app\admin\model\CustomerLog;
        //查询该项目所属技师
        $adminItemsRes = $admin->field('id,name')->where('id', 'in', $serviceLog['service_items']['admin_ids'])->select();
        $adminItemsRes = collection($adminItemsRes)->toArray();
        $tempItemsString = '';
        foreach ($adminItemsRes as $rowItems) {
            //将技师ids转为字符串如：1，3转为 李武/赵氏
            $tempItemsString = $tempItemsString . '/' . $rowItems['name'];
        }

        $serviceLog ['admin_name'] = ltrim($tempItemsString, "/");


        //查询该次服务的技师
        $adminServiceRes = $admin->field('id,name')->where('id', 'in', $serviceLog['admin_ids'])->select();

        $adminServiceRes = collection($adminServiceRes)->toArray();

        $tempServiceString = '';
        $customerLogRes = [];
        $commentLogRes = [];
        foreach ($adminServiceRes as $rowService) {
            //将技师ids转为字符串如：1，3转为 李武/赵氏
            $tempServiceString = $tempServiceString . '/' . $rowService['name'];
            //查询服务记录对应的技师客勤记录
            $customerLogRes[] = $customerLog->field('admin_id,content')->where('admin_id', $rowService['id'])->where('service_id', $serviceLog['id'])->select();
            //查询服务的评价
            $commentLogRes[] = $commentLog->field('level')->where('admin_id', $rowService['id'])->where('service_id', $serviceLog['id'])->select();
        }


        $rowService['admin_name'] = ltrim($tempServiceString, "/");
        $rowService['customer_log'] = $customerLogRes;
        $rowService['comment_log'] = $commentLogRes;
        $this->view->assign('row', $rowService);
        $this->view->assign('serviceLog', $serviceLog);

        return $this->view->fetch();
    }

    /**
     * 写客勤
     */
    public function edit($ids = null)
    {

        $this->request->filter(['strip_tags', 'htmlspecialchars']);

        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            $id = $this->request->post("id");
            if ($params) {
                $adminAuth = \app\admin\model\Admin::field('id,name')->where('id', $this->auth->id)->find();

                $data = array('content' => $params['content'], 'remarks' => $params['remarks'], 'lasteditetime' => time(), 'lasteditadmin' => $adminAuth['name']);

                $result = \app\admin\model\CustomerLog::where('id', $id)->update($data);

                if ($result === false) {
                    $this->error();
                }

                $this->success();
            }
            $this->error();
        }
        $row = \app\admin\model\ServiceLog::with(['user', 'store', 'service_items'])->where('service_log.id', $this->request->param("sid"))->find();
        //获取技师
        $artificer = \app\admin\model\Admin::with(['customer_log'])->where('admin.id', $this->request->param("aid"))->find();

        $row->getRelation('user')->visible(['group_id', 'cardnum', 'username', 'name']);
        $row->getRelation('service_items')->visible(['servicename']);
        $this->view->assign('row', $row);
        $this->view->assign('artificer', $artificer);
        return $this->view->fetch();
    }

}
