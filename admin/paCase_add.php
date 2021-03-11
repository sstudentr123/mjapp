<div class="add">
    <div class="BaAllProducts BaAllProductsShow" id="addProducts">
        <form id="addProductsForm" autocomplete="off">
            <input id="hidden" type="hidden">
            <div class="top">
                <div class="title"><i class="fa fa-plus fa-fw"></i></div>
                <p id="bigtext">新增案例</p>
                <a class="closeBtn" onclick="closeBtn({})"><i class="fa fa-remove"></i></a>
            </div>
            <div class="bottom">
                <div class="row">
                    <label class="col-2">封面</label>
                    <div class="col-10 filebox">
                        <label for="addCover0" class="coverLabel">
                            <input id="addCover0" type="file" onchange="preview(this,750,450);" data-validation-engine="validate[required]">
                        </label>
                        <span>檔案大小: 2M, 寬高需大於: 750*450 px, 類型: jpg,jpeg</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addPorder">順序</label>
                    <div class="col-10">
                        <input class="form-control" id="addPorder" type="text" name="Porder" data-validation-engine="validate[required],custom[number]">
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addPname">名稱</label>
                    <div class="col-10">
                        <input class="form-control" id="addPname" type="text" name="Pname" data-validation-engine="validate[required]">
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addPrice">連結</label>
                    <div class="col-10">
                        <input class="form-control" id="addUrl" type="text" name="Url" data-validation-engine="validate[required]]" value="#">
                    </div>
                </div>
                <div class="row">
                    <label class="col-2">圖片</label>
                    <div class="col-10 filebox">
                        <label for="addCover1" class="coverLabel">
                            <input id="addCover1" type="file" onchange="preview(this,750,450);">
                        </label>
                        <span>檔案大小: 2M, 寬高需大於: 750*450 px, 類型: jpg,jpeg</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addContent">內容</label>
                    <div class="col-10">
                        <textarea class="form-control textareatinymce" id="addContent" rows="8" name="Content"></textarea>
                    </div>
                </div>
                <div class="row">
                    <label class="col-2">狀態</label>
                    <div class="col-10 modifystatus" id="addstatus">
                        <label>
                            <input id="modifystatusY" type="radio" name="Status" value="Y" checked>上架
                        </label>
                        <label>
                            <input id="modifystatusN" type="radio" name="Status" value="N">下架
                        </label>
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
