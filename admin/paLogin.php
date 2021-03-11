<!DOCTYPE html>
<html>
    <head>
        <?php
            require_once 'paInHead.php';
        ?>
    </head>
    <body>
        <div class="maloginPage">
            <form id="maloginForm" autocomplete="off">
                <div class="top">
                    <h3 class="title-md">登入後台</h3>
                </div>
                <div class="bottom">
                    <div class="item">
                        <label class=" for="account">帳號</label>
                        <input id="account" type="text" class="form-controls" name="account" data-validation-engine="validate[required]" value="admin">
                    </div>
                    <div class="item password" id="password">
                        <label for="inputPassword">密碼</label>
                        <input class="form-controls" type="password"  autocomplete="new-password" data-validation-engine="validate[required]" value="admin">
                        <i id="showPasswordBtn" class="fa fa-eye-slash" aria-hidden="true"></i>
                    </div>
                    <div class="item">
                        <p class="error" style="color: red;"></p>
                    </div>
                    <div class="item linkBtn">
                        <a class="goHome" href="../">回到首頁?</a>
                       <input class="btn active" type="submit" value="登入">
                    </div>
                </div>
            </form>
        </div>
    </body>
    <script>

        $(function () {
            var form = $('#maloginForm');
            var $accountInput = form.find('#account');
            var $passwordInput = form.find('#password input');
            var $passwordBtn = form.find('#password i');
            var account = localStorage.getItem('account');
            var password = localStorage.getItem('password');
            // localstorage
            // if(account && password){
            //     $accountInput.val(account);
            //     $passwordInput.val(password);
            // }else{
            //     form.find('input[type="text"],input[type="password"]').each(function () {
            //         $(this).attr("value","");
            //     })
            // }
            //showPassword
            $passwordBtn.on('click',function () {
                if($(this).hasClass('fa fa-eye')){
                    $passwordInput.attr('type','password');
                    $(this).attr('class','fa fa-eye-slash');
                }else{
                    $passwordInput.attr('type','text');
                    $(this).attr('class','fa fa-eye');
                }
            })
            //sead form
            form.submit(function(){}).validationEngine({
                onValidationComplete: function(form, status) {
                    $('.error').html('');
                    if (status == true) {
                        $.ajax({
                            url: './?a=login',
                            type: 'POST',
                            data: {
                                account: $accountInput.val(),
                                password: $passwordInput.val()
                            },
                            success: function (J) {
                                var Json = JSON.parse(J);
                                if ( Json.Result == true ) {
                                    localStorage.clear();
                                    localStorage.setItem('account', $accountInput.val());
                                    localStorage.setItem('password',  $passwordInput.val());
                                    // window.location.replace('./?a=paAdmin&b=seach');
                                    window.location.replace('./?a=paAdmin&b=seach');
                                }else{
                                    $('.error').html(Json.Message);
                                }
                            }
                        })
                    }
                },
                validationEventTrigger: '',
                promptPosition:"bottomLeft",
                scroll:false,
                autoHidePrompt:true,
                autoHideDelay:2000
            });
        });


    </script>
</html>
