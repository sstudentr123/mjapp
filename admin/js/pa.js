function $_GET(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function hasCustonClass(obj) {
    if(obj.hasClass('active')){
        obj.removeClass('active');
    }else{
        obj.addClass('active');
    }
}
function pnFn(option) {
    var pn; //筆數
    if(option.a=='paAdmin'){
        pn = 6;
    }else if(option.a=='paCase'){
        pn = 6;
    }else if(option.a=='paTeam'){
        pn = 6;
    }else if(option.a=='paCooperation'){
        pn = 3;
    }
    return pn;
}
function sort() {
    //拖移
    var dragged; // 保存拖動元素的引用（ref.），就是拖動元素本身
    // 當開始拖動一個元素或一個選擇文本的時候 dragstart 事件就會觸發（設定拖動資料和拖動用的影像，且當從 OS 拖動檔案進入瀏覽器時不會觸發）
    document.addEventListener('dragstart', function(event) {
        dragged = event.target;
        // event.target.style.backgroundColor = 'rgba(240, 240, 240, 0.5)';
    }, false);

    // 不論結果如何，拖動作業結束當下，被拖動元素都會收到一個 dragend 事件（當從 OS 拖動檔案進入瀏覽器時不會觸發）
    document.addEventListener('dragend', function(event) {
        // 重置樣式
        // event.target.style.backgroundColor = '#222222';
        dragged.style.background = '';
    }, false);

    // 當一個元素或者文本被拖動到有效放置目標 dragover 事件就會一直觸發（每隔幾百毫秒）
    // 絕大多數的元素預設事件都不准丟放資料，所以想要丟放資料到元素上，就必須取消預設事件行為
    // 取消預設事件行為能夠藉由呼叫 event.preventDefault 方法
    document.addEventListener('dragover', function(event) {
        // 阻止預設事件行為
        event.preventDefault();
    }, false);

    // 當拖動的元素或者文本進入一個有效的放置目標 dragenter 事件就會觸發
    document.addEventListener('dragenter', function(event) {
        // 當拖動的元素進入可放置的目標（自訂符合條件），變更背景顏色
        // 自訂條件：class 名稱 && 不是本身的元素
        if (event.target.parentNode.className == 'data' &&
            dragged !== event.target.parentNode) {
            dragged.style.background = 'rgba(240, 240, 240, 0.5)';

            // 判斷向下或向上拖動，來決定在元素前或後插入元素
            if (dragged.rowIndex < event.target.parentNode.rowIndex) {
                event.target.parentNode.parentNode.insertBefore(dragged, event.target.parentNode.nextSibling);
            }
            else {
                event.target.parentNode.parentNode.insertBefore(dragged, event.target.parentNode);
            }
        }
    }, false);

    // 當拖動的元素或者文本離開有效的放置目標 dragleave 事件就會觸發
    document.addEventListener('dragleave', function(event) {

        // 當拖動元素離開可放置目標節點，重置背景
        // 自訂條件：class 名稱 && 不是本身的元素
        if (event.target.parentNode.className == 'data' &&
            dragged !== event.target.parentNode) {
            // 當拖動元素離開可放置目標節點，重置背景
            event.target.parentNode.style.background = '';
        }
    }, false);

    // 當丟放拖動元素到拖拉目標區時 drop 事件就會觸發；此時事件處理器可能會需要取出拖拉資料並處理之
    // 這個事件只有在被允許下才會觸發，如果在使用者取消拖拉操作時，如按 ESC 鍵或滑鼠不是在拖拉目標元素上，此事件不會觸發
    document.addEventListener('drop', function(event) {
        /*
         * AJAX Update DB
         */
        var id = document.querySelectorAll('.id');
        var data = [];  // 儲存所有 ID

        for (var i = 0, len = id.length; i < len; i++) {
            // 取得所有 ID 並存為 array
            data.push(id[i].innerHTML);
            // 重新排序表格 Sort 數值
            id[i].parentNode.querySelector('.sort').innerHTML = (i+1);
        }
        $.get('./?a='+$_GET('a')+'&b=sort', {"data": data});
    }, false);
}
//分頁
function pageLine(option){
    var p = option.p;
    var pn = option.pn;
    var t = option.t;
    var e = option.e || '';
    var o = option.o || '';
    var $row = '';
    var $active = '';
    var $Total = Math.ceil(t/pn);// 總頁數

    if(p>=2){
        $row += '<li><a onclick="openBtn({b:\'seach\',p:'+(p*1-1)+',e:\''+e+'\',o:\''+o+'\'});">PREV</a></li>';
    }
    if($Total<6){
        for(var $i=1; $i<=$Total; $i++) {
            if ($i == p) $active=' class="active"';
            $row += '<li'+$active+'><a onclick="openBtn({b:\'seach\',p:'+$i+',e:\''+e+'\',o:\''+o+'\'});">'+$i+'</a></li>';
            $active = '';
        }
    }else{
        var s = p-1;
        var e = p*1+1;

        if(p>2){
            $row += '<li><a class="no">...</a></li>';
        }

        if(p==1){
            s=1;
            e+=1;
        }
        if(p==$Total){
            s-=1;
            e= $Total;
        }
        for(var $i=s; $i<=e; $i++) {
            if ($i == p) $active=' class="active"';
            $row += '<li'+$active+'><a onclick="openBtn({b:\'seach\',p:'+$i+',e:\''+e+'\',o:\''+o+'\'});">'+$i+'</a></li>';
            $active = '';
        }

        if(p<$Total-1){
            $row += '<li><a class="no">...</a></li>';
        }

    }

    if(p<$Total){
        $row += '<li><a onclick="openBtn({b:\'seach\',p:'+(p*1+1)+',e:\''+e+'\',o:\''+o+'\'});">NEXT</a></li>';
    }

    $("#ProductsPage").html($row);
}

//自訂Password驗證
function aginpassword(field, rules, i, options) {
    // console.log(field, rules, i, options);
    if (field.val() != $('#addPassword').find('input').val()) {
        // this allows the use of i18 for the error msgs
        return options.allrules.equals.alertText;
    }
}
function showPassword(obj) {
    var $obj = $('#'+obj);
    if(!$obj){
        return;
    }
    var $passwordBtn = $obj.find('i');
    var $passwordInput =$obj.find('input');
    $passwordBtn.on('click',function () {
        if($(this).hasClass('fa fa-eye')){
            $passwordInput.attr('type','password');
            $(this).attr('class','fa fa-eye-slash');
        }else{
            $passwordInput.attr('type','text');
            $(this).attr('class','fa fa-eye');
        }
    })
}

//圖片上傳
function preview(input,imgWidth,imgHight) {
    var imgSize = imgSize || 2097152;
    var imgWidth = imgWidth || 720;
    var imgHight = imgHight || 600;

    var file = input.files[0];
    var type = file.type.split('/')[1];//類型
    var fileReader = new FileReader();
    var img = new Image();
    var canvas = document.createElement("canvas");
    var context = canvas.getContext("2d");

    fileReader.readAsDataURL(file);//讀取檔案內容,以DataURL格式回傳結果
    fileReader.onload = function(event){//讀取完後執行的動作
        img.src = event.target.result;
        img.onload=function(){
            console.log()
            //判斷圖片尺寸,圖片大小,圖片類型
            if(this.width>=imgWidth && this.height>=imgHight && file.size<imgSize && type =='jpeg' || type =='jpg'){
                canvas.width = imgWidth;
                canvas.height = imgHight;
                var imageWidth = img.width;
                var imageHeight = img.height;
                context.clearRect(0, 0, canvas.width, canvas.height);
                // context.drawImage(img, dx, dy, imageWidth, imageHeight);
                if(imageWidth>imageHeight){
                    context.drawImage(img, canvas.width/2-(imgHight*imageWidth/imageHeight)/2, 0, imgHight*imageWidth/imageHeight, imgHight);
                }else{
                    context.drawImage(img, 0, canvas.height/2-(imgWidth*imageHeight/imageWidth)/2, imgWidth, imgWidth*imageHeight/imageWidth);
                }
                var data = canvas.toDataURL("image/jpeg", 0.8);

                var Jcrophtml = "<div class='imgdiv'>" +
                    "<img class='imgclass' src='"+data+"'>" +
                    "<i class='fa fa-times imgclose' onclick='closeImg(this);'></i>" +
                    "</div>";
                $(input).parent('label').addClass('active').after(Jcrophtml);
            }else{
                alert('錯誤:圖片大小: 2M, 圖片寬高需大於: '+imgWidth+'*'+imgHight+' px, 圖片類型: jpg,jpeg');
                closeImg();
            }
        }
    };
}
function closeImg(obj) {
    var imgdiv = $(obj).parent('.imgdiv');
    imgdiv.prev('.coverLabel').removeClass('active').find("input").val('');
    imgdiv.remove();
}
function showimg(objid,data){
    var Jcrophtml = "<div class='imgdiv'>" +
        "<img class='imgclass' src='"+data+"'>" +
        "<i class='fa fa-times imgclose' onclick='closeImg(this);'></i>" +
        "</div>";
    $(objid).parent('.coverLabel').addClass('active').after(Jcrophtml);
}

function preview2(input,imgWidth,imgHight) {
    var obj = $(input).attr('id');
    var imgSize = imgSize || 2097152;
    var imgWidth = imgWidth || 720;
    var imgHight = imgHight || 600;

    var file = input.files[0];
    var type = file.type.split('/')[1];//類型
    var fileReader = new FileReader();
    var img = new Image();

    fileReader.readAsDataURL(file);//讀取檔案內容,以DataURL格式回傳結果
    fileReader.onload = function(event){//讀取完後執行的動作
        img.src = event.target.result;
        img.onload=function(){
            //判斷圖片尺寸,圖片大小,圖片類型
            if(this.width>=imgWidth && this.height>=imgHight && file.size<imgSize && type =='jpeg' || type =='jpg'){
                var Jcrophtml =
                    "<div id='Jcrophtml'>" +
                    "<div class='Jcrophtmlbox'>" +
                    "<img id='Jcropimg' src='" + event.target.result + "'>" +
                    "<input class='btn' type='button' value='裁切圖片' onclick='canvasCut("+obj+");'/>" +
                    "</div></div>";
                //$('body').append(Jcrophtml,imgWidth,imgHight);
                $('body').append(Jcrophtml);
                //裁切
                initJcrop('Jcropimg',imgWidth,imgHight);
            }else{
                alert('錯誤:圖片大小: 2M, 圖片寬高需大於: '+imgWidth+'*'+imgHight+' px, 圖片類型: jpg,jpeg');
                cancelimg();
                return;
            }
        }
    };
}
//Jcrop
var jcrop_api;
function initJcrop(obj,w,h){
    var r = w/h;
    var nw = r*200;
    var nh = r*100;
    $('#'+obj).Jcrop({
        aspectRatio: r,
        bgOpacity: .6,
        setSelect: [ 0, 0, nw, nh ],
        boxWidth: 1800,
        boxHeight: 700
    },function(){
        jcrop_api = this;
    });
};
//canvas裁切
function canvasCut(obj){
    // console.log(obj);
    var img = document.getElementById('Jcropimg');
    var imgarray = jcrop_api.getWidgetSize();//圖片尺寸
    var canvas = document.createElement('canvas');
    var context = canvas.getContext("2d");

    var jw = $('.jcrop-holder > div').width();//範圍尺寸
    var jh = $('.jcrop-holder > div').height();//範圍尺寸
    var jt = $('.jcrop-holder > div')[0].style.top.split('px')[0];//範圍尺寸
    var jl = $('.jcrop-holder > div')[0].style.left.split('px')[0];//範圍尺寸

    canvas.width = imgarray[0];
    canvas.height = imgarray[1];
    context.drawImage(img,0,0,imgarray[0],imgarray[1]);

    var canvas2 = document.createElement('canvas');
    var context2 = canvas2.getContext("2d");
    canvas2.width = jw;
    canvas2.height = jh;
    context2.drawImage(canvas,jl,jt,jw,jh,0,0,jw,jh);

    var data = canvas2.toDataURL("image/jpeg", 0.6);

    // var objid = $(obj);
    showimg($(obj),data);


    jcrop_api.destroy();
    $('#Jcrophtml').remove();
}
function showimg2(objid,data){
    var Jcrophtml = "<div class='imgdiv'>" +
        "<img class='imgclass' src='"+data+"'>" +
        "<i class='fa fa-times imgclose' onclick='cancelimg();'></i>" +
        "</div>";
    $(objid).hide().after(Jcrophtml);
}
function cancelimg(){
    $('.filebox').find("input").val('').show().next('.imgdiv').remove();
}
//圖片大小
//function format_float(num, pos) {
//    var size = Math.pow(10, pos);
//    return Math.round(num * size) / size;
//}
//canvas信息
//function canvasurl(){
//    var data = canvas.toDataURL();
//    // dataURL 的格式为 “data:image/png;base64,****”,逗号之前都是一些说明性的文字，我们只需要逗号之后的就行了
//    data = data.split(',')[1];
//    data = window.atob(data);
//    var ia = new Uint8Array(data.length);
//    for (var i = 0; i < data.length; i++) {
//        ia[i] = data.charCodeAt(i);
//    };
//    // canvas.toDataURL 返回的默认格式就是 image/png
//    var blob = new Blob([ia], {type:"image/png"});
//    return blob;
//}

//選單
function leftNav(option){
    var $leftNav = $('#leftNav');
    var $secondA = $leftNav.find('.second>a');
    var $close = $leftNav.find('.close');
    var f = $leftNav.find('.first');
    //active
    leftNavActive({});

    //第一層
    f.on('click',function (e) {
        e.preventDefault();
        e.stopPropagation();
        var a = $(this).attr('href');
        var li = $(this).parent('li');
        if(!li.hasClass('active')){
            leftNavActive({a:a});
        }
    })
    //有二層
    $secondA.on('click',function(){
        hasCustonClass($(this));
    });
    //摺疊選單
    $close.on('click',function(){
        hasCustonClass($leftNav);
    });
    //上一頁
    window.addEventListener('popstate', function(evt){
        leftNavActive({t:'y'});
    });
    //排序
    sort();

}
function leftNavActive(option) {
    var $first = $('#leftNav').find('.first');
    var a = option.a || $_GET('a');
    var t = option.t || 'n';
    $.each($first,function () {
        var obj = $(this).attr('href');
        var li = $(this).parent('li');
        li.removeClass('active');
        if(obj == a){
            openBtn({a:obj,b:'seach',t:t});
            li.addClass('active');
        }
    });
}
function openBtn(option) {
    var a = option.a || $_GET('a');
    var b = option.b || $_GET('b');
    var i = option.i || $_GET('i') || '';
    var p = option.p || 1;
    var m = option.m || $('#main');
    var t = option.t || 'n';
    var o = option.o || '';
    var e = option.e || '';

    //判斷是否為history.back()不須紀錄
    if(t =='n'){
        window.history.pushState({a:a,b:b},'','?a='+ a+'&b='+ b+'&i='+ i+'&p='+ p+'&o='+ o+'&e='+ e);
    }

    if(b=='seach'){
        m.load(a+'_seach'+'.php',function () {
            seach({a: a,b:'seach',i: i,p: p,m: m,o: o,e: e});
        })
    }else{
        $.get(a+'_'+b +'.php',function (data) {
            m.append(data);
            if(a=='paAdmin' && b=='add'||b=='passwordBox'){
                showPassword('addPassword');
                showPassword('aginPassword');
            }

            if(window[b]){
                window[b]({a: a,b: b,i: i,p: p,m: m});
            }
        })
    }
}
function closeBtn(option) {
    var a = option.a || $_GET('a');
    var b = option.b || $_GET('b');
    $('.'+b).remove();
    window.history.pushState({a: a,b: b},'','?a='+ a+'&b='+ b);
}

//查詢
function seach(option) {
    var pn = pnFn({a:option.a});
    var s = option.s || $('#productSeach').val();  //搜尋值
    var el = option.el || $('#ProductsContent');
    var notData = $('#notData');
    $.ajax({
        url: './?a='+ option.a+'&b='+option.a+'_'+ option.b,
        type: 'POST',
        data: {s:s,p:option.p,pn:pn,e:option.e,o:option.o},
        success: function (J) {
            var json = JSON.parse(J);
            if ( json.Result == true ) {

                //fn
                if(window[option.a + 'Seach']) {
                    window[option.a + 'Seach']({
                        json: json,
                        el: el,
                        p: option.p,
                        o: option.o,
                        e: option.e
                    });
                }

                notData.hide();
                pageLine({t:json.pageTotle,p:option.p,pn:pn,e:option.e,o:option.o});
            }else{
                notData.show();
                el.find('li').remove();
            }
        }
    })
}
function paAdminSeach(optipn){
    var $Replace = '';
    $.each(optipn.json.Data, function(k, v){
        $Replace += '<li><div class="adminImage"><img src="'+ v.Cover0+'" class="img-responsive" /></div>';
        $Replace += '<div class="adminAccount"><p>'+v.account+'</p></div>';
        $Replace += '<div class="adminName"><p>'+v.name+'</p></div>';
        $Replace += '<div class="adminEmail"><p>'+v.email+'</p></div>';
        $Replace += '<div class="ProductsModify"><a onclick="openBtn({b:\'modify\',i:'+v.id+',p:'+optipn.p+'});"  class="fa fa-pencil-square-o"></a>';
        $Replace += '<a onclick="openBtn({b:\'passwordBox\',i:'+v.id+',p:'+optipn.p+'});" class="fa fa-key"></a>';
        $Replace += '<a class="fa fa-trash-o" onclick="openBtn({b:\'delete\',i:'+v.id+',p:'+optipn.p+'});"></a></div></li>';
    });
    optipn.el.html($Replace);
}
function paCaseSeach(optipn){
    var $Replace = '';
    var $status = '';
    //顯示順序icon
    if(optipn.e=='ASC'){
        $('.'+optipn.o+'Class').removeClass('active');
    }else{
        $('.'+optipn.o+'Class').addClass('active');
    }
    $.each(optipn.json.Data, function(k, v){
        if(v.Status =="Y"){
            $status = "上架";
        }else{
            $status = "未上架";
        }
        $Replace += '<li class="data" draggable="true"><div class="id">'+v.id+'</div>';
        $Replace += '<div class="Porder sort">'+v.Porder+'</div>';
        $Replace += '<div class="Cover0"><img src="'+v.Cover0+'" class="img-responsive" /></div>';
        $Replace += '<div class="Pname"><p>'+v.Pname+'</p></div>';
        $Replace += '<div class="Url"><p>'+ v.Url+'</p></div>';
        $Replace += '<div class="Cover1"><img src="'+v.Cover1+'" class="img-responsive" /></div>';
        $Replace += '<div class="Content"><p>'+v.Content+'</p></div>';
        $Replace += '<div class="ProductsStatus"><p>'+$status+'</p></div>';
        $Replace += '<div class="ProductsModify">';
        $Replace += '<a onclick="openBtn({b:\'add\',i:'+v.id+',p:'+optipn.p+'});"  class="fa fa-plus"></a>';
        $Replace += '<a onclick="openBtn({b:\'modify\',i:'+v.id+',p:'+optipn.p+'});"  class="fa fa-pencil-square-o"></a>';
        $Replace += '<a class="fa fa-trash-o" onclick="openBtn({b:\'delete\',i:'+v.id+',p:'+optipn.p+'});"></a></div></li>';
    });
    optipn.el.html($Replace);
}
function paTeamSeach(optipn){
    var $Replace = '';
    var $status = '';
    //顯示順序icon
    if(optipn.e=='ASC'){
        $('.'+optipn.o+'Class').removeClass('active');
    }else{
        $('.'+optipn.o+'Class').addClass('active');
    }
    $.each(optipn.json.Data, function(k, v){
        if(v.Status =="Y"){
            $status = "上架";
        }else{
            $status = "未上架";
        }
        $Replace += '<li class="data" draggable="true"><div class="id">'+v.id+'</div>';
        $Replace += '<div class="Porder sort">'+v.Porder+'</div>';
        $Replace += '<div class="Cover"><img src="'+v.Cover0+'" class="img-responsive" /></div>';
        $Replace += '<div class="titles"><p>'+v.title+'</p></div>';
        $Replace += '<div class="subtitle"><p>'+ v.subtitle+'</p></div>';
        $Replace += '<div class="Content"><p>'+v.Content+'</p></div>';
        $Replace += '<div class="ProductsStatus"><p>'+$status+'</p></div>';
        $Replace += '<div class="ProductsModify">';
        $Replace += '<a onclick="openBtn({b:\'add\',i:'+v.id+',p:'+optipn.p+'});"  class="fa fa-plus"></a>';
        $Replace += '<a onclick="openBtn({b:\'modify\',i:'+v.id+',p:'+optipn.p+'});" class="fa fa-pencil-square-o"></a>';
        $Replace += '<a class="fa fa-trash-o" onclick="openBtn({b:\'delete\',i:'+v.id+',p:'+optipn.p+'});"></a></div></li>';
    });
    optipn.el.html($Replace);
}
function paCooperationSeach(optipn){
    var $v = '';
    var $Replace = '';
    var $status = '';
    var $titleContent = $('#titleContent');
    $.each(optipn.json.Data, function(k, v){
        if(v.Status =="Y"){
            $status = "上架";
        }else{
            $status = "未上架";
        }
        $Replace += '<li><div class="Porder">'+v.Porder+'</div>';
        $Replace += '<div class="Cover"><img src="'+v.Cover0+'" class="img-responsive" /></div>';
        $Replace += '<div class="Content"><p>'+v.Content+'</p></div>';
        $Replace += '<div class="ProductsStatus"><p>'+$status+'</p></div>';
        $Replace += '<div class="ProductsModify">';
        $Replace += '<a onclick="openBtn({b:\'add\',i:'+v.id+',p:'+optipn.p+'});"  class="fa fa-plus"></a>';
        $Replace += '<a onclick="openBtn({b:\'modify\',i:'+v.id+',p:'+optipn.p+'});" class="fa fa-pencil-square-o"></a>';
        $Replace += '<a class="fa fa-trash-o" onclick="openBtn({b:\'delete\',i:'+v.id+',p:'+optipn.p+'});"></a></div></li>';
    });
    optipn.el.html($Replace);

    $.each(optipn.json.Title, function(k, v){
        $v += '<li><div class="titles"><p>'+v.title+'</p></div>';
        $v += '<div class="subtitle"><p>'+v.subtitle+'</p></div>';
        $v += '<div class="ProductsModify"><a onclick="openBtn({a:\''+$_GET('a')+'\',b:\'cootitle\',i:'+v.id+'});" class="fa fa-pencil-square-o"></a></div></li>';
    });
    $titleContent.html($v);
}

//新增
function porder(option) {
    if($('#addPorder').length==1){
        $.ajax({
            url: './?a='+option.a+'&b=porder',
            type: 'POST',
            data: {},
            success: function (J) {
                var Json = JSON.parse(J);
                if ( Json.Result == true ) {
                    var $Data = Json.Data;
                    $('#addPorder').val($Data[0].Porder*1+1);
                }
            }
        });
    }
}
function add(option){
    //複製
    if(option.i){
        modify(option,function () {
            porder(option);
        });
    }else{
        porder(option);
    }
}

//修改顯示
function cootitle(option) {
    modify({a:option.a,c:'title',i:option.i,m:option.m})
}
function modify(option,fn){
    var b = option.c || 'one';
    $.ajax({
        url: './?a=' + option.a + '&b='+b+'&id=' + option.i,
        type: 'POST',
        data: {},
        success: function (J) {
            var Json = JSON.parse(J);
            if (Json.Result == true) {
                var $Data = Json.Data;

                //內容
                option.m.find('input[type=text],input[type=email],textarea[name=Content]').each(function () {
                    var $name = $(this).attr('name');
                    $('#add' + $name).val($Data[$name]);
                });

                //縮圖
                if ($Data.Cover0) {
                    showimg('#addCover0', $Data.Cover0);
                }
                //多縮圖
                if ($Data.Cover1) {
                    showimg('#addCover1', $Data.Cover1);
                }

                //上架
                if ($Data.Status == 'Y') {
                    option.m.find('#modifystatusN').prop('checked', false);
                    option.m.find('#modifystatusY').prop('checked', true);
                } else {
                    option.m.find('#modifystatusN').prop('checked', true);
                    option.m.find('#modifystatusY').prop('checked', false);
                }

                //fn
                fn && fn();
                // if (window[option.a + 'Modify']) {
                //     window[option.a + 'Modify']();
                // }
            }
        }
    });
}

//排序
function clickSort(obj) {
    var o = $(obj).data('o');
    if($_GET('e')=='DESC'){
        openBtn({b:'seach',o:o,e:'ASC'});
    }else{
        openBtn({b:'seach',o:o,e:'DESC'});
    }
}

//新增/修改/刪除送出
function formSubmit(){
    var $addProductsForm = $('#addProductsForm');
    $addProductsForm.validationEngine('detach');
    $addProductsForm.validationEngine('attach', {
        onValidationComplete: function(form, status){
            if (status == true) {
                var fd = new FormData($addProductsForm[0]);
                var a = $_GET('a');
                var b = $_GET('b');
                var p = $_GET('p')||1;
                var id = $_GET('i');
                var pn = pnFn({a:a});
                var imgs = $('.imgclass');
                var $addPassword = $('#addPassword');
                //密碼
                if($addPassword.length!=0){
                    fd.append('password',$addPassword.find('input').val());
                }
                //上傳圖片路徑
                for(var i=0;i<imgs.length;i++){
                    fd.append('Cover'+[i],imgs.eq(i).attr("src"))
                }
                var xhr = new XMLHttpRequest();
                xhr.open("POST",'./?a='+a+'&b='+a+'_'+b+'&id='+id+'&p='+p+'&pn='+pn,true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        var Json = JSON.parse(xhr.responseText);

                        if(b=='seachBox'){
                            var el = $('#ProductsContent');
                            var notData = $('#notData');
                            if(Json.Result == true){
                                if(window[a + 'Seach']) {
                                    window[a + 'Seach']({
                                        json: Json,
                                        el: el,
                                        a: a,
                                        p: p
                                    });
                                }
                                notData.hide();
                                pageLine({t:Json.pageTotle,a:a,p:p,pn:pn});
                            }else{
                                notData.show();
                                $("#ProductsPage").html('');
                                el.find('li').remove();
                            }
                            closeBtn({});
                            return;
                        }

                        if(Json.Result == true){
                            closeBtn({});
                            openBtn({b:'seach',p:p});
                            // seach({a:a,p:'seach',p:p});
                        }else{
                            $('.error').html(Json.Message);
                        }

                    }
                }
                xhr.send(fd);
            }
        },
        validationEventTrigger: '',
        promptPosition:"bottomLeft",
        scroll:false,
        autoHidePrompt:true,
        autoHideDelay:2000
    });
}

$(function () {
    leftNav();
});

