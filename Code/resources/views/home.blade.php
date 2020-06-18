@extends('layouts.app')
@section('content')
    <div class="container">
        <h4><a href="/notify/list">通知消息<span
                        @if($iMessageCount>0)
                        style="color: red"
                        @endif
                >(未读{{ $iMessageCount }}条)</span></a></h4>
        <br>
        <br>
        <h4>待办事项列表</h4>
        <button type="button" class="btn btn-primary" style="margin-bottom: 10px" onclick="view()">
            <span class="glyphicon glyphicon-plus"></span>创建事项列表
        </button>
        <table class="table table-condensed " >
            @foreach($oMyTodoLists as $mytodo)
                <tr class="success">
                    <td><a style="font-size: 18px;font-weight: bold" href="{{ route('todo',['todolist_id'=>$mytodo->id]) }}">{{ $mytodo->name }}</a></td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="delList('{{ $mytodo->id }}')" style="margin-bottom: 10px">
                            <span class="glyphicon glyphicon-plus"></span>删除列表
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
        <h4>共享事项列表</h4>
        <table class="table table-condensed ">
            @foreach($oSharedTodoLists as $todo)
                <tr class="success">
                    <td><a style="font-size: 18px;font-weight: bold" href="{{ route('todo',['todolist_id'=>$todo->id,'type'=>'share']) }}">{{ $todo->name }}</a></td>
                </tr>
            @endforeach
        </table>

    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="todolist_name" class="form-control"
                           placeholder="请输入需要创建列表的名称">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭
                    </button>
                    {{ csrf_field() }}
                    <button type="button" id="btn_submit" onclick="createTodoList()" class="btn btn-primary"
                            data-dismiss="modal"><span
                                class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>创建
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
@endsection
