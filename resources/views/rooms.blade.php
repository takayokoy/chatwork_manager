@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form method="post" action="{{ route('chatroom.add') }}">
            {{ csrf_field() }}
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">追加メンバー</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>アカウントID</label>
                            <input type="text" class="form-control" name="account_id" placeholder="Enter Account_id ID"
                                   value="{{old('account_id', $account_id = null)}}" required>
                        </div>
                        <div class="form-group">
                            <label>チャットルームへの権限</label>
                            <select class="form-control" name="role">
                                <option value="member" selected>メンバー</option>
                                <option value="admin">管理者</option>
                                <option value="readonly">読み取り専用</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">あなたが管理者のチャットルーム一覧（※メンバー権限のルームは表示されません）</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>ルームID</td>
                                <td>ルーム名</td>
                                <td>チャット種別</td>
                            </tr>
                            @foreach($roomList as $room)
                                @if($room['role'] == 'admin')
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="rooms[]" value="{{$room['room_id']}}"></label>
                                            </div>
                                        </td>
                                        <td>{{$room['room_id']}}</td>
                                        <td>{{$room['name']}}</td>
                                        <td>{{$room['type'] == 'direct' ? 'ダイレクトチャット' : 'グループチャット'}}</td>
                                    </tr>
                            @endif
                            @endforeach
                        </table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">設定</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
