
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/header.php');
?>

 <main class="theia-exception">
    <div id="results">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h4>Showing Doctors List..</h4>
          </div>
        <!--   <form method="POST" id="search_doctorsdata" >  -->
          <div class="col-md-6">
            <div class="search_bar_list">
              <div class="autocomplete">
               <input type="text" class="form-control" id="search_loctions"  name="search_loctions" placeholder="Ex. Hyderabad.">
              </div>
              <div class="autocomplete">
               <input type="text" class="form-control" id="search_specialization" name="search_specialization" placeholder="Ex. Specialist..">
              </div>
              <input type="submit"  id="searchdoctorsdata" value="Search">
            </div>
          </div>

        <!--   </form> -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /results -->

    <!-- <div class="filters_listing">
      <div class="container">
        <ul class="clearfix">
          <li>
            <h6>Type</h6>
            <div class="switch-field">
              <input type="radio" id="all" name="type_patient" value="all" checked>
              <label for="all">All</label>
              <input type="radio" id="doctors" name="type_patient" value="doctors">
              <label for="doctors">Doctors</label>
              <input type="radio" id="clinics" name="type_patient" value="clinics">
              <label for="clinics">Clinics</label>
            </div>
          </li>
          <li>
            <h6>Layout</h6>
            <div class="layout_view">
              <a href="grid-list.html"><i class="icon-th"></i></a>
              <a href="#0" class="active"><i class="icon-th-list"></i></a>
              <a href="list-map.html"><i class="icon-map-1"></i></a>
            </div>
          </li>
          <li>
            <h6>Sort by</h6>
            <select name="orderby" class="selectbox">
            <option value="Closest">Closest</option>
            <option value="Best rated">Best rated</option>
            <option value="Men">Men</option>
            <option value="Women">Women</option>
            </select>
          </li>
        </ul>
      </div>
    </div> -->
    <!-- /filters -->
    
    <div class="container margin_60_35">
      <div class="row">
        <div class="col-lg-7">

          <div class="row" id="doctorslistdata">

             <div id=""></div>

            <!--  <?php if(isset($doctordata))
               for ($i=0; $i <count($doctordata); $i++) { 
                 { foreach($doctordata[$i] as $row){ ?>
             <div class="col-md-12">
              <div class="strip_list wow fadeIn">
                <a href="#0" class="wish_bt"></a>
                <figure>
                  <a href="/<?php echo base_url();?>FrontendController/DoctordetailsView/<?php echo $row->user_id;?>/<?php echo $row->account_id; ?>"><img src="/<?php echo base_url();?><?php echo $row->profile_pic_path; ?>" alt=""></a>
                </figure>
                <small style="color: blue"><?php echo $row->specialization; ?> </small>
                <h3>Dr. <?php echo $row->doctor_name; ?> </h3>
                 <small><?php echo $row->account_name; ?> </small>
                <p><?php echo $row->business_address; ?>  </p>
                <span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i> <small>(145)</small></span>
                <a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="/<?php echo base_url();?>assets/frontend/img/badges/badge_1.svg" width="15" height="15" alt=""></a>
                <ul>
                  <li><a href="#0" onclick="onHtmlClick('Doctors', 0)" class="btn_listing">View on Map</a></li>
                  <li><a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" target="_blank">Directions</a></li>
                  <li><a href="/<?php echo base_url();?>FrontendController/DoctordetailsView/<?php echo $row->user_id;?>/<?php echo $row->account_id; ?>">Book Appointment</a></li>
                </ul>
              </div>
        </div>
        <?php } }}?> -->

      </div>

          
          <nav aria-label="" class="add_top_20">
            <ul class="pagination pagination-sm">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
              </li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav>
          <!-- /pagination -->
        </div>
        <!-- /col -->
        
        <aside class="col-lg-5" id="sidebar">
          <div id="map_listing" class="normal_list">
          </div>
        </aside>
        <!-- /aside -->
        
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </main>
  <!-- /main -->

 <?php
include('static/footer.php');
?>

<!-- SPECIFIC SCRIPTS -->
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="/<?php echo base_url();?>assets/frontend/js/markerclusterer.js"></script>
    <script src="/<?php echo base_url();?>assets/frontend/js/map_listing.js"></script>
    <script src="/<?php echo base_url();?>assets/frontend/js/infobox.js"></script>



<script src="/<?php echo base_url();?>assets/js/Common/FrontendController.js"></script>


<script type="text/javascript">
    // var page =1;
    // var total_pages = <?php echo $total_pages; ?>;
    // $(window).scroll(function() {
    //     if($(window).scrollTop() + $(window).height() >= $(document).height()) {
    //         page++;
    //         if(page < total_pages) {


    //             loadData(page);
    //         }
    //     }
    // });

    /*Load more Function*/
    // function loadData(page) {
    //     $( ".loader1" ).css( "display","block" );
    //     $.ajax({
    //         method: "GET",
    //         url:url+'FrontendController/ListView',
    //         data: { page: page }
    //     })
    //     .done(function( content ) {
    //         $( ".loader1" ).css( "display","none" );
    //         $("#posts-infinite").append(content);

    //     });
    // }




</script>

<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });

  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}


function getCityForSearch(){
         var keys = [];

            $.ajax({
                type  : 'POST',
                url   : url+"FrontendController/getCityForSearch",
                dataType : 'json',
                success : function(result){
                 if(result.success==true){
                 var n = result.data.length;
                for(var i=0; i<n; i++){
                       keys.push(result.data[i].cityname); 
                  }
                       //console.log(keys.length);
                        // [ 'one', 'two' ]
                 
                  }        
                }
            });
    
         return keys ;
      }

 var citysdata = getCityForSearch();

 //getSpecialization();
 function getSpecializationForSearch(){
         var keys = [];
             
            $.ajax({
                type  : 'POST',
                url   : url+"FrontendController/getSpecializationForSearch",
                dataType : 'json',
                success : function(result){
                 if(result.success===true){
                   $.each(result.data,function(index,item) {
                     keys.push(item.specialization);
                 });

                  }        
                }
            });
          
          return keys ;
        }

var specializationdata = getSpecializationForSearch();
 //console.log(specializationdata);
autocomplete(document.getElementById("search_loctions"), citysdata);
autocomplete(document.getElementById("search_specialization"), specializationdata);

 //alert("baburao");

 

</script>