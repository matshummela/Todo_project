@extends('layouts.app')

@section('content')
    <div class="container"><h1>TODO</h1>
        @if($bAuthor)
        <button type="button" class="btn btn-dark" onclick="share()" style="margin-bottom: 10px">分享给好友</button>
        @endif
        <div id="createTodo">
            <div class="form-group">
                <input type="text" name="content" class="form-control">
                <button type="button" class="btn btn-dark" onclick="add()" style="margin-top: 10px">新增</button>
            </div>
        </div>
        <h2>TODO 列表</h2>
        <input type="hidden" name="todolist_id" value="{{ $todolistId }}">
        <div>
            <button type="button" class="btn btn-dark" style="margin-bottom: 10px" onclick="show('0')">未完成</button>
            <button type="button" class="btn btn-dark" style="margin-bottom: 10px" onclick="show('1')">已完成</button>
        </div>
        <div id="errMsg"></div>
        <div>
            <table class="table todos">

            </table>
            {{csrf_field()}}
        </div>
        @if($bAuthor)
            <h2>共享好友列表</h2>
            <div>
                <table class="table todo-friend">
                    <thead>
                    <colgroup>
                        <col class="col-xs-10">
                        <col class="col-xs-1">
                        <col class="col-xs-1">
                    </colgroup>
                    <tr>
                        <th>共享好友昵称</th>
                        <th >所属权限</th>
                        <th >操作</th>
                    </tr>
                    </thead>
                    @foreach($oUserTodoLists as $user_todo)
                        <tr id="friend{{ $user_todo->id }}">
                            <td>
                                <label>{{ $user_todo->real_name }}</label>
                            </td>
                            <td class="role" style="color:#3490dc;font-size: 16px;font-weight: bold">
                                <span id="is_update">{{ $user_todo->real_update }}</span>
                                <input type="hidden" name="is_update" value="{{ $user_todo->is_update }}">
                            </td>
                            <td>
                                <button type="button" class="btn btn-dark" onClick="delFriend('{{$user_todo->id}}')">
                                    删除
                                </button>
                                <button type="button" class="btn btn-dark" onClick="updateRole('{{$user_todo->id}}')">
                                    修改权限
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        @endif
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="friend_name" class="form-control"
                           placeholder="请输入需要分享的好友昵称或者邮箱">
                    <label class="checkbox" style="margin-top: 10px">
                        <input type="checkbox" name="status" value="1">
                        是否赋予编辑权限
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭
                    </button>
                    <button type="button" id="btn_submit" onclick="shareFriend()" class="btn btn-primary"
                            data-dismiss="modal"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>分享
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/sharefriend.js')}}"></script>
    <script>
        $(function () {
            show('0');
        });

        function show(status) {
            $.get(
                "{{route('todo')}}",
                {
                    'status': status,
                    "todolist_id": $("input[name=todolist_id]").val(),
                },
                function (res) {
                    if (res.code == 1) {
                        $(".todos").html(res.html);
                    }
                }
            )
        }

        function add() {
            var list_content = $("input[name=content]").val();
            if (list_content == "") {
                alert("所添加的任务不能为空");
                return false;
            }
            $.post(
                "todo/add",
                {
                    "todolist_id":$("input[name=todolist_id]").val(),
                    "content": list_content,
                    "_token": $("input[name=_token]").val()
                }, function (res) {
                    if (res.code == 1) {
                        var html = "<tr id='" + res.id + "'>\n" +
                            "<td>\n" +
                            "          <div class=\"checkbox\"><label><input type=\"checkbox\" onClick=\"updateStatus('" + res.id + "')\">" + list_content + "</label></div>\n" +
                            "         </td>\n" +
                            "    <td>"+res.todolist_name+"</td>\n" +
                            "    <td>" + res.username + "</td>\n" +
                            "    <td>\n" +
                            "        <button type=\"button\" class=\"btn btn-dark\" onClick=\"del('" + res.id + "')\">删除</button>\n" +
                            "    </td>\n" +
                            "</tr>";
                        $(".todos").append(html);
                    } else {
                        alert(res.msg);
                    }
                }
            )
        }

        function del(id) {
            $.post(
                "todo/del",
                {
                    "id": id,
                    "_token": $("input[name=_token]").val()
                }, function (res) {
                    if (res.code == 1) {
                        $("#" + id).remove();
                    } else {
                        alert(res.msg);
                    }
                }
            )
        }

        function updateStatus(id,_this) {
            $.get(
                "/todo/update-status",
                {
                    'id': id,
                },
                function (res) {
                    if (res.code == 1) {
                        $("#" + id).remove();
                    }else {
                        alert(res.msg);
                        $(_this).prop('checked',false);
                    }
                }
            )
        }

    </script>
@stop
