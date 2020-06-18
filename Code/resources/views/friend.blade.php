@extends('layouts.app')

@section('content')
    <div class="container"><h1>TODO</h1>
        <div id="createTodo">
            <form action="/todos" method="POST">
                <div class="form-group">
                    <input type="text" name="content" class="form-control">
                    <button type="button" class="btn btn-dark" onclick="add()" style="margin-top: 10px">新增</button>
                </div>
            </form>
        </div>
        <h2>TODO好友管理</h2>
        <div>
            <table class="table">
                <thead>
                <colgroup>
                    <col class="col-xs-10">
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                </colgroup>
                <tr>
                    <th>共享好友昵称</th>
                    <th>所属权限</th>
                    <th>操作</th>
                </tr>
                </thead>
                    <tr id="xx">
                        <td>
                            <div class="checkbox"><label>
                                    <input type="checkbox"

                                    >用户A
                                </label></div>
                        </td>
                        <td class="role" style="color: blue;font-size: 16px;font-weight: bold">
                            只读
                        </td>
                        <td>
                            <button type="button" class="btn btn-dark" onClick="del('')">删除</button>
                            <button type="button" class="btn btn-dark" onClick="updateRole('1')">修改权限</button>
                        </td>
                    </tr>

            </table>
            {{csrf_field()}}
        </div>

        <div id="errMsg"></div>
        <div>
            <table class="table">

            </table>
            {{csrf_field()}}
        </div>
    </div>

    <script>
        function updateRole(id) {
            $.post(
                "url",
                {
                    "id":id,
                    "is_update":0,
                    "_token":$("input[name=_token]").val()
                },function (res) {

                }
            )
        }
    </script>
@endsection
