<th width="170">
    <select name="industry" id="" class="selectpicker">
        <?php if($cur_ind == 0):?>
        <option value="0" class="start">Industry</option>
        <?php endif;?>
        <option value="0">All Industry</option>
        <?php foreach($industries as $ind):?>
            <?php if($cur_ind != 0 && $cur_ind == $ind->industry_id):?>
                <option selected <?php echo $cur_ind == $ind->industry_id?'selected':''?> value="<?php echo $ind->industry_id?>"><?php echo $ind->industry_name?></option>
            <?php else: ?>
                <option <?php echo $cur_ind == $ind->industry_id?'selected':''?> value="<?php echo $ind->industry_id?>"><?php echo $ind->industry_name?></option>
            <?php endif;?>
        <?php endforeach; ?>
    </select>
</th>

<th width="170">
    <select name="location" id="" class="selectpicker">
        <?php if($cur_loc == 0):?>
        <option selected value="0" class="start">Location</option>
        <?php endif;?>
        <option value="0">All countries</option>

        <?php foreach($locations as $loc):?>
            <?php if($cur_loc != 0 && $cur_loc == $loc->location_id):?>
                <option selected value="<?php echo $loc->location_id?>"><?php echo $loc->country?></option>
            <?php else:?>
                <option value="<?php echo $loc->location_id?>"><?php echo $loc->country?></option>
            <?php endif;?>
        <?php endforeach;?>
    </select>
</th>

<script>
$(document).on('change', 'select[name=location]', function(){
    var loc = $(this).val();
    var id = 1;
    var ind = $('select[name=industry]').val();
    $.ajax({
        url: '/departments/business/pagination-business',
        data: {id:id, loc:loc, ind:ind},
        dataType: 'json',
        type: 'post',
        success: function(response){
            $('.dynamic_block').html(response.html);
            $(".selectpicker").selectpicker();
            $(".selectpicker").on('rendered.bs.select',function(e){
                $.each($('.dropdown-menu.inner'),function(){
                    var els = $(this).find('li');
                    console.log(els.length);
                    if(els.length > 8){
                        $(this).mCustomScrollbar({
                            setHeight: 252,
                            theme:"dark",
                            scrollbarPosition:"outside"
                        });  
                    }else{
                        $(this).mCustomScrollbar({
                            theme:"dark",
                            scrollbarPosition:"outside"
                        });  
                    }
                });
            });
        }
    })
})

$(document).on('change', 'select[name=industry]', function(){
    var ind = $(this).val();
    var id = 1;
    var loc = $('select[name=location]').val();
    $.ajax({
        url: '/departments/business/pagination-business',
        data: {id:id, loc:loc, ind:ind},
        dataType: 'json',
        type: 'post',
        success: function(response){
            $('.dynamic_block').html(response.html);
            $(".selectpicker").selectpicker();
                        $(".selectpicker").on('rendered.bs.select',function(e){
                $.each($('.dropdown-menu.inner'),function(){
                    var els = $(this).find('li');
                    console.log(els.length);
                    if(els.length > 8){
                        $(this).mCustomScrollbar({
                            setHeight: 252,
                            theme:"dark",
                            scrollbarPosition:"outside"
                        });  
                    }else{
                        $(this).mCustomScrollbar({
                            theme:"dark",
                            scrollbarPosition:"outside"
                        });  
                    }
                });
            });
                                    $(".selectpicker").on('changed.bs.select',function(e){
                $.each($('.dropdown-menu.inner'),function(){
                    var els = $(this).find('li');
                    console.log(els.length);
                    if(els.length > 8){
                        $(this).mCustomScrollbar({
                            setHeight: 252,
                            theme:"dark",
                            scrollbarPosition:"outside"
                        });  
                    }else{
                        $(this).mCustomScrollbar({
                            theme:"dark",
                            scrollbarPosition:"outside"
                        });  
                    }
                });
            });
        }
    })
})
</script>