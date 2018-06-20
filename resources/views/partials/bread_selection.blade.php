@extends('order_processing')

@section('content')
<div class="container" style="margin-top:7em;">
    <center>
        <h5 id="choice"></h5>
    </center>
        <div class="row">
        <div id='sandwich' onclick="bread_selection(this)" class="col-sm-5 tile">
          <h5 style="margin-top:2em;">Sandwich </h5>
          <div id='sandwich_price'></div>
        </div>
        <div id='mediumsub' onclick="bread_selection(this)" class="col-sm-5 tile">
          <h5 style="margin-top:2em;">Medium Sub - 15cm  </h5>
          <div id='medium_price'></div>
        </div>
      </div>
      <div class="row">
        <div id='largesub' onclick="bread_selection(this)" class="col-sm-5 tile">
          <h5 style="margin-top:2em;">Large - 22cm </h5>
          <div id='large_price'></div>
        </div>
        <div id='wrap' onclick="bread_selection(this)" class="col-sm-5 tile">
          <h5 style="margin-top:2em;">Wrap</h5>
          <div id='wrap_price'></div>
        </div>
    </div>
</div>



<script>
 <?php $menu_items = json_encode($menu_items);?>
  var item_number = sessionStorage.getItem('item_number_1');
  $(document).ready(function(){
      var menu_items = {!!$menu_items!!};
        $.each(menu_items, function(idx,obj){
          if(item_number == obj.item_number){
            var name_cur = obj.item_name;
            sessionStorage.setItem('item_name',name_cur);
             $('#choice').append(sessionStorage.getItem('item_name'));
            $('.prizes').remove();
            $('#sandwich_price').append('<h5 class="prizes"> R'+(obj.sandwich).toFixed(2)+'</h5>');
            $('#medium_price').append('<h5 class="prizes"> R'+(obj.mediumsub).toFixed(2)+'</h5>');
            $('#large_price').append('<h5 class="prizes"> R'+(obj.largesub).toFixed(2)+'</h5>');
            $('#wrap_price').append('<h5 class="prizes"> R'+(obj.wrap).toFixed(2)+'</h5>');
           
          }
        }); 
  });
function bread_selection(obj){
    var menu_items = {!!$menu_items!!};
     var menu_items_1 = {!!$menu_items_1!!};
    var cur_id = obj.id;
    var item_number = sessionStorage.getItem('item_number_1');
     $.each(menu_items, function(idx,obj){
          if(sessionStorage.getItem('item_number_1') == obj.item_number){
             if(cur_id == 'sandwich'){
                 $.each(menu_items_1, function(idx,obj){
                     if(item_number == obj.item_number && obj.item_size_id == '1' ){
                         sessionStorage.setItem('item_category_price',obj.prize);
                      sessionStorage.setItem('item_category','Sandwich');
                      sessionStorage.setItem('item_id',obj.id);
                     }
                 });
            }
          }
            else if(cur_id == 'mediumsub'){
                 $.each(menu_items_1, function(idx,obj){
                if(item_number == obj.item_number && obj.item_size_id == '2' ){
                sessionStorage.setItem('item_category_price',obj.prize);
              sessionStorage.setItem('item_category','Medium Sub');
               sessionStorage.setItem('item_id',obj.id);
                }
                
                 });
            }
            else if(cur_id == 'largesub'){
                 $.each(menu_items_1, function(idx,obj){
            if(item_number == obj.item_number && obj.item_size_id == '3' )
            {
                 sessionStorage.setItem('item_category_price',obj.prize);
              sessionStorage.setItem('item_category','Large Sub');
               sessionStorage.setItem('item_id',obj.id);
            }
               
            });
            }
            else if(cur_id == 'wrap'){
                 $.each(menu_items_1, function(idx,obj){
            if(item_number == obj.item_number && obj.item_size_id == '4' ){
                sessionStorage.setItem('item_category_price',obj.prize);
              sessionStorage.setItem('item_category','Wrap');
               sessionStorage.setItem('item_size_id',obj.id);
            }
        });
           
          }
        }); 
    console.log(sessionStorage.getItem('item_id'));
    window.location.href = "{{'process_order'}}";
    
  }
  
</script>

@endsection