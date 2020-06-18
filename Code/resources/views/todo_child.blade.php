<thead>
<colgroup>
    <col class="col-xs-10">
    <col class="col-xs-1">
    <col class="col-xs-1">
</colgroup>
<tr>
    <th>描述</th>
    <th>标签</th>
    <th>所有者</th>
    <th>操作</th>
</tr>
</thead>
@if($oTodos->count()>0)
    @foreach($oTodos as $todo)
        <tr id="{{$todo->id}}">
            <td>
                <div class="checkbox"><label>
                        <input type="checkbox"
                               @if($todo->status==1)
                               checked
                               disabled="disabled"
                               @else
                               onClick="updateStatus('{{$todo->id}}',this)"
                                @endif
                        >{{$todo->content}}
                    </label></div>
            </td>
            <td>{{ $todo->todolist->name }}</td>
            <td>{{$todo->user_name}}</td>
            <td>
                <button type="button" class="btn btn-dark" onClick="del('{{$todo->id}}')">删除</button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td style="font-size: 18px;font-weight:bold;color:cornflowerblue">所有任务均已完成</td>
    </tr>
@endif

