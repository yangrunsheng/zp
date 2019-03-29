<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加竞猜球队</title>
</head>
<body>
<form method="post" action="/boll/guess/doAdd">
    {{csrf_field()}}
    <table style="text-align:center;margin: 0 auto">
        <p style="font-size: 30px;">添加竞猜球队</p>
        <input type="text" name="team_a">   VS   <input type="text" name="team_b">
        <p>结束竞猜时间 <input type="text" name="end_at"></p>
        <input type="submit" value="添加">
    </table>
</form>
</body>
</html>