function view() {
    $('#myModal').modal();
}

function createTodoList() {
    var list_name = $("input[name=todolist_name]").val();
    if (list_name == "") {
        alert("所添加的列表名称不能为空");
        return false;
    }
    $.post(
        "todolist/add",
        {
            "list_name": list_name,
            "_token": $("input[name=_token]").val()
        }, function (res) {
            if (res.code == 1){
                //alert('添加成功');
                window.location.reload();
            }

        }
    )
}

function delList(id) {
    $.post(
        "todolist/del",
        {
            "id": id,
            "_token": $("input[name=_token]").val()
        }, function (res) {
            if (res.code == 1) {
                location.reload();
            } else {
                alert(res.msg);
            }
        }
    )
}