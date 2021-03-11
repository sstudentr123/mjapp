<div class="modify">
    <!--新增畫面-->
    <div class="BaAllProducts BaAllProductsShow" id="addProducts">
        <form id="addProductsForm" autocomplete="off">
            <input id="hidden" type="hidden">
            <div class="top">
                <div class="title"><i class="fa fa-pencil-square-o"></i></div>
                <p id="bigtext">修改管員</p>
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
                        <input class="form-control" id="addaccount" type="text" name="account" data-validation-engine="validate[required],custom[onlyLetterNumber]">
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addname">管員姓名</label>
                    <div class="col-10">
                        <input class="form-control" id="addname" type="text" name="name" data-validation-engine="validate[required]">
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
