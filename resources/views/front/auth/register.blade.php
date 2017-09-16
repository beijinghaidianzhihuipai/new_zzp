<form method="POST" action="/front/register">
    {!! csrf_field() !!}
    <div>
        用户名
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        手机号
        <input type="text" name="phone_num" value="{{ old('phone_num') }}">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        密码
        <input type="password" name="password">
    </div>

    <div>
        确认密码
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit">提交注册</button>
    </div>
</form>