<div class="add">
    <div class="BaAllProducts BaAllProductsShow" id="addProducts">
        <form id="addProductsForm" autocomplete="off" >
            <input id="hidden" type="hidden">
            <div class="top">
                <div class="title"><i class="fa fa-plus fa-fw"></i></div>
                <p id="bigtext">新增管員</p>
                <a class="closeBtn" onclick="closeBtn({})"><i class="fa fa-remove"></i></a>
            </div>
            <div class="bottom">
                <div class="row">
                    <label class="col-2">管員圖片</label>
                    <div class="col-10 filebox">
                        <!--上傳圖片-->
                        <label for="addCover0" class="coverLabel">
                            <input id="addCover0" type="file" onchange="preview(this,100,100);" data-validation-engine="validate[required]">
                        </label>
                        <span>檔案大小: 2M, 寬高需大於: 100*100 px, 類型: jpg,jpeg</span>
                    </div>
                </div>
                <div class="row" id="oldAddaccount">
                    <label class="col-2" for="addaccount">管員帳號</label>
                    <div class="col-10">
                        <input class="form-control" id="addaccount" type="text" name="account" data-validation-engine="validate[required]">
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addname">管員姓名</label>
                    <div class="col-10">
                        <input class="form-control" id="addname" type="text" name="name" data-validation-engine="validate[required]">
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addPassword">管員密碼</label>
                    <div class="col-10 password" id="addPassword">
                        <input class="form-control" type="password" data-validation-engine="validate[required,onlyLetterNumber,minSize[4]]">
                        <i class="fa fa-eye-slash"></i>
                    </div>
                </div>
                <div class="row" >
                    <label class="col-2" for="aginPassword">密碼確認</label>
                    <div class="col-10 password" id="aginPassword">
                        <input class="form-control" type="password" data-validation-engine="validate[required,funcCall[aginpassword]]">
                        <i class="fa fa-eye-slash"></i>
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addemail">電子郵件</label>
                    <div class="col-10">
                        <input class="form-control" id="addemail" type="email" name="email" data-validation-engine="validate[required]">
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
