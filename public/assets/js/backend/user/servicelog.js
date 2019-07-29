define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/servicelog/index',
                    add_url: 'user/servicelog/add',
                    edit_url: 'user/servicelog/edit',
                    del_url: 'user/servicelog/del',
                    multi_url: 'user/servicelog/multi',
                    table: 'service_log',
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
                        {field: 'user_id', title: __('User_id')},
                        {field: 'store_id', title: __('Store_id')},
                        {field: 'adminname', title: __('Adminname')},
                        {field: 'starttime', title: __('Starttime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'serviceitems', title: __('Serviceitems')},
                        {field: 'endtime', title: __('Endtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'specificnumbe', title: __('Specificnumbe')},
                        {field: 'star', title: __('Star')},
                        {field: 'comment', title: __('Comment')},
                        {field: 'remarks', title: __('Remarks')},
                        {field: 'customeranalysis', title: __('Customeranalysis')},
                        {field: 'admin.store_ids', title: __('Admin.store_ids')},
                        {field: 'admin.username', title: __('Admin.username')},
                        {field: 'store.storename', title: __('Store.storename')},
                        {field: 'user.cardnum', title: __('User.cardnum')},
                        {field: 'user.name', title: __('User.name')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
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
            }
        }
    };
    return Controller;
});