define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {

        index: function () {
            // 初始化表格参数配置

            Table.api.init( );

            //绑定事件
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var panel = $($(this).attr("href"));
                if (panel.size() > 0) {
                   if(Controller.table[panel.attr("id")]){
                       Controller.table[panel.attr("id")].call(this);
                       $(this).on('click', function (e) {
                           $($(this).attr("href")).find(".btn-refresh").trigger("click");
                       });
                   }
                }
                //移除绑定的事件
                $(this).unbind('shown.bs.tab');
            });
            
            //必须默认触发shown.bs.tab事件
            $('ul.nav-tabs li.active a[data-toggle="tab"]').trigger("shown.bs.tab");
        },

        table: {

            serviceItems: function () {
                console.log(Config);
                //获取地址参数
                var url= window.location.href;
                var ids = url.substring(url.lastIndexOf('/') + 1);
                // 表格1
                var table1 = $("#table1");
                table1.bootstrapTable({
                    url: 'user/detail/serviceItems/ids/'+ids,
                    toolbar: '#toolbar1',
                    sortName: 'id',
                    search: false,
                    extend: {
                        add_url: 'service/items/add/ids/'+ids,
                        edit_url: 'service/items/edit',
                        del_url: 'service/items/del',
                        multi_url: 'service/items/multi',
                        table: 'service_items',
                    },
                    columns: [
                        [
                            {checkbox: true},

                            {
                                field: 'user.cardnum',
                                title: __('Cardnum'),
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
                            {
                                field: 'operate', title: __('Operate'), table: table1, events: Table.api.events.operate,
                                buttons: [
                                    {
                                        name: 'detail',
                                        title: __('项目客勤'),
                                        classname: 'btn btn-xs btn-warning btn-addtabs',
                                        icon: 'fa fa-user-plus',
                                        url: 'service/service_log/index/item/',
                                    }, {
                                        name: 'detail',
                                        title: __('项目详情'),
                                        classname: 'btn btn-xs btn-primary btn-dialog',
                                        icon: 'fa fa-list',
                                        url: 'service/items/detail',
                                    },
                                ],

                                formatter: Table.api.formatter.operate
                            },
                        ]
                    ]
                });

                // 为表格1绑定事件
                Table.api.bindevent(table1);
                table1.off('dbl-click-row.bs.table');
            },
            arriveStore: function () {
                //获取地址参数
                var url= window.location.href;
                var ids = url.substring(url.lastIndexOf('/') + 1);
                // 表格2
                var table2 = $("#table2");
                table2.bootstrapTable({
                    url: 'user/detail/arriveStore/ids/'+ids,
                    toolbar: '#toolbar2',
                    sortName: 'id',
                    search: false,
                    extend: {
                        add_url: 'service/service_log/add/ids/'+ids,
                        edit_url: 'service/service_log/edit',
                        del_url: 'service/service_log/del',
                        multi_url: 'service/service_log/multi',
                        table: 'service_log',
                    },
                    columns: [
                        [
                            {checkbox: true},
                            {field: 'user.cardnum', title: __('Cardnum')},
                            {field: 'user.name', title: __('User.name')},
                            {field: 'servicename', title: __('Servicename'),formatter:Table.api.formatter.search},
                            {field: 'leftnumber', title: __('Leftnumber')},
                            {field: 'admin_name', title: __('Adminname')},
                            {field: 'createtime',sortable: true, title: __('Servicetime'), operate: 'RANGE', addclass: 'datetimerange', formatter: Table.api.formatter.datetime},
                            {field: 'customer_log', align:"left",title: __('CustomerLog'),cellStyle: Controller.api.formatter.css, formatter: Controller.api.formatter.customerService},
                            {
                                field: 'operate', title: __('Operate'), table: table2, events: Table.api.events.operate,
                                buttons: [
                                    {
                                        name: 'detail',
                                        title: __('详情'),
                                        classname: 'btn btn-xs btn-primary btn-dialog',
                                        icon: 'fa fa-list',
                                        url: 'service/service_log/detail',
                                    }],

                                formatter: Table.api.formatter.operate
                            },
                        ],
                    ],
                });

                // 为表格2绑定事件
                Table.api.bindevent(table2);
                table2.off('dbl-click-row.bs.table');
            },
            recordLog: function () {
                // 表格3
                var table3 = $("#table3");
                table3.bootstrapTable({
                    url: 'user/Detail/table3',
                    extend: {
                        index_url: '',
                        add_url: '',
                        edit_url: '',
                        del_url: '',
                        multi_url: '',
                        table: '',
                    },
                    toolbar: '#toolbar3',
                    sortName: 'id',
                    search: false,
                    columns: [
                        [
                            {field: 'id', title: 'ID'},
                            {field: 'title', title: __('Title')},
                            {field: 'url', title: __('Url'), align: 'left', formatter: Table.api.formatter.url},
                            {field: 'ip', title: __('ip')},
                            {field: 'createtime', title: __('Createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        ]
                    ]
                });

                // 为表格3绑定事件
                Table.api.bindevent(table3);
            },
            userOrder: function () {
                // 表格4
                var table4 = $("#table3");
                table4.bootstrapTable({
                    url: 'user/Detail/table4',
                    extend: {
                        index_url: '',
                        add_url: '',
                        edit_url: '',
                        del_url: '',
                        multi_url: '',
                        table: '',
                    },
                    toolbar: '#toolbar4',
                    sortName: 'id',
                    search: false,
                    columns: [
                        [
                            {field: 'id', title: 'ID'},
                            {field: 'title', title: __('Title')},
                            {field: 'url', title: __('Url'), align: 'left', formatter: Table.api.formatter.url},
                            {field: 'ip', title: __('ip')},
                            {field: 'createtime', title: __('Createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        ]
                    ]
                });

                // 为表格4绑定事件
                Table.api.bindevent(table4);
            }
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
                css: function () {
                    return {
                        css: {"width": "30%","word-wrap": "break-word", "white-space": "normal","line-height":"28px"}
                    }
                },
                customerService: function (value, row, index) {

                    var html_strat = ' <div style="text-align: left;">'
                    var html_end = ' </div>'
                    var str = '';
                    for (var i = 0; i < value.length; i++) {

                        // console.log(value[i][0]['admin_id']);

                        if ((value[i][0]['content'] == '') || (value[i][0]['content'] == null)) {

                            str = str + '<span style="color:#ccc; ">' + value[i]['name'] + ' / </span><a  href="service/service_log/edit/id/'+value[i][0]["id"]+'/sid/'+value[i]["service_id"]+'/aid/' + value[i][0]["admin_id"] +'"  class="btn-dialog color-danger">写客勤</a>';

                        } else {
                            //console.log(value[i][0]['content'].toString().substr(0, 90));
                            if(value[i][0]['content'].toString().length > 90){
                                str = str + '<div style="text-align: left;margin: 6px 0">' + value[i][0]['content'].toString().substr(0, 90) + '... <span style="color:#ccc; "> ' + value[i]['name'] + ' / </span><a  href="service/service_log/edit/id/'+value[i][0]["id"]+'/sid/'+value[i]["service_id"]+'/aid/' + value[i][0]["admin_id"] +'"  class="btn-dialog color-primary">编辑</a></div>';
                            }else{
                                str = str + '<div style="text-align: left;margin: 6px 0">' + value[i][0]['content'].toString() + ' <span style="color:#ccc; "> ' + value[i]['name'] + ' / </span><a  href="service/service_log/edit/id/'+value[i][0]["id"]+'/sid/'+value[i]["service_id"]+'/aid/' + value[i][0]["admin_id"] +'"  class="btn-dialog color-primary">编辑</a></div>';
                            }

                        }

                    }
                    return html_strat + str + html_end;
                }
            },
        }
    };
    return Controller;
});