<?php 
include 'header.php';

$query = "SELECT * FROM tbl_users where id = '".$_SESSION['user_id']."'";
$user_detail = $webapp->runsingleQuery($query);
$user_mail = $user_detail['email'];

if($user_mail == 'mark@rmgenetics.com')
{
	$width = 'width: 100%;';
	$path = 'view-form.php';
	?>
	<style>
	.h4, h4 {
   
    float: left;
   
}
	</style>
	<?php
}
else
{
	$path = 'view-forms.php';
	$width = 'width: 70%;';
}
$query1 = "SELECT * FROM tbl_users where  id = '".$user_detail['referring_agent_id']."'";
$manger = $webapp->runsingleQuery($query1);
?>
<style>

.new a {
    background: #17242a;
    color: #fff;
    padding: 5px 20px;
    width: auto !important;
    float: left;
    margin: 0 10px 0px 0;
    border: 2px solid #17242a;
    text-align: center;
}
@media only screen and (max-width:480px){
	.grid-margin{
		margin-top:0px !important;
		padding:0px !important;
	}
	.card .card-body{
		padding:0px !important;
	}
}
</style>
			 

    <div class="content-wrapper">
		<div class="row">
<div class="col-12 grid-margin">

  <div class="card" style="<?php  echo $width; ?>margin: auto;">
	<div class="card-body">
	  <!--<h4 class="card-title">Loan Form</h4>-->
	 
		  
	  <form method="post" id="" class="register_form_submit" style="float:left;width:100%;margin-bottom:20px;" enctype="multipart/form-data">
		<div>
		
		  <section style="position:static; width: 100%;" id="sec6">
		   
		   <h4 class="create_hd">Documents Upload</h4>
			<div class="form-group row" style="margin-top: 20px;" id="">
			
			
					<div id="Medicaid_image_div" class="col-md-12 ">
					
					<h4>ID Card Front</h4>
			<div class="form-group row" style="margin-top: 20px;">
				<div class="col-md-12">
					<label class="block"></label>  
				<input name="client_id_front" id="client_id_front" onchange="readURL_id_front(this)"  type="file" class="form-control">
					<input name="ID_Front_custom" id="ID_Front_custom" value="" type="hidden" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-4">
					<img id="imagePreview_id_front" style="display:none;" style="width:250px;height:250px;" src="images/previewImage.png">
				</div>
			</div>
					
			<h4>Insurance Front</h4>
			<div class="form-group row" style="margin-top: 20px;">
				<div class="col-md-12">
					<label class="block"></label>  
					<input name="client_insurance_front" onchange="readURL_insurance_front(this)" id="client_insurance_front"  type="file" class="form-control">
					<input name="Insurance_Front_custom" id="Insurance_Front_custom" value="" type="hidden" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-4">
					<img id="imagePreview_insurance_front" style="display:none;" style="width:250px;height:250px;" src="images/previewImage.png">
				</div>
			</div>
		 
		  
		
		
			<h4>Insurance Back</h4>
			<div class="form-group row" style="margin-top: 20px;">
				<div class="col-md-12">
					<label class="block"></label>
					<input name="client_insurance_back" onchange="readURL_insurance_back(this)" id="client_insurance_back"  type="file" class="form-control">
					<input name="Insurance_Back_custom" id="Insurance_Back_custom" value="" type="hidden" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-4">
					<img id="imagePreview_insurance_back" style="display:none;" style="width:250px;height:250px;" src="images/previewImage.png">
				</div>
			</div>
			
			<h4>Additional Document</h4>
			<div class="form-group row" style="margin-top: 20px;">
				<div class="col-md-12">
					<label class="block"></label>
					<input name="client_additional" onchange="readURL_additional(this)" id="client_additional"  type="file" class="form-control">
					<input name="additional_custom" id="additional_custom" value="" type="hidden" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-4">
					<img id="imagePreview_additional" style="display:none;" style="width:250px;height:250px;" src="images/previewImage.png">
				</div>
			</div>
		 
		  
		 
		 
			
			
		  </div>
				
			</div>
			
			
		
			
			
		   </section>
		 
		  
		 <div class="new col-md-12" style="padding:0px;">
		<a style="display:none;" href="javascript:void(0);" id="pre_button" onclick="pre();">Previous</a>
		<a  href="javascript:void(0);" id="submit_new" onclick="submit_new();">Submit</a>
		<input type="hidden" id="check_step" value='1'>
		</div>
		  
		
		  
		</div>
		<input type="hidden" name="post_id" id="post_id"> 
		<input name="agent_name" value="<?php  echo $user_detail['f_name'].' '.$user_detail['l_name'];  ?>" id="agent_name" type="hidden" class="form-control">
		<input name="agent_id" value="<?php  echo $user_detail['id'];  ?>" id="agent_id" type="hidden" class="form-control">
		<input name="m_name" value="<?php  echo $manger['f_name'].' '.$manger['l_name'];  ?>" id="m_name" type="hidden" class="form-control">
					<input name="agent_email" value="<?php  echo $user_detail['email'];  ?>" id="agent_email" type="hidden" class="form-control">
					<input name="timestamps" value="<?php  echo $timestamps = date("m/d/Y h:i:sa");  ?>" id="timestamps" type="hidden" class="form-control">
		<input type="hidden" name="confirm_publish_check" id="confirm_publish_check"> 
		<a class="create_btnn" style="display:none;" href="javascript:void(0);" onclick="run_submit();">Submit</a>
		
		
		
		
		<input type="hidden" id="Products2">
		<input type="hidden" id="insurance1">
		<input type="hidden" id="dob">
		<input type="hidden" id="height">
		
		
		<input type="hidden" id="type1">
		<input type="hidden" id="age1">
		<input type="hidden" id="type2">
		<input type="hidden" id="age2">
		<input type="hidden" id="relation">
		<input type="hidden" id="duplicate_of" name="duplicate_of">
		<input type="hidden" id="imgBase64" name="imgBase64">
		<input type="hidden"  id="update_lead" name="update_lead" value="<?php  echo $_GET['id']?>">
		<input type="hidden"  id="special_check" name="special_check" value="3">
		
		
	  </form>
	  
	
	  
	  
	</div>
	<!--new code start -->
		
		
		<!--new code end -->
  </div>
