@extends('front/public/app')
@section('content')
<form name="loginform"   method="POST" action="/front/login">
        <input type="hidden" name="next" value="/">
        <input type="hidden" name="src" value="/">
        <div class="main user-page">
            <div class="ui-box user-box">
                <div class="register-box">
                    <h4>登录</h4>
                    <ul>
                        <li>
                            <label for="">账<s class="s2"></s>号：</label><input name="loginaccount" type="text" class="input">
                            <span class="info" style="width:200px;"><i></i>支持手机号、邮箱、用户名登录</span>
                        </li>
                        <li>
                            <label for="">密<s class="s2"></s>码：</label><input name="loginpassword" type="password" class="input">&nbsp;
                            <!-- a href="retrieve.jsp">忘记密码</a> -->
                            <a href="###">忘记密码</a>
                        </li>
                    </ul>
                    <div class="btn-wrap">
                        <a href="javascript:void(0);" onclick="login();" class="mid-blue-btn">登录</a>
                        <a href="###" class="side-btn">注册</a>
                    </div>
                </div>
            </div>
        </div>
    </form>





@endsection
