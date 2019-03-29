<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我要竞猜</title>
</head>
<body>
<form method="post" action="/boll/guess/doGuess">
    {{csrf_field()}}
    <input type="hidden" name="user_id" value="{{$user_id}}">
    <input type="hidden" name="team_id" value="{{$info['id']}}">
    <table style="width: 100%;border:#d4d4d4 1px solid;">
        <tr>
            <th  style="width:300px;text-align:center;font-weight:bold;">我要竞猜</th>
        </tr>
        <tr>
            <td  style="width:300px;text-align:center;">{{$info['team_a']}} VS {{$info['team_b']}}</td>
        </tr>
        <tr>
            <td style="width:300px;text-align:center;">
                <input type="radio" name="g_reault" value="1">胜
                <input type="radio" name="g_reault" value="2">平
                <input type="radio" name="g_reault" value="3">负
            </td>
        </tr>
        <tr>
            <td  style="width:300px;text-align:center;"><input type="submit" value="竞猜"></td>
        </tr>
    </table>
</form>
</body>
</html>