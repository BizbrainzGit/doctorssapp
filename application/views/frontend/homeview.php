
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/header.php');
?>
  <style type="text/css">
    .autocomplete {
  position: relative;
  display: inline-block;
  width: 100%;
}
  </style>
  <main>
    <div class="header-video">
      <div id="hero_video">
        <div class="content">
          <h3>Find a Doctor!</h3>
         <!--  <p>
            Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
          </p> -->
          <form method="post" action="/<?php echo base_url();?>Listview">
            <div id="custom-search-input">
            
              <div class="input-group">
                  <div class="autocomplete">
                    <input type="text" class="search-query" placeholder="Ex. Name, Specialization ...." id="search_specializtion_list">
                  </div>
                <input type="submit" class="btn_search" value="Search">
              </div>
            
              <!-- <ul>
                <li>
                  <input type="radio" id="all" name="radio_search" value="all" checked>
                  <label for="all">All</label>
                </li>
                <li>
                  <input type="radio" id="doctor" name="radio_search" value="doctor">
                  <label for="doctor">Doctor</label>
                </li>
                <li>
                  <input type="radio" id="clinic" name="radio_search" value="clinic">
                  <label for="clinic">Clinic</label>
                </li>
              </ul> -->
            </div>
          </form>
        </div>
      </div>
      <img src="/<?php echo base_url();?>assets/frontend/img/video_fix.png" alt="" class="header-video--media" data-video-src="/<?php echo base_url();?>assets/frontend/video/intro" data-teaser-source="/<?php echo base_url();?>assets/frontend/video/intro" data-provider="" data-video-width="1920" data-video-height="750">
    </div>
    <!-- /Header video -->


    
    <div class="container margin_120_95">
      <div class="main_title">
        <h2>Find by specialization</h2>
        <p>Nec graeci sadipscing disputationi ne, mea ea nonumes percipitur. Nonumy ponderum oporteat cu mel, pro movet cetero at.</p>
      </div>
      <div class="row">

       <?php if(isset($specializationdata))
               { foreach($specializationdata as $row){ ?>

        <div class="col-lg-3 col-md-6">
          <a href="/<?php echo base_url();?>Listview" class="box_cat_home">
            <i class="icon-info-4"></i>
            <img src="/<?php echo base_url();?><?php echo $row->specialization_img; ?>" width="60" height="60" alt="">
            <h3><?php echo $row->specialization; ?></h3>
            <ul class="clearfix">
              <li><strong>14</strong>Doctors</li>
              <li><strong>6</strong>Clinics</li>
            </ul>
          </a>
        </div>
<?php }} ?>

        <!-- <div class="col-lg-3 col-md-6">
          <a href="#0" class="box_cat_home">
            <i class="icon-info-4"></i>
            <img src="/<?php echo base_url();?>assets/frontend/img/icon_cat_2.svg" width="60" height="60" alt="">
            <h3>Cardiology</h3>
            <ul class="clearfix">
              <li><strong>124</strong>Doctors</li>
              <li><strong>60</strong>Clinics</li>
            </ul>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#0" class="box_cat_home">
            <i class="icon-info-4"></i>
            <img src="/<?php echo base_url();?>assets/frontend/img/icon_cat_3.svg" width="60" height="60" alt="">
            <h3>MRI Resonance</h3>
            <ul class="clearfix">
              <li><strong>124</strong>Doctors</li>
              <li><strong>60</strong>Clinics</li>
            </ul>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#0" class="box_cat_home">
            <i class="icon-info-4"></i>
            <img src="/<?php echo base_url();?>assets/frontend/img/icon_cat_4.svg" width="60" height="60" alt="">
            <h3>Blood test</h3>
            <ul class="clearfix">
              <li><strong>124</strong>Doctors</li>
              <li><strong>60</strong>Clinics</li>
            </ul>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#0" class="box_cat_home">
            <i class="icon-info-4"></i>
            <img src="/<?php echo base_url();?>assets/frontend/img/icon_cat_7.svg" width="60" height="60" alt="">
            <h3>Laboratory</h3>
            <ul class="clearfix">
              <li><strong>124</strong>Doctors</li>
              <li><strong>60</strong>Clinics</li>
            </ul>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#0" class="box_cat_home">
            <i class="icon-info-4"></i>
            <img src="/<?php echo base_url();?>assets/frontend/img/icon_cat_5.svg" width="60" height="60" alt="">
            <h3>Dentistry</h3>
            <ul class="clearfix">
              <li><strong>124</strong>Doctors</li>
              <li><strong>60</strong>Clinics</li>
            </ul>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#0" class="box_cat_home">
            <i class="icon-info-4"></i>
            <img src="/<?php echo base_url();?>assets/frontend/img/icon_cat_6.svg" width="60" height="60" alt="">
            <h3>X - Ray</h3>
            <ul class="clearfix">
              <li><strong>124</strong>Doctors</li>
              <li><strong>60</strong>Clinics</li>
            </ul>
          </a>
        </div>
        <div class="col-lg-3 col-md-6">
          <a href="#0" class="box_cat_home">
            <i class="icon-info-4"></i>
            <img src="/<?php echo base_url();?>assets/frontend/img/icon_cat_8.svg" width="60" height="60" alt="">
            <h3>Piscologist</h3>
            <ul class="clearfix">
              <li><strong>124</strong>Doctors</li>
              <li><strong>60</strong>Clinics</li>
            </ul>
          </a>
        </div> -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->

     <div id="app_section">
      <div class="container">
        <div class="row justify-content-around">
          <div class="col-md-5">
            <p><img src="/<?php echo base_url();?>assets/frontend/img/app_img.svg" alt="" class="img-fluid" width="500" height="433"></p>
          </div>
          <div class="col-md-6">
            <small>Application</small>
            <h3>Download <strong>Findoctor App</strong> Now!</h3>
           <!--  <p class="lead">Tota omittantur necessitatibus mei ei. Quo paulo perfecto eu, errem percipit ponderum no eos. Has eu mazim sensibus. Ad nonumes dissentiunt qui, ei menandri electram eos. Nam iisque consequuntur cu.</p> -->
            <div class="app_buttons wow" data-wow-offset="100">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43.1 85.9" style="enable-background:new 0 0 43.1 85.9;" xml:space="preserve">
              <path stroke-linecap="round" stroke-linejoin="round" class="st0 draw-arrow" d="M11.3,2.5c-5.8,5-8.7,12.7-9,20.3s2,15.1,5.3,22c6.7,14,18,25.8,31.7,33.1" />
              <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-1" d="M40.6,78.1C39,71.3,37.2,64.6,35.2,58" />
              <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-2" d="M39.8,78.5c-7.2,1.7-14.3,3.3-21.5,4.9" />
            </svg>
              <a href="#0" class="fadeIn"><img src="/<?php echo base_url();?>assets/frontend/img/apple_app.png" alt="" width="150" height="50" data-retina="true"></a>
              <a href="#0" class="fadeIn"><img src="/<?php echo base_url();?>assets/frontend/img/google_play_app.png" alt="" width="150" height="50" data-retina="true"></a>
            </div>
          </div>
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /app_section -->


    <div class="bg_color_1">
      <div class="container margin_120_95">
        <div class="main_title">
          <h2>Most Viewed doctors</h2>
          <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri.</p>
        </div>
        <div id="reccomended" class="owl-carousel owl-theme">
           <?php if(isset($doctordata))
               for ($i=0; $i <count($doctordata); $i++) { 
                 { foreach($doctordata[$i] as $row){ ?>

          <div class="item">
            <a href="/<?php echo base_url();?>Listview">
              <div class="views"><i class="icon-eye-7"></i>140</div>
              <div class="title">
                <h4>Dr. <?php echo $row->doctor_name; ?> <em><?php echo $row->specialization; ?></em></h4>
              </div><img src="/<?php echo base_url();?><?php echo $row->profile_pic_path; ?>" alt="" width="350px" height="350px">
            </a>
          </div>

           <?php } }}?>

          <div class="item">
            <a href="detail-page.html">
              <div class="views"><i class="icon-eye-7"></i>120</div>
              <div class="title">
                <h4>Dr. Julia Holmes<em>Pediatrician</em></h4>
              </div><img src="http://via.placeholder.com/350x500.jpg" alt="">
            </a>
          </div>

          <div class="item">
            <a href="detail-page.html">
              <div class="views"><i class="icon-eye-7"></i>115</div>
              <div class="title">
                <h4>Dr. Julia Holmes<em>Pediatrician</em></h4>
              </div><img src="http://via.placeholder.com/350x500.jpg" alt="">
            </a>
          </div>

       

        </div>
        <!-- /carousel -->
      </div>
      <!-- /container -->
    </div>
    <!-- /white_bg -->    
    
    <div class="container margin_120_95">
      <div class="main_title">
        <h2>Discover the <strong>online</strong> appointment!</h2>
        <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie. Sed ad debet scaevola, ne mel.</p>
      </div>
      <div class="row add_bottom_30">
        <div class="col-lg-4">
          <div class="box_feat" id="icon_1">
            <span></span>
            <h3>Find a Doctor</h3>
            <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box_feat" id="icon_2">
            <span></span>
            <h3>View profile</h3>
            <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box_feat" id="icon_3">
            <h3>Book a visit</h3>
            <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
          </div>
        </div>
      </div>
      <!-- /row -->
      <p class="text-center"><a href="/<?php echo base_url();?>Listview" class="btn_1 medium">Find Doctor</a></p>
    </div>
    <!-- /container -->

   
  </main>
  <!-- /main content -->

 <?php
include('static/footer.php');
?>

  <!-- SPECIFIC SCRIPTS -->
  <script src="/<?php echo base_url();?>assets/frontend/js/video_header.js"></script>
  <script>
    'use strict';
    HeaderVideo.init({
      container: $('.header-video'),
      header: $('.header-video--media'),
      videoTrigger: $("#video-trigger"),
      autoPlayVideo: true
    });
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
autocomplete(document.getElementById("search_specializtion_list"), specializationdata);

 //alert("baburao");

 

</script>