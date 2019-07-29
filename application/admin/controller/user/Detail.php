<?php

namespace app\admin\controller\user;

use app\common\controller\Backend;
use http\Params;

/**
 * 客户详情
 *
 * @icon fa fa-user
 */
class Detail extends Backend
{

    /**
     * User模型对象
     * @var \app\admin\model\Detail
     */
    protected $model = null;

    //快速搜索字段
    protected $searchFields = 'cardnum,name,mobile';
    //protected $dataLimitField = 'admin_id'; //数据关联字段,当前控制器对应的模型表中必须存在该字段
    protected $noNeedRight = ['table1', 'table2'];

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
     * 客户基本信息
     */
    public function index($ids = NUll)
    {
        $userInfo = [
            ['field' => 'baseInfo', 'tabtitle' => '基础档案'],
            ['field' => 'extendInfo', 'tabtitle' => '扩展资料'],
            ['field' => 'thirdInfo', 'tabtitle' => '授权信息'],
            ['field' => 'serviceItems', 'tabtitle' => '服务项目'],
            ['field' => 'arriveStore', 'tabtitle' => '到店客勤'],
            ['field' => 'recordLog', 'tabtitle' => '积分记录'],
            ['field' => 'userOrder', 'tabtitle' => '会员订单']
        ];
        $index = 0;
        foreach ($userInfo as $k => &$v) {
            $v['active'] = !$index ? true : false;
            $index++;
        }
        $params = $this->request->param();
        if ($params['ids']) {
            $baseInfo = \app\admin\model\User::field('password,salt,token,verification', true)->find($params['ids']);
            $userGroup = \app\admin\model\UserGroup::field('name')->find($baseInfo['group_id']);
            $userStore = \app\admin\model\Store::field('storename')->find($baseInfo['store_id']);

            $baseInfo['group'] = $userGroup;
            $baseInfo['store'] = $userStore;

            $extendInfo = \app\admin\model\UserExtend::where('user_id', $params['ids'])->find();


            $this->view->assign("userInfo", $userInfo);
            $this->view->assign("baseInfo", $baseInfo);
            $this->view->assign("extendInfo", $extendInfo);
            $this->loadlang('general/attachment');
            $this->loadlang('general/crontab');
            return $this->view->fetch();
        } else {
            $this->error();
        }

    }

    /**
     * 编辑单个拓展资料
     */

    public function extendEdit($ids = NUll)
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        $params = $this->request->param();
        $extendInfo = \app\admin\model\UserExtend::where('user_id', $params['ids'])->find();

        $author = \app\admin\model\Admin::find($this->auth->id);

        if ($this->request->isAjax()) {

            $redata = ['code' => 0, 'data' => '', 'msg' => '操作失败', 'url' => '', 'wait' => 3];

            $params = $this->request->param();

            switch ($params['item']) {
                case 1:
                    if ($params['content'] != $extendInfo['health']) {
                        $data = array('health' => $params['content'], 'health_lastendtime' => time(), 'health_lastendauthor' => $author['name']);
                        $result = \app\admin\model\UserExtend::where('id', $params['ids'])->update($data);
                        if($result){
                            $redata = [
                                'code' => 1,
                                'msg' => '操作成功！',
                                'data' => [
                                    'health_lastendtime' => time(),
                                    'health_lastendauthor' => $author['name'],
                                    'item' => $params['item'],
                                    'content' => $params['content'],
                                    'sign' => date('Y-m-d H:m:s',time()).' / '.$author['name'],
                                    'param' => 'health',
                                ]
                            ];
                        }
                    }
                    return json($redata);
                    break;
                case 2:
                    if ($params['content'] != $extendInfo['family']) {
                        $data = array('health' => $params['content'], 'family_lastendtime' => time(), 'family_lastendauthor' => $author['name']);
                        $result = \app\admin\model\UserExtend::where('id', $params['ids'])->update($data);
                        if($result){
                            $redata = [
                                'code' => 1,
                                'msg' => '操作成功！',
                                'data' => [
                                    'health_lastendtime' => time(),
                                    'health_lastendauthor' => $author['name'],
                                    'item' => $params['item'],
                                    'content' => $params['content'],
                                    'sign' => date('Y-m-d H:m:s',time()).' / '.$author['name'],
                                    'param' => 'family',
                                ]
                            ];
                        }
                    }
                    return json($redata);
                    break;
                case 3:
                    if ($params['content'] != $extendInfo['income']) {
                        $data = array('income' => $params['content'], 'income_lastendtime' => time(), 'income_lastendauthor' => $author['name']);
                        $result = \app\admin\model\UserExtend::where('id', $params['ids'])->update($data);
                        if($result){
                            $redata = [
                                'code' => 1,
                                'msg' => '操作成功！',
                                'data' => [
                                    'health_lastendtime' => time(),
                                    'health_lastendauthor' => $author['name'],
                                    'item' => $params['item'],
                                    'content' => $params['content'],
                                    'sign' => date('Y-m-d H:m:s',time()).' / '.$author['name'],
                                    'param' => 'income',
                                ]
                            ];
                        }
                    }
                    return json($redata);
                    break;
                case 4:
                    if ($params['content'] != $extendInfo['ability']) {
                        $data = array('ability' => $params['content'], 'ability_lastendtime' => time(), 'ability_lastendauthor' => $author['name']);
                        $result = \app\admin\model\UserExtend::where('id', $params['ids'])->update($data);
                        if($result){
                            $redata = [
                                'code' => 1,
                                'msg' => '操作成功！',
                                'data' => [
                                    'health_lastendtime' => time(),
                                    'health_lastendauthor' => $author['name'],
                                    'item' => $params['item'],
                                    'content' => $params['content'],
                                    'sign' => date('Y-m-d H:m:s',time()).' / '.$author['name'],
                                    'param' => 'ability',
                                ]
                            ];
                        }
                    }
                    return json($redata);
                    break;
                case 5:
                    if ($params['content'] != $extendInfo['likes']) {
                        $data = array('health' => $params['content'], 'likes_lastendtime' => time(), 'likes_lastendauthor' => $author['name']);
                        $result = \app\admin\model\UserExtend::where('id', $params['ids'])->update($data);
                        if($result){
                            $redata = [
                                'code' => 1,
                                'msg' => '操作成功！',
                                'data' => [
                                    'health_lastendtime' => time(),
                                    'health_lastendauthor' => $author['name'],
                                    'item' => $params['item'],
                                    'content' => $params['content'],
                                    'sign' => date('Y-m-d H:m:s',time()).' / '.$author['name'],
                                    'param' => 'likes',
                                ]
                            ];
                        }
                    }
                    return json($redata);
                    break;
                case 6:
                    if ($params['content'] != $extendInfo['character']) {
                        $data = array('character' => $params['content'], 'character_lastendtime' => time(), 'character_lastendauthor' => $author['name']);
                        $result = \app\admin\model\UserExtend::where('id', $params['ids'])->update($data);
                        if($result){
                            $redata = [
                                'code' => 1,
                                'msg' => '操作成功！',
                                'data' => [
                                    'health_lastendtime' => time(),
                                    'health_lastendauthor' => $author['name'],
                                    'item' => $params['item'],
                                    'content' => $params['content'],
                                    'sign' => date('Y-m-d H:m:s',time()).' / '.$author['name'],
                                    'param' => 'character',
                                ]
                            ];
                        }
                    }
                    return json($redata);
                    break;
                case 7:
                    if ($params['content'] != $extendInfo['needs']) {
                        $data = array('needs' => $params['content'], 'needs_lastendtime' => time(), 'needs_lastendauthor' => $author['name']);
                        $result = \app\admin\model\UserExtend::where('id', $params['ids'])->update($data);
                        if($result){
                            $redata = [
                                'code' => 1,
                                'msg' => '操作成功！',
                                'data' => [
                                    'health_lastendtime' => time(),
                                    'health_lastendauthor' => $author['name'],
                                    'item' => $params['item'],
                                    'content' => $params['content'],
                                    'sign' => date('Y-m-d H:m:s',time()).' / '.$author['name'],
                                    'param' => 'needs',
                                ]
                            ];
                        }
                    }
                    return json($redata);
                    break;
                default:
                    return json($redata);
                    break;
            }

        }

