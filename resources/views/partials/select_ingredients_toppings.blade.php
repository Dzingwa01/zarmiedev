@extends('order_processing')
@section('content')
 <div class="container" style="margin-top:8em">
      
    <div class="row" >
       
          <div class="col-sm-8">
              <form id="ingredients_toppings_form" col="col-md-12">
                  <fieldset>
                      <legend>Ingredients & Toppings</legend>
                      <p style="color:black;font-weight:bold;">Select ingredients</p>
                      <div class="row" style="margin-top:2em;">
                           <div id='ingredients_list'>
                               @if(count($ingredients)>0)
                                               @foreach($ingredients as $ingredient)
                                                <button id='{{$ingredient->ingredient_id}}' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select(this);" >{{$ingredient->ingredient->name}}  </button>
                                               @endforeach
                                @endif
                            </div>
                    </div>
                    <hr/>
                    <p style="color:black;font-weight:bold;">Select Toppings (*free)</p>
                    <hr/>
                    <div class="row">
                <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                   <button id='ingredient_toppings_back' class="btn waves-effect waves-light">Back</button>
                 </div>
                 
                  <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                   <button id='ingredient_toppings_next' class="btn waves-effect waves-light">Next</button>
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
                
              </fieldset>
            </form>
          </div>
        </div>
  </div>
   <script>
   
  var item_number = sessionStorage.getItem('item_name');
  $(document).ready(function(){
       $('#choice').append('<h6><b>Choice - </b>'+sessionStorage.getItem('item_name')+'</h6>');
       $('#type').append('<h6> <b>Type - </b>'+sessionStorage.getItem('item_category')+'</h6>');
        $('#item_bread').append('<h6><b>Bread Choice - </b>'+sessionStorage.getItem('bread_type') + ' - ' +sessionStorage.getItem('selected_toast') + '</h6>');
        $('#item_prize').append('<h6> <b>Prize - </b> R '+Number(sessionStorage.getItem('total_due')).toFixed(2)+'</h6>');
        $('#item_amount').append('<h6> <b>Quantity - </b>'+sessionStorage.getItem('quantity')+'</h6>');
      
    $("#ingredients_toppings_form").on('submit',function(e){
        e.preventDefault();
        
    });
    $('#ingredient_toppings_next').on('click',function(e){
        window.location.href = "{{'/address_selection'}}"; 
    });
     $("#ingredient_toppings_back").on('click',function(){
        window.location.href = "{{'/process_order'}}";
    });
        
  });
  function ingredient_select(obj){
    //   alert(obj.id);
  }
   </script>
  @endsection