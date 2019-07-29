define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/userextend/index',
                    add_url: 'user/userextend/add',
                    edit_url: 'user/userextend/edit',
                    del_url: 'user/userextend/del',
                    multi_url: 'user/userextend/multi',
                    table: 'user_extend',
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
                        {field: 'family', title: __('Family')},
                        {field: 'character', title: __('Character')},
                        {field: 'likes', title: __('Likes')},
                        {field: 'income', title: __('Income')},
                        {field: 'ability', title: __('Ability')},
                        {field: 'health', title: __('Health')},
                        {field: 'needs', title: __('Needs')},
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
           // Controller.api.bindevent();

            Form.api.bindevent($("form[role=form]"), function(data, ret){
                //这里是表单提交处理成功后的回调函数，接收来自php的返回数据
                Fast.api.close(data);

                if(data.health!=''&&data.health!=null) {
                    parent.$('#a-health').html(data.health);
                    parent.$('#n-health').html(data.health_lastendauthor + ' / ' + Table.api.formatter.datetime(data.health_lastendtime));
                }else{
                    parent.$('#a-health').html('');
                    parent.$('#n-health').html('');
                }

                if(data.family!=''&&data.family!=null) {
                    parent.$('#a-family').html(data.family);
                    parent.$('#n-family').html(data.family_lastendauthor+ ' / ' +Table.api.formatter.datetime(data.family_lastendtime));
                }else {
                    parent.$('#a-family').html('');
                    parent.$('#n-family').html('');
                }

                if(data.income!=''&&data.income!=null) {
                    parent.$('#a-income').html(data.income);
                    parent.$('#n-income').html(data.income_lastendauthor+ ' / ' +Table.api.formatter.datetime(data.income_lastendtime));

                }else {
                    parent.$('#a-income').html('');
                    parent.$('#n-income').html('');
                }
                if(data.ability!=''&&data.ability!=null) {
                    parent.$('#a-ability').html(data.ability);
                    parent.$('#n-ability').html(data.ability_lastendauthor+ ' / ' +Table.api.formatter.datetime(data.ability_lastendtime));
                }else {
                    parent.$('#a-ability').html('');
                    parent.$('#n-ability').html('');
                }

                if(data.likes!=''&&data.likes!=null){
                    parent.$('#a-likes').html(data.likes);
                    parent.$('#n-likes').html(data.likes_lastendauthor+ ' / ' +Table.api.formatter.datetime(data.likes_lastendtime));
                }else{
                    parent.$('#a-likes').html('');
                    parent.$('#n-likes').html('');
                }

                if(data.character!=''&&data.character!=null){
                    parent.$('#a-character').html(data.character);
                    parent.$('#n-character').html(data.character_lastendauthor+ ' / ' +Table.api.formatter.datetime(data.character_lastendtime));
                }else {
                    parent.$('#a-character').html('');
                    parent.$('#n-character').html('');
                }

                if(data.needs!=''&&data.needs!=null){
                    parent.$('#a-needs').html(data.needs);
                    parent.$('#n-needs').html(data.needs_lastendauthor+ ' / ' +Table.api.formatter.datetime(data.needs_lastendtime));
                }else{
                    parent.$('#a-needs').html('');
                    parent.$('#n-needs').html('');
                }

                }, function(data, ret){
                Toastr.success("操作失败");
            });
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});