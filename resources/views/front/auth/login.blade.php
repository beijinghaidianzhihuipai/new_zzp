<form method="POST" action="/front/login">

    <div>
        手机号
        <input type="text" name="phone_num" value="{{ old('phone_num') }}">
    </div>

    <div>
        密码
        <input type="password" name="password" id="password">
    </div>


    <div>
        <button type="submit">登录</button>
    </div>
</form>