define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'service/items/index',
                    edit_url: 'service/items/edit',
                    del_url: 'service/items/del',
                    multi_url: 'service/items/multi',
                    table: 'service_items',
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

                        {
                            field: 'user.cardnum',
                            title: __('Cardnum'),
                            formatter: Table.api.formatter.search,
                            sortable: true,
                            cellStyle: function () {
                                return {css: {"min-width": "90px"}}
                            },
                        },
                        {field: 'user.name', title: __('User.name')},
                        {field: 'servicename', title: __('Servicename')},
                        {field: 'adminname', title: __('adminname'), formatter: Table.api.formatter.search},
                        {
                            field: 'createtime',
                            title: __('Createtime'),
                            sortable: true,
                            operate: 'RANGE',
                            addclass: 'datetimerange',
                            formatter: Controller.api.formatter.datetime,
                            cellStyle: function () {
                                return {css: {"min-width": "90px"}}
                            },
                        },
                        {
                            field: 'lastservicetime',
                            title: __('Lastservicetime'),
                            sortable: true,
                            operate: 'RANGE',
                            addclass: 'datetimerange',
                            formatter: Controller.api.formatter.datetime,
                            cellStyle: function () {
                                return {css: {"min-width": "90px"}}
                            },
                        },

                        {field: 'totalnumber', title: __('Totalnumber')},
                        {field: 'specificnumbe', title: __('Specificnumbe')},
                        {
                            field: 'status',
                            title: __('Status'),
                            searchList: {"end": __('已结束'), "ongoing": __('进行中'),},
                            formatter: Table.api.formatter.status
                        },
                        {field: 'store.storename', title: __('Store.storename'), formatter: Table.api.formatter.search},
                        {
                            field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'detail',
                                    title: __('客情'),
                                    classname: 'btn btn-xs btn-warning btn-dialog',
                                    icon: 'fa fa-user-plus',
                                    url: 'service/service_log/detail',
                                }, {
                                    name: 'detail',
                                    title: __('详情'),
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    icon: 'fa fa-list',
                                    url: 'service/items/detail',
                                }
                            ],

                            formatter: Table.api.formatter.operate
                        },
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
            },

            //自定义formatter函数
            formatter: {
                datetime: function (value, row, index) {
                    return value ? Moment(parseInt(value) * 1000).format("YYYY-MM-DD") : __('None');
                },

            },

        },
    };

    return Controller;
});