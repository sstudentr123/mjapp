<div class="passwordBox">
    <!--修改密碼畫面-->
    <div class="BaAllProducts BaAllProductsShow" id="addProducts">
        <form id="addProductsForm" autocomplete="off">
            <input id="hidden" type="hidden">
            <div class="top">
                <div class="title"><i class="fa fa-key"></i></div>
                <p id="bigtext">重設密碼</p>
                <a class="closeBtn" onclick="closeBtn({})"><i class="fa fa-remove"></i></a>
            </div>
            <div class="bottom">
                <input type="text" style="display: none;">
                <div class="row">
                    <label class="col-2" for="addPassword">新密碼</label>
                    <div class="col-10  password" id="addPassword">
                        <input class="form-control" type="password" data-validation-engine="validate[required,onlyLetterNumber,minSize[4]]">
                        <i class="fa fa-eye-slash"></i>
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="aginPassword">密碼確認</label>
                    <div class="col-10 password" id="aginPassword">
                        <input class="form-control" type="password" data-validation-engine="validate[required,funcCall[aginpassword]]" autocomplete="new-password">
                        <i class="fa fa-eye-slash"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                        <p class="error" style="color: red;"></p>
                    </div>
                </div>
                 <div class="row">
                     <div class="col-12">
                         <input class="btn btn-blue" type="submit" value="確認送出" onclick="formSubmit()">
                     </div>
                </div>
            </div>
        </form>
    </div>
</div>