</div>
</div>
          </div>
		   <div style="display:none;width: 10em !important;" id="loader" class="loading"><h3 style="color:black;position:relative;top:65px;right: 32px;">Please Wait..</h3></div>   
<?php
include 'footer.php';
?>    
<style>
#sig-canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
  width:100%;
  height:auto;
}

.main-panel{
	    width: 69% !important;
    margin: auto!important;
    top: 25px!important;
position: relative!important;}
@import url(https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic);
@import url(https://fonts.googleapis.com/css?family=Arapey:400,400italic);
@import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700);
@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800);
.hidden { display:none; }

#content {
    text-align: left;
    max-width: 600px;
    margin: 2em auto;
    display: block;
    background: #fff;
    padding: 2em;
    border: 1px solid #e5e5e5;
    border-radius: 4px;
}
strong {
  font-weight:700;
}
a, a .icon { 
  color:#136fd2; 
  color:#0a3666;
  color:#53777A;
  fill:#0a3666;
  color:#000;
  text-decoration:none;
  border-bottom:solid 1px transparent;
  transition: all 300ms;
}
a:hover,
a:hover .icon {

  padding-bottom:5px;
}

.icon {
  fill:#222;
  width:12px; height:12px;
  margin:.075em .1em;
  margin-right:.2em;
}

h1 {
    text-align:center;
    font-size:2em; 
    line-height:1.5em;
    line-height: 1.2em;
    letter-spacing:0.15em;
    font-family:'Arapey', serif;
    text-transform:uppercase;
    font-weight:normal;
    margin-top:0;
    position:relative;
}
h2 {
    font-size:1.2em;
    line-height:1.2em;
    letter-spacing:.05em;
    font-family:'Open Sans Condensed',sans-serif;
    font-weight:700;
}

label, #help {
  font-family: "Open Sans", sans-serif;
}



