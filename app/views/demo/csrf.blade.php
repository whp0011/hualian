<!DOCTYPE html>
<html lang='zh-CN'>
<head>
    <meta charset='utf-8'/>
    <title>CSRF安全验证</title>
</head>
<body>
<form action="/demo/csrfCheck" method="post">
    <label>username<input type="text" name="username" size="30"></label><br><br>
    <label>crsf<input type="text" name="_token" value="{{csrf_token()}}" size="30"> </label>
    <input type="submit" value="submit">
</form>
</body>
</html>