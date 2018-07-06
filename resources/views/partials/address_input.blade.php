@extends('order_processing')
@section('content')
 <div class="container" style="margin-top:8em">
      
    <div class="row" >
       
          <div class="col-sm-8">
              <h5>Enter Address for delivery</h5>
              <form id="address_form" col="col-md-10">
                  
                  <div class="row">
                    <input id='address' type='text'  placeholder="Enter your address" required>
                  </div>
                  <div class="row" style="margin-top:1em;">
                    <div  id="map_canvas"></div>
                  </div>
                    <div class="row" style="margin-top:2em;">
                     <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                   <button id='address_back' class="btn waves-effect waves-light">Back</button>
                  </div>
                  <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                   <button id='address_next' class="btn waves-effect waves-light">Next</button>
                  </div>
                </div>
                
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
                  <div>
                      <h6 id="quantiy_header"><b>Quantity</b><a style="margin-left:1em;"><i onclick="increase_quantity()" class="fa fa-plus"></i> </a>  <a id="decrease_el" style="margin-left:1em;"><i onclick="decrease_quantity()" class="fa fa-minus"></i> </a>  </h6>
                      <div id="item_amount">

                      </div>
                  </div>
                 <div id ='item_prize'></div>
                  <div id ='item_ingredients'style="margin-top:2em;">
                      <h6><b>Ingredients</b></h6>

                  </div>
                  <div id='extra_toppings_cart' style="margin-top:2em;">
                      <h6><b>Toppings </b></h6>

                  </div>
              </fieldset>
            </form>
          </div>
        </div>
  </div>
 <div hidden>
     @if(count($ingredients)>0)
         @foreach($ingredients as $ingredient)
             <button
                     style="font-weight:bolder;margin-left:1em;color:white;"
             >{{$ingredient->ingredient->name}}  </button>
         @endforeach
     @endif
 </div>
   <style>
    #map_canvas {
      height: 250px;
      /*width: 300px;*/
      margin: 0px;
      padding: 0px
    }
    .controls {
      border: 1px solid!important;
      border-radius: 2px 0 0 2px!important;
      box-sizing: border-box!important;
      -moz-box-sizing: border-box!important;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    .pac-container {
      background-color: #fff;
      z-index: 20;
      position: fixed;
      display: inline-block;
      float: left;
    }
    input[type=text]{
        background-color:white;
    }
    .modal{
      z-index: 20;
    }
    .modal-backdrop{
      z-index: 10;
      }​
      #address {
        background-color: #fff!important;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        
      }

      #address:focus {
        border-color: #4d90fe;
      }

      /*.pac-container {
      font-family: Roboto;
      }*/

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        /*font-family: Roboto;*/
        font-size: 13px;
        font-weight: 300;
      }

      </style>
      <script>
          window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB ||
              window.msIndexedDB;

          window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction ||
              window.msIDBTransaction;
          window.IDBKeyRange = window.IDBKeyRange ||
              window.webkitIDBKeyRange || window.msIDBKeyRange

          if (!window.indexedDB) {
              window.alert("Your browser doesn't support a stable version of IndexedDB.")
          }
          var db;
          var db_toppings;
          var toppings_request = window.indexedDB.open("toppings_cart", 1);
          var request = window.indexedDB.open("order_cart", 1);
          request.onerror = function(event) {
              console.log("error: ");
          };
          request.onsuccess = function(event) {
              db = request.result;
              readAll();
          };
          request.onupgradeneeded = function(event) {
              var db = event.target.result;
              var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id"});
              readAll();
          }
          toppings_request.onerror = function (event) {
              console.log("error: ", event);
          };

          toppings_request.onsuccess = function (event) {
              db_toppings = event.target.result;
              readToppings();
          };
          toppings_request.onupgradeneeded = function (event) {
              db_toppings = event.target.result;

              var transaction = event.target.transaction;
              var objectStore_toppings = db_toppings.createObjectStore("selected_toppings", {
                  keyPath: "id",
                  autoIncrement: true
              });
              transaction.oncomplete = function (event) {
                  readToppings();
              }
          }
          function readToppings() {
              var objectStore = db_toppings.transaction(["selected_toppings"],"readwrite").objectStore("selected_toppings");
              objectStore.openCursor().onsuccess = function(event) {
                  var cursor = event.target.result;
                  if (cursor) {
                      $("#"+cursor.value.id).remove();
                      $('#extra_toppings_cart').append('<button id='+cursor.value.id+'  class="glass" style="font-weight:bolder;margin-left:1em;color:white;">'+cursor.value.name+'</button>');

                      cursor.continue();
                  }
              };
          }
          function readAll() {
              var objectStore = db.transaction(["selected_ingredients"],"readwrite").objectStore("selected_ingredients");
              objectStore.openCursor().onsuccess = function(event) {
                  var cursor = event.target.result;
                  var ingredients = {!! $ingredients !!};
                  console.log("cursor",cursor);
                  console.log("ingred",ingredients);
                  if (cursor) {
                      $("#"+cursor.value.id).remove();
                      $('#item_ingredients').append('<button id='+cursor.value.id+'  class="glass" style="font-weight:bolder;margin-left:1em;color:white;">'+cursor.value.name+'</button>');

                      cursor.continue();
                  }
              };
          }
          function decrease_quantity() {
              $('#item_amount').empty();
              var quantity = sessionStorage.getItem('quantity');
              var new_qty = Number(quantity) - 1;
              if (new_qty > 1) {
                  $("#decrease_el").show();
              }
              else {
                  $("#decrease_el").hide();
              }

              $('#item_amount').append('<h6> <b>' + new_qty + '</h6>');
              sessionStorage.setItem('quantity', new_qty);
              var item_prize = Number(sessionStorage.getItem("total_due")).toFixed(2);
              var total_due = Number(item_prize * new_qty).toFixed(2);
              sessionStorage.setItem('total_due', total_due);
              $('#item_prize').empty();
              $('#item_prize').append('<h6> <b>Prize - </b>R' + total_due + '</h6>');
          }

          function increase_quantity() {
              $('#item_amount').empty();
              var quantity = sessionStorage.getItem('quantity');
              var new_qty = Number(quantity) + 1;
              if (new_qty > 1) {
                  $("#decrease_el").show();
              }
              else {
                  $("#decrease_el").hide();
              }

              $('#item_amount').append('<h6> <b>' + new_qty + '</h6>');
              sessionStorage.setItem('quantity', new_qty);
              var item_prize = Number(sessionStorage.getItem("total_due")).toFixed(2);
              var total_due = Number(item_prize * new_qty).toFixed(2);
              sessionStorage.setItem('total_due', total_due);
              $('#item_prize').empty();
              $('#item_prize').append('<h6> <b>Prize - </b>R' + total_due + '</h6>');
          }
       $(document).ready(function(){
           var qty = sessionStorage.getItem('quantity');
           if(qty==1){
               $("#decrease_el").hide();
           }
       $('#choice').append('<h6><b>Choice - </b>'+sessionStorage.getItem('item_name')+'</h6>');
       $('#type').append('<h6> <b>Type - </b>'+sessionStorage.getItem('item_category')+'</h6>');
        $('#item_bread').append('<h6><b>Bread Choice - </b>'+sessionStorage.getItem('bread_type') + ' - ' +sessionStorage.getItem('selected_toast') + '</h6>');
        $('#item_prize').append('<h6> <b>Prize - </b> R '+Number(sessionStorage.getItem('total_due')).toFixed(2)+'</h6>');
        $('#item_amount').append('<h6>'+sessionStorage.getItem('quantity')+'</h6>');
           readAll();


    $("#address_form").on('submit',function(e){
        e.preventDefault();
        sessionStorage.setItem("delivery_address",$("#address").val());
        console.log("submisison comes here",$("#address").val());
        var link_to = sessionStorage.getItem('item_id');
        window.location.href = '/order_completion/'+link_to;
        {{--window.location.href = "{{'/order_completion/'}}";--}}

        
    });
    $("#address_back").on('click',function(e){
        e.preventDefault();

        var link_to = sessionStorage.getItem('item_id');
        window.location.href = '/select_ingredients_toppings/'+link_to; 
    });
       });
      var latitude=0;
      var longitude=0;
      var map;
      var infowindow;

      function getLocation(){
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(initAutocomplete);
        } else {
          $.notify('Geolocation is not supported by this browser',{
            type:"danger",
            align:"center",
            verticalAlign:"middle",
            animation:true,
            animationType:"drop"
          });
          // alert("Geolocation is not supported by this browser.");
        }
      }

      function initAutocomplete(position) {
        latitude=position.coords.latitude;
        longitude=position.coords.longitude;

        map = new google.maps.Map(document.getElementById('map_canvas'), {
          center: {lat: latitude, lng: longitude},
          zoom: 15,
          mapTypeId: 'roadmap'
        });

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location:{lat:latitude,lng:longitude},
          radius:5
        },callback);
        // Create the search box and link it to the UI element.
        var input = document.getElementById('address');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }
      function callback(results, status) {
         console.log("creating marker",results);
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
//             var latLang=result[i].getPosition();
//             console.log("latlang",latLang);
            // map.setCenter();
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
      $('#order_popup_dialog').on("shown.bs.modal",function(){
        google.maps.event.trigger(map, "resize");
      });
      </script>
      <script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=10733251"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4VCOsDzZ-3fqwWrxmWWgoPNlXcpvpPvE&libraries=places&callback=getLocation" async defer></script>
  @endsection