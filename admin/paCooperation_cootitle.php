<div class="cootitle">
    <div class="BaAllProducts BaAllProductsShow" id='addProducts'>
        <form id="addProductsForm" autocomplete="off">
            <input id="hidden" type="hidden">
            <div class="top">
                <div class="title"><i class="fa fa-plus fa-fw"></i></div>
                <p id="bigtext">修改流程標題</p>
                <a class="closeBtn" onclick="closeBtn({})"><i class="fa fa-remove"></i></a>
            </div>
            <div class="bottom">
                <div class="row">
                    <label class="col-2" for="addtitle">主標題</label>
                    <div class="col-10">
                        <input class="form-control" id="addtitle" type="text" name="title" data-validation-engine="validate[required,maxSize[4]]">
                    </div>
                </div>
                <div class="row">
                    <label class="col-2" for="addsubtitle">副標題</label>
                    <div class="col-10">
                        <input class="form-control" id="addsubtitle" type="text" name="subtitle" data-validation-engine="validate[required,maxSize[35]]">
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
