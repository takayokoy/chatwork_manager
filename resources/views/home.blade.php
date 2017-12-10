@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">ChatworkAPIトークン設定</div>

                <div class="panel-body">
                    <form method="post" action="{{ route('token') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>APIトークン</label>
                            <input type="text" class="form-control" name="token" placeholder="Enter Chatwork API Token"
                                   value="{{old('token', $token)}}" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">設定</button>
                        </div>
                        @if(isset($message) && !empty($message))
                            {{$message}}
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">操作</div>
                <div class="panel-body">
                    <ul>
                        <li><a href="{{ route('chatroom.showadd')}}">メンバーを複数チャットルームに一括追加する</a></li>
                        <li><a href="{{ route('chatroom.showdelete')}}">メンバーを複数チャットルームから一括削除する</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">アカウント情報</div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        @foreach($myInfoList as $key => $value)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$value}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
