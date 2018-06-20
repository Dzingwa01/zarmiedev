@extends('order_processing')
@section('content')
 <div class="container" style="margin-top:8em">
      
    <div class="row" >
       
          <div class="col-sm-8">
            <form id="bread_selection" >
              <fieldset>
                <legend>Bread Choice & Amount</legend>
                <div  id='bread_choice_form'>
                  <div class="row">
                    <div class="col-sm-6" >
                      <div id="bread_choices" style="margin-left:2em;">
                        <p >
                          <input name="group01" class="bread" type="radio" id="white_bread" value="White Bread" required/>
                          <label for="white_bread">White Bread</label>
                        </p>
                        <p>
                          <input name="group01" class="bread" type="radio" value="Brown Bread" id="brown_bread" />
                          <label for="brown_bread" >Brown Bread</label>
                        </p>
                        <p>
                          <input name="group01" class="bread" value="Whole Wheat" type="radio" id="whole_wheat" />
                          <label for="whole_wheat">Whole Wheat Bread</label>
                        </p>
                        <div style="margin-left:2em;">
                          <input name="num_people" type="number" id="num_people"  placeholder="Enter Amount" style="display: inline-block;width: 180px;" required/>
                        </div>
                        
                        <p>
                          <input name="group1" type="radio" value="Toast" id="toast" required/>
                          <label for="toast">Toast</label>
                        </p>
                        <p>
                          <input name="group1" type="radio" value="No Toast" id="no_toast" />
                          <label for="no_toast">No Toast</label>
                        </p>
                      </div>
                    </div>
                    
                  </div>
                </div>
                   <div class="row">
                <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                   <button id='bread_back' class="btn waves-effect waves-light">Back</button>
                 </div>
                 
                  <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                    <button id='bread_next' class="btn waves-effect waves-light">Next</button>
                  </div>
                </div>
                 
              </fieldset>
            </form>
          </div>
          <div class="col-sm-4">
          <form>
              <fieldset>
                <legend>Order Cart</legend>
                <div id='type'></div>
                <div id ='choice'>
                </div>
                
                <div id ='item_bread'>
                </div>
                <div id ='item_amount'>
                </div>
                 <div id ='item_prize'></div>
                <div id ='item_toast'>
                </div>
                
              </fieldset>
            </form>
          </div>
        </div>
       
  </div>
 
  <script>
  <?php $menu_items = json_encode($menu_items);?>
  var item_number = sessionStorage.getItem('item_number_1');
  $(document).ready(function(){
      var menu_items = {!!$menu_items!!};
      console.log(menu_items);
        $.each(menu_items, function(idx,obj){
          if(item_number == obj.item_number){
            var name_cur = obj.item_name;
            sessionStorage.setItem('item_name',name_cur);
             $('#choice').append('<h6><b>Choice - </b>'+sessionStorage.getItem('item_name')+'</h6>');
            $('#type').append('<h6> <b>Type - </b>'+sessionStorage.getItem('item_category')+'</h6>');
             
          }
        }); 
        $('input:radio').click(function(){
      var bread_choice = $(this).val();
      var selected_bread = '';
      var selected_toast = '';
        if(bread_choice!=="Toast" && bread_choice !=="No Toast"){
             $('#item_bread').empty();
             selected_bread = $(this).val();
             sessionStorage.setItem('bread_type',selected_bread);
             if(sessionStorage.getItem('selected_toast')!==null){
                  $('#item_bread').append('<h6><b>Bread Choice - </b>'+bread_choice + ' - ' +sessionStorage.getItem('selected_toast') + '</h6>');
             }
             else{
                  $('#item_bread').append('<h6><b>Bread Choice - </b>'+bread_choice + '</h6>');
             }
           
        }
        else{
            $('#item_bread').empty();
            selected_toast = $(this).val();
            sessionStorage.setItem('selected_toast',selected_toast);
         $('#item_bread').append('<h6><b>Bread Choice - </b>'+sessionStorage.getItem('bread_type') + ' - ' + bread_choice+'</h6>');
        }
      
  });
  
    $('#num_people').change(function(){
         $('#item_amount').empty();
         $('#item_prize').empty();
         var quantity = $('#num_people').val();
         sessionStorage.setItem('quantity',quantity);
         $('#item_amount').append('<h6> <b>Quantity - </b>'+ quantity+'</h6>');
          var item_prize = Number(sessionStorage.getItem("item_category_price")).toFixed(2);
          var total_due = item_prize*$('#num_people').val();
          sessionStorage.setItem('total_due',total_due);
          $('#item_prize').append('<h6> <b>Prize - </b>R'+total_due+'</h6>');
    });
    $("#bread_selection").on('submit',function(e){
        e.preventDefault();
       
        
    });
     $("#bread_next").on('click',function(e){
        e.preventDefault();
        var link_to = sessionStorage.getItem('item_id');
        window.location.href = '/select_ingredients_toppings/'+link_to;
        
    });
    
     $("#bread_back").on('click',function(e){
        e.preventDefault();
        var link_to = sessionStorage.getItem('item_id');
        window.location.href = '/bread_selection';
        
    });
        
  });
  
 
  </script>

@endsection