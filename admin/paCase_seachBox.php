<div class="seachBox">
    <div class="BaAllProducts BaAllProductsShow" id="addProducts">
        <form id="addProductsForm" autocomplete="off">
            <input id="hidden" type="hidden">
            <div class="top">
                <div class="title"><i class="fa fa-search fa-fw"></i></div>
                <p id="bigtext">案例查詢</p>
                <a class="closeBtn" onclick="closeBtn({})"><i class="fa fa-remove"></i></a>
            </div>
            <div class="bottom">
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
                    <label class="col-2" for="seachText">關鍵字</label>
                    <input class="col-10 form-control" id="seachText" type="text"  name="seachText">
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