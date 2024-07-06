         <div class="col-md-12 top_header" ng-controller="zoneCtrl">
          <div class="row">
              <div class="col-md-2 logo"><a href="#"><img src="<?php echo base_url() ?>image/Logo.png" alt="" style="margin-top:27px;"></a> </div>
			  
			 	  <div class="toggle_Wrap">
<button type="button" class="btn btn-default toggle-sidebar"><i class="fa fa-bars" aria-hidden="true"></i></button></div>
            <div class="ml-auto header_right py-4">
			<h2>Hello <?php  print_r(htmlspecialchars($this->session->userdata('name')));  ?> !</h2>
		    <h2>Last Login <?php  print_r(htmlspecialchars(date('d M Y,H:i:s',strtotime($this->session->userdata('last_login')))));?> </h2>
            <!--<div class="top_search">
              <input class="bb mr-sm-2" type="text" placeholder="Search... "  aria-label="Search" ><a  href="#"><i class="fa fa-search jj" aria-hidden="true"></i></a></div>-->
           <h3>Zone :</h3> <?php if(sizeof($this->session->userdata('zones_option')) == 1 ){ echo htmlspecialchars($this->session->userdata('zones')[0]['name']); } else { if(sizeof($this->session->userdata('zones')) > 1 ) {
           	echo "All";         	
           }
           if(sizeof($this->session->userdata('zones')) == 1 ){
           	echo $this->session->userdata('zones')[0]['name'];
           } if($this->uri->segment(2) !="MasterView") { ?>
           <input type="hidden" name="csrf_test_name" value="<?=$this->security->get_csrf_hash();?>">
              <select id="zonelist" ng-change="changeZone(zone)" ng-model="zone">
              <option value="">Change Zone</option>
              <option value="All" selected>All</option>
              <?php foreach($this->session->userdata('zones_option') as $zone){ 
                      ?>
                      <option <?php echo htmlspecialchars($zone['name']) =='All' ? 'disabled':''; ?>  value="<?php echo htmlspecialchars($zone['id']); ?>"><?php echo htmlspecialchars($zone['name']); ?></option><?php } ?>
                      
                      </select>
              <?php } } ?>
           
              <div class="btn-group gg">
                <!--<button type="button" class="btn cc dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> XJKHLYT </button>-->
                <div class="dropdown-menu"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a> </div>
                <a href="<?php echo base_url(); ?>user/logout" title="logout"><button type="button" class="btn ee"><i class="fa fa-sign-out" aria-hidden="true"></i></button></a>
                
              </div>
            </div>
          </div>
        </div>
 
 <div class="col-md-10 grey_bg ml-auto"  id="content" >
      <div class="row">

      </div>
<script>
function changeZone() {
    var x1 = document.getElementById("zonelist");
    var selectedZone = x1.options[x1.selectedIndex].value;
    console.log(selectedZone);
    <?php //echo addZone(selectedZone);?>
}
</script>  
<?php
function addZone($zz){
	$session_data = $this->session->all_userdata();
    $session_data['zones'][0]['id']= $zz;
}    
?>
	   
	  		