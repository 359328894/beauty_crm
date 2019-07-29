define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/user_third/index',
                    del_url: 'user/user_third/del',
                    multi_url: 'user/user_third/multi',
                    table: 'user_third',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'avatar', title: __('Avatar')},
                        {field: 'nickname', title: __('Nickname')},
                        {
                            field: 'status',
                            title: __('Status'),
                            searchList: {"1": __('Status 1'), "2": __('Status 2'),"0": __('Status 0')},
                            formatter: Controller.api.formatter.status
                        },
                        {field: 'relation.name', title: __('Relation.name')},
                        {
                            field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'detail',
                                    title: __('关联'),
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    icon: 'fa fa-chain',
                                    url: 'user.user_relation/index/rid/{relation_id}',
                                }],

                            formatter: Table.api.formatter.operate
                        },
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            table.off('dbl-click-row.bs.table');
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            },
            //自定义formatter
            formatter: {
                status: function (value, row, index) {
                    if (value == 1) {
                        return '<span style="color: #5588AA">已关联->客户</span>'
                    } else if (value == 2) {
                        return '<span style="color:#C43C57">已关联->员工</span>'
                    } else {
                        return '<span style="color: #ccc">未关联</span>'
                    }
                }
            }
        }
    };
    return Controller;
});