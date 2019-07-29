define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {

            //获取地址参数
            var url = window.location.href;

            var strArr=url.split("/");

            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'service/service_log/index/item/'+strArr[8],
                    del_url: 'service/service_log/del',
                    multi_url: 'service/service_log/multi',
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
                        {field: 'user.cardnum', title: __('User.cardnum')},
                        {field: 'user.name', title: __('User.name'),formatter:Table.api.formatter.search},
                        {field: 'service_items.servicename', title: __('Serviceitems')},
                        {field: 'leftnumber', title: __('Leftnumber')},
                        {field: 'admin_name', title: __('Adminname')},
                        {field: '', title: __('Level')},
                        {field: 'store.storename', title: __('Store.storename')},
                        {field: 'createtime',sortable: true, title: __('Createtime'), operate: 'RANGE', addclass: 'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'customer_log', align:"left",title: __('customerLog'),cellStyle: Controller.api.formatter.css, formatter: Controller.api.formatter.customerService},
                        {
                            field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'user',
                                    title: __('个人'),
                                    classname: 'btn btn-xs btn-info btn-addtabs',
                                    icon: 'fa fa-user-o',
                                    url: 'user.detail/index',
                                },
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
            }
        }
    };
    return Controller;
});

