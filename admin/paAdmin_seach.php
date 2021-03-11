<div class="paAdmin">
    <div class="BaAllProducts ItemProducts" id="showProducts">
        <div class="ProductsNav">
            <div class="title">
                <h4>管理員</h4>
            </div>
            <div class="ProductsAdd">
                <a class="btn" onclick="openBtn({b:'add'})">
                    <i class="fa fa-plus fa-fw"></i>新增管員
                </a>
            </div>
        </div>
        <div class="ProductsContent">
            <ul class="header">
                <li>
                    <div class="adminImage">
                        <p>圖片</p>
                    </div>
                    <div class="adminAccount">
                        <p>帳號</p>
                    </div>
                    <div class="adminName">
                        <p>姓名</p>
                    </div>
                    <div class="adminEmail">
                        <p>郵件</p>
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
