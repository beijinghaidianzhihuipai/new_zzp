@extends('front/public/app')
@section('content')
        <!--
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
-->
<div id="main">
    <div class="user-center bdr8">
        <div class="uc-hd p-rel">注册</div>
        <div class="uc-bd uc-bd-pt24">



            <div class="login-status" style="display: none;">
                <img alt="" src="/UserCenter/web/images/icon-warning.gif" class="login-status-img"><span id="errorMessage" class="login-status-text"></span>
            </div>

            <div id="hasBind" class="login-status" style="display: none;">
                <div class="uc-error-ipt" style="display:none;">
                    <img alt="" src="/UserCenter/web/images/icon-warning.gif" class="login-status-img"><span class="login-status-text">请输入正确的手机号！</span>
                </div>
                <div class="uc-error-nickname">
                    <p>手机已经被绑定<span class="ownerUname"></span>，怎么办？</p>
                    <ol>
                        <li>1、更换新的手机进行绑定；</li>
                        <li>2、或者登录<span class="ownerUname"></span>，进行解除绑定；</li>
                        <li>3、如果不记得<span class="ownerUname"></span>的密码，通过手机<a class="changePass" href="javascript:;">找回密码</a>。</li>
                    </ol>
                </div>
            </div>

            <div id="no-mail-tips" class="login-status" style="display: none;">
                <div class="uc-error-ipt" style="display:none;">
                    <img alt="" src="/UserCenter/web/images/icon-warning.gif" class="login-status-img"><span class="login-status-text">请输入正确的邮箱！</span>
                </div>
                <div class="uc-error-nickname">
                    <p>邮箱已经被绑定<span class="ownerUname"></span>，怎么办？</p>
                    <ol>
                        <li>1、更换新的邮箱进行绑定；</li>
                        <li>2、或者登录<span class="ownerUname"></span>，进行解除绑定；</li>
                        <li>3、如果不记得<span class="ownerUname"></span>的密码，通过该邮箱<a class="changePass" href="javascript:;">找回密码</a>。</li>
                    </ol>
                </div>
            </div>

            <div class="tab-bd">
                <div id="mobileRegister" class="uc-form uc-form-pw">
                    <form>
                        <div class="uc-pw-block" style="border-bottom:0;">
                            <div class="uc-form-item"><label class="fl" for="">手机号</label><input type="text" id="mobile" class="uc-ipt" placeholder="请输入手机号" maxlength="20"></div><div class="uc-divider"></div>
                        </div>
                        <div class="uc-pw-block" style="border-top:0;">
                            <div class="uc-form-item uc-form-item-s"><label class="fl" for="">密码</label><input type="password" id="mobileUpass" class="uc-ipt" placeholder="请输入密码" maxlength="20">
                                <i id="mobileSwitchPass" class="ico-eye fr" show="false"></i>
                            </div>
                        </div>
                        <p class="uc-form-tips">请输入6-20个字母、数字的组合</p>
                        <div class="uc-pw-block" id="mobileVcode" style="display:none;border-bottom:0;">
                            <div class="uc-form-item uc-form-item-yzm-s"><label class="fl" for="">图形码</label><input type="text" id="mCode" class="uc-ipt" placeholder="请输入图形码" maxlength="20"><span class="yzm-pic fr"><img src="/UserCenter/page/account/ImageVcode" width="70" height="30" id="mImageVcode"></span></div>
                        </div>

                        <div class="uc-pw-block">
                            <div class="uc-form-item uc-form-item-yzm-s"><label class="fl" for="">验证码</label><input type="text" id="code" class="uc-ipt" placeholder="请输入验证码" maxlength="20"><button id="sendCode" class="btn-yzm fr" type="button">获取验证码</button></div>
                        </div>
                    </form>
                    <p class="uc-form-tips uc-form-tips-pd0 uc-form-tips-alert" id="notiMessage" style="height:14px"></p>
                </div>

                <div id="unameRegister" style="display:none" class="uc-form uc-form-pw">
                    <form>
                        <div class="uc-pw-block">
                            <div class="uc-form-item"><label class="fl" for="">用户名</label><input id="userNameR" type="text" class="uc-ipt" placeholder="请输入用户名" maxlength="20"></div>
                        </div>
                        <p class="uc-form-tips">4-20位英文、数字，不允许数字开头</p>
                        <div class="uc-pw-block">
                            <div class="uc-form-item uc-form-item-s"><label for="" class="fl">密码</label><input type="password" id="upass" class="uc-ipt" placeholder="请输入密码" maxlength="20">
                                <i id="switchPass" class="ico-eye fr" show="false"></i>
                            </div>
                        </div>

                        <div class="uc-pw-block">
                            <div class="uc-form-item uc-form-item-s">
                                <label class="fl" for="">手机号</label>
                                <input type="text" id="mobile2" class="uc-ipt" placeholder="请输入手机号" maxlength="20">
                            </div>
                        </div>
                        <p class="uc-form-tips">请输入6-20个字母、数字的组合</p>

                        <div class="uc-pw-block" id="mobileVcode2" style="display:none;border-bottom:0;">
                            <div class="uc-form-item uc-form-item-yzm-s">
                                <label class="fl" for="">图形码</label>
                                <input type="text" id="mCode2" class="uc-ipt" placeholder="请输入图形码" maxlength="20">
	                        		<span class="yzm-pic fr">
	                        			<img src="/UserCenter/page/account/ImageVcode" width="70" height="30" id="mImageVcode2">
	                        		</span>
                            </div>
                        </div>

                        <div class="uc-pw-block">
                            <div class="uc-form-item uc-form-item-yzm-s">
                                <label class="fl" for="">验证码</label>
                                <input type="text" id="code2" class="uc-ipt" placeholder="请输入验证码" maxlength="20">
                                <button id="sendCode2" class="btn-yzm fr" type="button">获取验证码</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="uc-btn"><a id="submitBtn" class="bdr8">提交</a></div>
            <div class="uc-tips">
                <p class="regist-tips">注册即视为同意<a href="###">软件产品许可使用协议</a></p>
            </div>

        </div>
        <div class="uc-ft"></div>
    </div>
</div>


@endsection