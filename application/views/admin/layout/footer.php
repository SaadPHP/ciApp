<!-- footer start -->
<div class="container-fluid">
<div class="admin-footer">
<div class="row">
    <div class="col-lg-12 foot-start">
        <div class="container">
            <div class="col-lg-3 mb-2 mt-5 ml-5">
                <img width="160" src="<?= base_url();?>/apple-touch-icon.png"></img>
            </div>
            <div class="col-lg-4 custom-footer-logo">
                <ul>
                    <i class="fas fa-envelope fa-lg text-primary"></i><li> &nbsp;&nbsp;syedmuhammadsaad@live.com</li><br/>
                    <i class="fas fa-phone-alt fa-lg text-primary"></i><li> &nbsp;&nbsp;+(92) 334-3328732</li><br/>
                    <li><i class="fas fa-map-marker-alt fa-lg text-primary"></i> Ground Floor, F - 1, Gulshan View Apartment, Metrovil 3rd Scheme 
                    33, Karachi, Sindh 75330</li>
                </ul>
            </div>
            <div class="col-lg-5 map" id="map">
            </div>
        </div>
    </div>
</div>
<!-- Highlighted Area -->
<div class="row">
    <div class="col-lg-12 col-sm-6 pt-3 pb-2 text-white highArea">
        <div class="container">
            <span>&copy; <?= date('Y'); ?> <b>ciApp</b> | All Rights Reserved</span>
            <span id="icon-4" title="YouTube"><i class="fab fa-youtube"></i></span>
            <span id="icon-3" title="Linked-In"><i class="fab fa-linkedin-in"></i></span>
            <span id="icon-2" title="Twitter"><i class="fab fa-twitter"></i></span>
            <span id="icon-1" title="Facebook"><i class="fab fa-facebook"></i></span>
        </div>
    </div>
</div>
<!-- Disclaimer Area -->
<div class="row">
    <div class="col-lg-12 col-sm-3 pt-3 pb-2 disclaimer">
        <div class="container">
            <p>Disclaimer: The name, graphics and logo of ciApp with its services and products are ciApp trademarks. All other company/logo/brand names mentioned on the website is not the property of ciApp, and we do not imply or constitute any kind of endorsements, recommendation or sponsorships.</p>
        </div>
    </div>
</div>
</div>
</div>
<script src="<?= base_url('assets/jQuery/jquery-3.5.1.min.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?= base_url('assets/fontawesome/js/fontawesome.min.js');?>"></script>
<script src="<?= base_url('assets/fontawesome/js/all.min.js');?>"></script>
<script src="<?= base_url('assets/jQuery/jquery-te-1.4.0.min.js');?>"></script>

<script>
    $('textarea').jqte();
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>

<script>
let map;

function initMap() {

    // adding options for map in an object
    var options = {
        zoom: 17,
        center: { lat: 24.944608598317146, lng: 67.1057186094887 } 
    }

    // calling a map by passing in the options object
    var map = new google.maps.Map(document.getElementById("map"), options);

    // adding marker
    var marker = new google.maps.Marker({
        position: { lat: 24.944608598317146, lng: 67.1057186094887 },
        map: map
    });

}
</script>

<script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-QPhxOImPiEZfRkTJuTtW1fWqsxn-MQw&callback=initMap">
</script>

<script>
    $(document).ready(function(){
        $("#search_results, #total_search").hide();
    });

    $("#search").keyup(function(){
        if( $("#search").val().length > 1){
            var search_val = $(this).val();
            $.ajax({
                url: "<?= base_url();?>commonUsers/searchArticles",
                type: "POST",
                dataType: "json",
                data: {search_val:search_val},
                success: function(data){
                    $("#all-data, #pagination").hide();
                    $("#search_results, #total_search").fadeIn();
                    $("#search_results tbody").html(" ");
                    var count = 1;
                    var total = 0;
                    var notFound = "<tr><td colspan='6'>No Records Found.</td></tr>";
                    if( data[0] == null ){
                        $("#search_results tbody").append(notFound);
                        $("#total_search").html("<i class='fas fa-check'></i> Search Result : <b>0</b> record(s)").show();
                    }else{
                        data.forEach(function(entry){
                            $("#search_results tbody").append("<tr><td width='6%'>" + count + "</td><td width='12%'>" + entry.title + "</td><td width='35%'>" + entry.body + "</td><td width='8%'>" + entry.author_id + "</td><td width='12%'>" + entry.created_on + "</td><td width='8%'><a href='../commonUsers/edit_article/" + entry.art_id + "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i></a><a href='../commonUsers/delete_article/" + entry.art_id + "' class='btn btn-sm ml-1 btn-danger' onclick='return deleteConfirm();'><i class='fas fa-trash'></i></a></td></tr>");
                            total = count;
                            count++;
                        });
                        $("#total_search").html("<i class='fas fa-check'></i> Search Result : <b>"+ total + "</b> record(s)").show();
                    }
                }
            });
        }else{
            $("#search_results, span#total_search").hide();
            $("#all-data, #pagination").show();
        }
    });
</script>

</div>
</body>
</html>