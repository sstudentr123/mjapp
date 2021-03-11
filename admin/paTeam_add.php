<div class="add">
    <div class="BaAllProducts BaAllProductsShow" id="addProducts">
        <form id="addProductsForm" autocomplete="off">
            <input id="hidden" type="hidden">
            <div class="top">
                <div class="title"><i class="fa fa-plus fa-fw"></i></div>
                <p id="bigtext">新增成員</p>
                <a class="closeBtn" onclick="closeBtn({})"><i class="fa fa-remove"></i></a>
            </div>
            <div class="bottom">
                <div class="row filerow">
                    <label class="col-2">圖片</label>
                    <div class="col-10 filebox">
                        <label for="addCover0" class="coverLabel">
                            <input id="addCover0" type="file" onchange="preview(this,260,155);" data-validation-engine="validate[required]">
                        </label>
                        <span>檔案大小: 2M, 寬高需大於: 260*155 px, 類型: jpg,jpeg</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addPorder">順序</label>
                    <div class="col-10">
                        <input class="form-control" id="addPorder" type="text" name="Porder" data-validation-engine="validate[required],custom[number]">.
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addtitle">標題</label>
                    <div class="col-10">
                        <input class="form-control" id="addtitle" type="text" name="title" data-validation-engine="validate[required]">
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addsubtitle">副標</label>
                    <div class="col-10">
                        <input class="form-control" id="addsubtitle" type="text" name="subtitle" data-validation-engine="validate[required]">
                    </div>
                </div>

                <div class="row">
                    <label class="col-2" for="addContent">內容</label>
                    <div class="col-10">
                        <textarea class="form-control textareatinymce" id="addContent" rows="8" name="Content" data-validation-engine="validate[required]"></textarea>
                    </div>
                </div>
                <div class="row">
                    <label class="col-2">狀態</label>
                    <div class="col-10 modifystatus" id="addstatus">
                        <label>
                            <input id="modifystatusY" type="radio" name="status" value="Y" checked>上架
                        </label>
                        <label>
                            <input id="modifystatusN" type="radio" name="status" value="N">下架
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


