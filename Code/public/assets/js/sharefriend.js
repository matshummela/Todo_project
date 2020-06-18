function share() {
    $('#myModal').modal();
}

function shareFriend() {
    var status = 0;
    if ($("input[name=status]").is(":checked")) {
        status = 1;
    }
    $.post(
        "/todo/bind-friend",
        {
            "todolist_id": $("input[name=todolist_id]").val(),
            "friend_name": $("input[name=friend_name]").val(),
            "_token": $("input[name=_token]").val(),
            "status": status
        }, function (res) {
            if (res.code == 1) {
                alert("分享成功");

            } else {
                alert(res.msg);
            }
        }
    )
}

function updateRole(id) {
    if ($("#friend" + id).find("input").val() == "0") {
        var is_update = 1;
    } else {
        var is_update = 0;
    }
    $.post(
        "/todo/update-role",
        {
            'id': id,
            '_token': $("input[name=_token]").val(),
            'is_update': is_update,
        }, function (res) {
            if (res.code == 1) {
                $("#friend" + id).find("span").html(res.real_update);
                $("#friend" + id).find("input").val(is_update);
            }
        }
    )
}

function delFriend(id) {
    $.post(
        "/todo/delete-role",
        {
            'id': id,
            '_token': $("input[name=_token]").val(),
        }, function (res) {
            if (res.code == 1) {
                $("#friend" + id).remove();
            }
        }
    )
}