@extends('layouts.app')

@section('content')
    <div class="container"><h1>TODO</h1>
        <table class="table table-condensed">
            @foreach($oMessage as $message)
                <tr class="success"
                    style="color: red;font-weight: bold"
                >
                    <td>{{ $message->message }}</td>
                    <td>

                        @if(!$message->is_read && !$message->is_auth)
                            <button type="button" class="btn btn-dark" onclick="accept('{{ $message->id }}', '{{$message->userlist_id}}','2')"
                                    style="margin-bottom: 10px">接受
                            </button>
                            <button type="button" class="btn btn-dark" onclick="accept('{{ $message->id }}','{{$message->userlist_id}}','1')"
                                    style="margin-bottom: 10px">拒绝
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            {{csrf_field()}}
        </table>
    </div>
    <script>
        function accept(message_id,id, status) {
            $.post(
                "/notify/accept",
                {
                    "id": id,
                    "message_id":message_id,
                    "status": status,
                    "_token": $("input[name=_token]").val()
                }, function (res) {
                    if (res.code == 1) {
                        window.location.reload();
                    }
                }
            )
        }
    </script>
@endsection