        $this->view->assign("item", $params['item']);
        $this->view->assign("row", $extendInfo);
        return $this->view->fetch();
    }

    /**
     * 个人详情-服务项目table1
     */
    public function serviceItems($ids=null)
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
            $this->model = new \app\admin\model\service\Items;

            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $total = $this->model
                ->with(['user', 'store'])
                ->where($where)
                ->where('user_id',$ids)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->with(['user', 'store'])
                ->where($where)
                ->where('user_id',$ids)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            foreach ($list as $row) {

                $row->getRelation('user')->visible(['name', 'mobile', 'avatar', 'cardnum']);
                $row->getRelation('store')->visible(['storename']);
            }
            // $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);
            $this->assignconfig('item',['name'=>'lisi','value'=>2]);
            return json($result);
        }
        return $this->view->fetch('index');
    }

    public function arriveStore($ids=null)
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
            $this->model = new \app\admin\model\ServiceLog;

            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $total = $this->model
               ->with(['user'])
                ->where('service_log.store_id', 'in', $this->storeIds)
                ->where('service_log.user_id',$ids)
                ->where($where)
                ->count();

            $list = $this->model
                ->with(['user','serviceItems', 'store'])
                ->where('service_log.user_id',$ids)
                ->where('service_log.store_id', 'in', $this->storeIds)
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
                //$adminRes = collection($adminRes)->toArray();
                $tempString = '';
                $customerLogRes = [];
                foreach ($adminRes as $i => $r) {

                    //将技师ids转为字符串如：1，3转为 李武/赵氏
                    $tempString = $tempString . '/' . $r['name'];

                    //查询服务记录对应的技师客勤记录
                    $customerLogRes []= $customerLog->field('id,admin_id,content')->where('admin_id', $r['id'])->where('service_id', $row['id'])->select();
                    $customerLogRes[$i]['name']=$r['name'];
                    $customerLogRes[$i]['service_id']=$row['id'];
                    //查询服务的评价
                    $commentLogRes = $commentLog->field('level')->where('admin_id', $r['id'])->where('service_id', $row['id'])->select();

                }

                $row['admin_name'] = ltrim($tempString, "/");
                $row['customer_log'] = $customerLogRes;
                $row['comment_log'] = $commentLogRes;

                $row->getRelation('user')->visible(['group_id', 'cardnum', 'username', 'name']);
                $row->getRelation('service_items')->visible(['servicename,,service_items_id']);
                $row->getRelation('store')->visible(['storename']);
            }

            //$list = collection($list)->toArray();

            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }
    public function table3()
    {
        $this->model = model('AdminLog');
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch('index');
    }
    public function table4()
    {
        $this->model = model('AdminLog');
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch('index');
    }
    /**
     * 详情
     * */
    public function detai($ids = NUll)
    {
        $row = $this->model->get(['id' => $ids]);

        return $this->view->fetch();
    }

    /**
     * 其他信息
     * */
    public function other($ids = NUll)
    {
        $test = 'extend()';
        $this->view->assign("test", $test);
        return $this->view->fetch();
    }


}