/* Big Red Button  https://cdpn.io/MwoOeW/ */
.big-red-button {
  border:none;
  outline:none;
  color: #fff;
  text-transform: uppercase;
  font-size: 1.5em;
  letter-spacing:.1rem;
  font-family: "Open Sans Condensed", sans-serif;
  font-weight:300;
  width: 5rem;
  height: 4rem;
  line-height:4rem;
  text-align: center;
  cursor: pointer;
  border-radius: 50%;
  background: #f74d4d;
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f74d4d), color-stop(100%, #f86569));
  background-image: -moz-gradient(linear, left top, left bottom, color-stop(0%, #f74d4d), color-stop(100%, #f86569));
  box-shadow: 0 .4rem #e24f4f; 
}
.big-red-button:active {
  box-shadow: 0 0 #e24f4f;
  transform: translate(0px, .4rem);
  transition: 0.1s all ease-out;
}


.footer {
  text-align: right;
  display: block;
  margin-top: 0rem;
  max-width: 600px;
  margin:auto;
}
small.footer {
  font-family: "Open Sans", sans-serif;
}
.url {
  font-family:"Open Sans Condensed", sans-serif;
  /*font-size:1.1em;*/
}


/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
.error
{
	border:1px solid red !important;
}
</style>
<script>

function submit_new()
{
	var valid_check_validation = '';
	var inputValues = $('input[type=file]').map(function() {
		
        var type = $(this).prop("type");
        var id = $(this).attr("id");
      
        
		var val1 = $(this).val();
		if(val1 == '')
		{
			if(id != 'client_additional')
			{
				$(this).addClass("error");
				valid_check_validation = 1;
			 
			}
		}
		else
		{
			$(this).removeClass("error");
			valid_check_validation = '';
		}
           
        
		
		
		
        
    })
	
	if(valid_check_validation == '')
		{
			$("#confirm_publish").val('Publish');
			$(".register_form_submit").submit();
		}
	
}
	


$(".register_form_submit").submit(function(event) {
  event.preventDefault();
 
 
	$("#loader").show();
	
		
		
		
	$.ajax({
    url: "cajax.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   success: function(data)
      {
		 // $("#loader").hide();Publish
		 var res = $.trim(data);
		 
		  if(res == 'Publish')
		  {
			  $("#loader").hide()
			  $("#custom_alert_mess").html('<div class="alert custom_alert"><p style="color: #fff;font-size: 18px;padding-top: 5px;">Lead submitted successfully.</p></div>');
				
			setTimeout(function(){ 
				window.location.href='<?php echo $path; ?>';
			}, 2000);
		  }
		  
		  
			
		
		  
		
      },
     error: function() 
      {
      }          
    });

  
  });
  
 

function readURL_insurance_front(input) {
    var url = input.value;
	
	result1 = url.split('\\');
	
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#insurance_front').hide();
			$(input).removeClass("error");
            $('#imagePreview_insurance_front').show();
            $('#imagePreview_insurance_front').attr('src', e.target.result).height(250).width(250);
			
            $('#Insurance_Front_custom').val('https://medstation.app/images/'+result1[2]);
		}	
		reader.readAsDataURL(input.files[0]);	
    }
} 

function readURL_insurance_back(input) {
    var url = input.value;
	result1 = url.split('\\');
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
			$('#insurance_back').hide();
			$(input).removeClass("error");
            $('#imagePreview_insurance_back').show();
            $('#imagePreview_insurance_back').attr('src', e.target.result).height(250).width(250);
			 $('#Insurance_Back_custom').val('https://medstation.app/images/'+result1[2]);
		}	
		reader.readAsDataURL(input.files[0]);	
    }
} 

function readURL_additional(input) {
    var url = input.value;
	result1 = url.split('\\');
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
			$('#additional').hide();
			$(input).removeClass("error");
            $('#imagePreview_additional').show();
            $('#imagePreview_additional').attr('src', e.target.result).height(250).width(250);
			 $('#additional_custom').val('https://medstation.app/images/'+result1[2]);
		}	
		reader.readAsDataURL(input.files[0]);	
    }
}

function readURL_id_front(input) {
    var url = input.value;
	result1 = url.split('\\');
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
			$('#id_front').hide();
			$(input).removeClass("error");
            $('#imagePreview_id_front').show();
            $('#imagePreview_id_front').attr('src', e.target.result).height(250).width(250);
			$('#ID_Front_custom').val('https://medstation.app/images/'+result1[2]);  
		}	
		reader.readAsDataURL(input.files[0]);	
    }
}


		  
		   
</script>
