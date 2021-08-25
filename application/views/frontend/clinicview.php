
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/header.php');
?>
 <main class="theia-exception">
    <div id="results">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h4><strong>Showing 10</strong> of 140 results</h4>
          </div>
         <!--  <div class="col-md-6">
            <div class="search_bar_list">
              <input type="text" class="form-control" placeholder="Ex. Specialist, Name, Doctor...">
              <input type="submit" value="Search">
            </div>
          </div> -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /results -->

    
    <div class="container margin_60_35">
      <div class="row">
        <div class="col-lg-7">
          <div class="row" id="posts-infinite">
             <?php if(isset($clinicdata)){
               foreach($clinicdata as $row){ ?>
             
             <div class="col-md-12">
              <div class="strip_list wow fadeIn">
                <a href="#0" class="wish_bt"></a>
                <figure>
                  <a href="/<?php echo base_url();?>Listview"><img src="/<?php echo base_url();?><?php echo $row->logo; ?>" alt=""></a>
                </figure>
                <h3> <?php echo $row->account_name; ?> </h3>
                <!--  <small>Address:</small> -->
                <p><?php echo $row->business_address; ?>  </p>
                <span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i> <small>(145)</small></span>
                <a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="/<?php echo base_url();?>assets/frontend/img/badges/badge_1.svg" width="15" height="15" alt=""></a>
                <ul>
                  <li><a href="#0" onclick="onHtmlClick('Doctors', 0)" class="btn_listing">View on Map</a></li>
                  <li><a href="https://www.google.com/maps/dir// <?php echo $row->business_address; ?>" target="_blank">Directions</a></li>
                  <li><a href="/<?php echo base_url();?>Listview">Get Doctors List</a></li>
                </ul>
              </div>
                  <!-- /strip_list -->
        </div>
        <?php } }?>
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