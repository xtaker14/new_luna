 
<style> 
</style>

<div class="col-md-12">
	<div class="card mb-3">
		<div class="card-header bg-white"><h5><b>Game Trade Log</b></h5></div>
		<div class="card-body">
            <?php 
                $this->load->helper("form");
            ?>
            <form id="form_filter" method="GET" action="">
            <div class="row" style="margin-bottom:15px;">
                <div class="col-2">
                    Pilih Tanggal
                </div>
                <div class="col-3">
                    <input placeholder="--Pilih Tanggal--" id="input_spesifik_hari" name="input_spesifik_hari" type="text" class="form-control" value="<?= $val_day; ?>"> 
                </div> 
            </div>
            <div class="row" style="margin-bottom:15px;">
                <div class="col-2">
                    Pilih Kategori
                </div>
                <div class="col-3">
                    <select id="input_kategori" name="input_kategori" class="form-control">
                        <option <?= $category == 'all' ? 'selected' : ''; ?> value="all">--All--</option> 
                        <option <?= $category == 'iss' ? 'selected' : ''; ?> value="iss">Item Shop Storage</option> 
                        <option <?= $category == 'ti' ? 'selected' : ''; ?> value="ti">Trade Item</option> 
                        <option <?= $category == 'tg' ? 'selected' : ''; ?> value="tg">Trade Gold</option> 
                        <option <?= $category == 'bi' ? 'selected' : ''; ?> value="bi">Buy Item</option> 
                        <option <?= $category == 'si' ? 'selected' : ''; ?> value="si">Sell Item</option> 

                        <option <?= $category == 'di' ? 'selected' : ''; ?> value="di">
                            Drop Item (Remove Item)
                        </option> 
                        <option <?= $category == 'dim' ? 'selected' : ''; ?> value="dim">
                            Drop Item (Get Item From Monster)
                        </option> 
                        <option <?= $category == 'bpu' ? 'selected' : ''; ?> value="bpu">
                            Bank (Pick Up / Mengambil)
                        </option> 
                        <option <?= $category == 'bpi' ? 'selected' : ''; ?> value="bpi">
                            Bank (Put In / Menaruh)
                        </option> 

                        <option <?= $category == 'bv' ? 'selected' : ''; ?> value="bv">
                            Buy Vending
                        </option> 
                    </select>
                </div> 
            </div>

            <div class="row parent_top_gold" style="<?= $category !== 'tg' ? 'display:none;' : ''; ?> margin-bottom:15px;">
                <div class="col-2"> 
                </div>
                <div class="col-3" style="display:inherit;">
                    <input id="input_top_gold" name="input_top_gold" type="checkbox" class="form-control" value="yes" style="width:auto;" <?= $val_top_gold === 'yes' ? 'checked' : ''; ?>>
                    <div style="margin-left:10px;margin-bottom:3px;">
                        Top Gold
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom:15px;">
                <div class="col-2">
                    Username
                </div>
                <div class="col-3">
                    <?php 
                    if($username == '-empty-'){
                        $username = '';
                    }
                    ?>
                    <input placeholder="--Do not fill in to show all--" id="input_username" name="input_username" type="text" class="form-control" value="<?= $val_username; ?>"> 
                </div> 
            </div>
            <div class="row" style="margin-bottom:15px;">
                <div class="col-2">
                    Item Name
                </div>
                <div class="col-3">
                    <?php 
                    if($item_name == '-empty-'){
                        $item_name = '';
                    }
                    ?>
                    <input placeholder="--Do not fill in to show all--" id="input_item_name" name="input_item_name" type="text" class="form-control" value="<?= $val_item_name; ?>"> 
                </div> 
            </div>
            </form>
            <br> 

            <div class="row" style="margin-bottom:15px;">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="trade_table" class="table table-striped table-sm dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>    
                                    <th scope="col">LOG ID</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">From Char</th>   
                                    <th scope="col">To Char</th> 
                                    <th scope="col">Gold</th> 
                                    <th scope="col">Item</th> 
                                    <th scope="col">Tanggal</th> 
                                </tr>
                            </thead>
                            <tbody> 
                                <?php if (count($trade_log) > 0) : ?>
                                    <?php 
                                        foreach ($trade_log as $key) : 
                                        $logtype = $key['LOGTYPE'];
                                        if($key['LOGTYPE'] == 1502){
                                            // Item Shop Storage
                                            $logtype = 'Item Shop Storage';
                                        }
                                        if(
                                            $key['LOGTYPE'] == 500 && 
                                            (int)$key['CHANGEMONEY'] == 0 && 
                                            (int)$key['ITEMIDX'] > 0 
                                        ){
                                            // Trade Item
                                            $logtype = 'Trade Item';
                                        }

                                        if(
                                            $key['LOGTYPE'] == 500 && 
                                            (int)$key['CHANGEMONEY'] > 0 && 
                                            (int)$key['ITEMIDX'] == 0 
                                        ){
                                            // Trade Gold 
                                            $logtype = 'Trade Gold';
                                        }

                                        if($key['LOGTYPE'] == 200){
                                            // Buy Item
                                            $logtype = 'Buy Item';
                                        }

                                        if($key['LOGTYPE'] == 300){
                                            // Sell Item
                                            $logtype = 'Sell Item';
                                        }

                                        if($key['LOGTYPE'] == 1){
                                            // Drop Item 
                                            $logtype = 'Drop Item';
                                        }
                                        
                                        if(
                                            $key['LOGTYPE'] == 203 && 
                                            (int)$key['ITEMIDX'] > 0 && 
                                            (int)$key['ITEMDUR'] > 0 
                                        ){
                                            // Drop Item (Get Item From Monster) 
                                            $logtype = 'Drop Item<br>From Monster'; 
                                        }
                                        if(
                                            $key['LOGTYPE'] == 101 && 
                                            $key['FROMCHRNAME'] == '#Storage' 
                                        ){
                                            // Bank (Pick Up) mengambil 
                                            $logtype = 'Bank (Pick Up)'; 
                                        }
                                        if(
                                            $key['LOGTYPE'] == 100 && 
                                            $key['FROMCHRNAME'] == '#Storage' 
                                        ){
                                            // Bank (Put In) menaruh  
                                            $logtype = 'Bank (Put In)'; 
                                        }
                                        if(
                                            $key['LOGTYPE'] == 402 && 
                                            $key['CHANGEMONEY'] > 0 && 
                                            $key['ITEMIDX'] > 0
                                        ){
                                            // Buy Vending
                                            $logtype = 'Buy Vending';  
                                        }

                                        // $logtype = $key['LOGTYPE']. ' ';
                                        // $logtype .= (int)$key['CHANGEMONEY']. ' ';
                                        // $logtype .= (int)$key['ITEMIDX'];
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $key['LOGIDX']; ?>
                                            </td>
                                            <td>
                                                <?= $logtype; ?>
                                            </td>
                                            <td>
                                                <?= $key['FROMCHRNAME']; ?>
                                            </td>
                                            <td>
                                                <?= $key['TOCHRNAME']; ?>
                                            </td>
                                            <td>
                                                <?php  
                                                    if(!empty($key['CHANGEMONEY'])){
                                                        echo number_format($key['CHANGEMONEY'],0,',','.');
                                                    }else{ 
                                                        echo '-';
                                                    }
                                                ?> 
                                            </td>
                                            <td>
                                                <?php 
                                                    if($logtype == 'Buy Vending'){
                                                        if(!empty($key['QTY_VEND'])){
                                                            echo number_format($key['QTY_VEND'],0,',','.').'x ';
                                                        }
                                                    }else{
                                                        if(!empty($key['ITEMDUR'])){
                                                            echo number_format($key['ITEMDUR'],0,',','.').'x ';
                                                        }
                                                    }
                                                    if(!empty($key['ITEM_NAME'])){
                                                        echo $key['ITEM_NAME'];
                                                    }else{
                                                        if(empty($key['ITEMIDX'])){
                                                            echo '-';
                                                        }else{
                                                            echo $key['ITEMIDX'];
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    echo date('d M Y', strtotime($key['REGDATE']));
                                                    echo '<br>';
                                                    echo date('H:i:s', strtotime($key['REGDATE']));
                                                ?> 
                                            </td>
                                        </tr>
                                    <?php endforeach ?> 
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12">
                    <?= $pagination; ?>
                </div>
            </div>
        </div>
	</div>
</div> 

<script type="text/javascript"> 

const objectifyForm = (formArray) => {
    //serialize data function
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++){
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}
const delayCallEvent = (callback, ms) => {
    var timer = 0;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}
const filterDataLog = (t) =>{
    let input_spesifik_hari = $('#input_spesifik_hari').val().trim();
    
    // let input_kategori = $('#input_kategori').val().trim();
    // let input_username = $('#input_username').val().trim();

    // if(input_username.length == 0){
    //     input_username = '-empty-';
    // }

    // let link = '<?= base_url(); ?>' + 'adm/game_trade_log/'+input_spesifik_hari+'/'+input_kategori+'/'+input_username; 
    
    // window.location.href = link;

    let post_data = objectifyForm($("#form_filter").serializeArray());   
    let get_link = '?'; 
    let ar_search = [
        // 'input_spesifik_hari',
        'input_kategori',
        'input_top_gold',
        'input_username',
        'input_item_name',
    ];

    for(let i=0; i<ar_search.length; i++){
        // let key_name = ar_search[i];
        let key_name = ar_search[i].replace('input_', '');

        if($.trim(post_data[ar_search[i]]).length>0){
            if(get_link != '?'){
                get_link += '&'+key_name+'='+post_data[ar_search[i]].trim();
            }else{
                get_link += key_name+'='+post_data[ar_search[i]].trim();
            }
        }
    }

    let go_to = '<?= base_url(); ?>' + 'adm/game_trade_log/' + input_spesifik_hari + '/' + get_link;
    // alert(go_to);
    window.location.href = go_to;
}

$(document).ready(function(){  

    $('#input_spesifik_hari').datepicker({
        dateFormat:'yy-mm-dd',
    });
    $('#input_kategori').change(function(){
        let t = $(this);   
    }).change();

    $('#btn_search_kategori').click(function(){
        let t = $(this);
        let kategori = $('#input_kategori').val();
        
        // switch (kategori) { 
        //     case 'this_day':
        //         window.location.href="/adm/top_donate/today";
        //         break; 
        // }
    });

    $('#input_spesifik_hari').on('change', delayCallEvent(function (e) { 
        let t = $(this); 
        filterDataLog(t);
    }, 400));   

    $('#input_kategori').on('change', delayCallEvent(function (e) {
        let t = $(this); 
        if(t.val().trim() == 'tg'){
            $('.parent_top_gold').show();
        }else{
            $("#input_top_gold").prop('checked',false);
            $("#input_top_gold").attr('checked',false);
            $('.parent_top_gold').hide();
        }
        filterDataLog(t);
    }, 400));

    $('#input_username').on('keyup', delayCallEvent(function (e) { 
        let t = $(this); 
        filterDataLog(t);
    }, 600)); 

    $('#input_item_name').on('keyup', delayCallEvent(function (e) {
        let t = $(this); 
        filterDataLog(t);
    }, 400));

    $('#input_top_gold').on('change', delayCallEvent(function (e) {
        let t = $(this); 
        filterDataLog(t);
    }, 400));
      
    console.clear();
});   
</script>
<style>
    .btn-black{
        background-color: #353333 !important;
    } 
</style>