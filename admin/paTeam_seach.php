<div class="paTeam">
    <div class="BaAllProducts ItemProducts" id="showProducts">
        <div class="bottom">
            <div class="ProductsNav">
                <div class="title">
                    <h4>明郅成員內容</h4>
                </div>
                <div class="ProductsAdd">
                    <a class="btn" onclick="openBtn({b:'add'})">
                        <i class="fa fa-plus fa-fw"></i>新增成員
                    </a>
                </div>
            </div>
            <div class="ProductsContent">
                <ul class="header">
                    <li>
                        <div class="ProductsId">
                            <a onclick="clickSort(this);" class="idClass" data-o="id">id</a>
                        </div>
                        <div class="ProductsId">
                            <a onclick="clickSort(this);" class="PorderClass" data-o="Porder">順序</a>
                        </div>
                        <div class="ProductsImage">
                            <p>圖片</p>
                        </div>
                        <div class="ProductsName">
                            <p>標題</p>
                        </div>
                        <div class="ProductsPrice">
                            <p>副標</p>
                        </div>
                        <div class="ProductsPrice">
                            <p>內容</p>
                        </div>
                        <div class="ProductsStatus">
                            <p>狀態</p>
                        </div>
                        <div class="ProductsModify">
                            <p>動作</p>
                        </div>
                    </li>
                    <li id="notData">
                        <h2>查無資料</h2>
                    </li>
                </ul>
                <ul id="ProductsContent">

                </ul>
            </div>
            <div class="ProductsPage">
                <ul class="list-inline" id="ProductsPage"></ul>
            </div>
        </div>
    </div>
</div>

