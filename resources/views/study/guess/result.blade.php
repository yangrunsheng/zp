<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>足球添加页面</title>
</head>
<body style="width:100%;">
<div style="margin: 0 auto;">
        <table style="width: 100%;border:#d4d4d4 1px solid;">
            <tr>
                <th  style="width:300px;text-align:center;font-weight:bold;">竞猜结果</th>
            </tr>
            <tr>
                <td  style="width:300px;text-align:center;">对阵结果：
                    {{$info['team_a']}}
                    <font color="red">@if($info['result'] == 1) 胜 @elseif($info['result'] == 2) 平 @else 负 @endif</font>
                    {{$info['team_b']}}
                </td>
            </tr>
            @if(!empty($first))
            <tr>
                <td style="width:300px;text-align:center;">您的竞猜：
                    {{$info['team_a']}}
                    <font color="red">@if($first->g_reault==1)
                        胜
                    @elseif($first->g_reault==2)
                        平
                    @else
                        负
                    @endif
                    </font>
                    {{$info['team_b']}}
                </td>
            </tr>
            <tr>
                <td style="width:300px;text-align:center;">结果
                    <font color="red">@if($first->g_reault == $info['result'])恭喜您猜中了@else很抱歉没猜中@endif</font>
                </td>
            </tr>
                @else
            <tr>
                <td style="width: 300px;text-align: center;">结果：您没参与竞猜</td>
            </tr>
                @endif
        </table>
</div>
</body>
</html>