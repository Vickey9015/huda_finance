<?php
$session_data = $this->session->all_userdata();
$role_id = $session_data['role_id'];
 ?>
<?php if ($role_id == 3) {?>
<?php
if($this->session->flashdata('anrError')) {
        $message = $this->session->flashdata('anrError');
		?>
	<div onLoad="$('#myModal').modal('show');">	
		<div id="myModal" class="modal fade">
		
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h4 class="modal-title">File upload failed because of following errors</h4>
						<button type="button" class="close closeModal" data-dismiss="modal" aria-hidden="true">&times;</button>
						
					</div>
					<div class="modal-body">
<?php 		
       
        foreach($message['message'] as $key=>$value){
               // $val =array_values($value);
                //echo "<pre>error====";print_r($value);
               // foreach($val as $key=>$showerror){
			//echo "<pre>error====";print_r($showerror);
        ?>
			<div class="serial_point">Error at Serial No.<?php echo $key+1; ?> </div>
			
			<ul class="ordering">
		        <?php foreach($value as $k=>$v){ ?>		
			<li><span></span><?php echo htmlspecialchars($v); ?></li>
			<?php } ?>
			</ul>	
                
              <!--  </div>-->
        <?php
               // }
        }  ?>
		</div>
		
		
		<div class="modal-footer">
        <button type="button" class="close closeModal" data-dismiss="modal">Close</button>
       
      </div>
	 </div>
    </div>
</div>	</div> 
<?php // echo "<pre>error";print_r($message); exit;
} 

?>
      




<?php

if($this->session->flashdata('item')) {
$message = $this->session->flashdata('item');
?>
<div class="<?php echo $message['class']; ?>"><?php echo htmlspecialchars($message['message']); ?>

</div>
<?php
}

?>

<?php

if($this->session->flashdata('anrError111')) {
        $message = $this->session->flashdata('anrError');
       // echo "<pre>error";print_r($val);
        foreach($message['message'] as $key=>$value){
                $val =array_values($value);
               // echo "<pre>error====";print_r($val);
                foreach($val as $showerror){
        ?>
                <div class="<?php echo $message['class'] ?>"><?php echo htmlspecialchars($showerror); ?>
                
                </div>
        <?php
                }
        }
}
?>
<div class="showError alert-success fade in" id="alertmsg"> </div>
<div class="col dash_x">
        <div class="row">
          <div class="pink_bar"> <h4>UPLOAD SHEET</h4> </div>
        </div>
        <form  action="" method="POST" enctype="multipart/form-data" accept-charset="utf-8" id="form_upload">
            <?php echo form_open(); ?>
          <div class="col-md-3 pl-0 pr-0 mx-auto mt-4" >
          
            <div class="upload_one col-md-12 p-0" style="">
              <div class="upload_inner" id="1">
                 
                
                <input name="userfile" id="userfile"  class="form-control filestyle" value="" data-icon="false" type="file"  required/>
                 <span>Upload only xls or xlsx files</span>
               <!-- <p>Uploaded Sheets</p>-->
                
              </div>
            </div>
          </div>
          <div class="progress">
          <div class="progress-bar"></div>
        </div>
        <div id="uploadStatus"></div>
         
        <div class="col-md-2 mx-auto mt-5">
        <button type="submit" name="importfile" value="submit" class="btn upload_button mx-auto">Upload now</button>
        </div>
     </form>
      </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script type="text/javascript">
$.validator.addMethod("myFile", function(value, element) {
    var xlsfile = this.optional(element) || /\.(xlsx|xls|xlsm)$/i.test(value)
    return xlsfile;
}, "Incorect file type");

jQuery.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
    }, "Annexure Type is required");
    
    $("#upload").validate({
         rules: {
            userfile: {
                required: true, 
                 myFile: true
            },
            annexure_type:{
                selectcheck : true
            }
        },
        messages: {
                annexure_type: "Annexure Type is required !",
                userfile: "Please upload xls or xlsx file !",
        }
    });

</script>
<script>
$(document).ready(function(){ 
    $(".upload_inner").click(function(){
        $('.upload_file').val('');
        var divId =$(this).attr('id');
       
        $('#file_type').val(divId);
      //  alert(divId);
    });
    $('.closeModal').on("click", function () { 
        //$($(this).closest('.modal')).modal('hide');
	$('.modal').hide();
    });
    
});

// (function($) {
//     $.fn.checkFileType = function(options) {
//         var defaults = {
//             allowedExtensions: [],
//             success: function() {},
//             error: function() {}
//         };
//         options = $.extend(defaults, options);

//         return this.each(function() {

//             $(this).on('change', function() {
//                 var value = $(this).val(),
//                     file = value.toLowerCase(),
//                     extension = file.substring(file.lastIndexOf('.') + 1);

//                 if ($.inArray(extension, options.allowedExtensions) == -1) {
//                     options.error();
//                     $(this).focus();
//                 } else {
//                     options.success();

//                 }

//             });

//         });
//     };

// })(jQuery);

// $(function() {
//     $('#userfile').checkFileType({
//         allowedExtensions: ['xls', 'xlsx'],
//         success: function() {
//           //  alert('Success');
//         },
//         error: function() {
//             alert('Upload only xls or xlsx files');
//         }
//     });

// });
</script>
<script type="application/javascript">
/** After windod Load */
$(window).bind("load", function() {
  window.setTimeout(function() {
    $(".alert").fadeTo(15000, 0).slideUp(15000, function(){
        $(this).remove();
    });
}, 15000);
});
</script>

  <style>
	.modal {
  display:block;
}
        .fade{
                opacity:99999999
        }
  .error {
    color:red;
    }  
    .modal.fade .modal-dialog{
		transform:inherit;
	}
	.modal-dialog {
    display: flex;
	margin:auto;
    justify-content: center;
    height: 100%;
	}
	
	.modal-content{
		margin:auto;
	}
	.modal {
   
    background: #00000078;
}
#myModal .modal-body{
	height: 395px;
    overflow: auto;
}
.modal-title{
	font-size:17px;
}
.modal-footer button {
    font-size: 14px;
    font-weight: 400;
    background:tranparent;
	border:1px solid #3a3a3a;
    color: #000 !important;
    padding: 8px 14px;
    border-radius: 3px;
}
@media (min-width: 576px){
.modal-dialog {
    max-width: 50%;
   
}
}

ul.ordering {    list-style:none;   min-width:250px; }
ul.ordering { 
  display:block; 
  clear:left; 
  vertical-align:middle;  
  font-size: 20px;
   line-height: 20px; 
  padding-left: 5px; }
ul.ordering li span{  width: 12px; height: 12px; background:red;  display:inline-block; margin-right:6px }
ul.ordering li:nth-child(2) span{ background:green !important;  }
ul.ordering li:nth-child(3) span{ background:blue !important;  }
.upload_one{
	position:relative;
}
.upload_inner {
    text-align: center;
    position: relative;
    top: 0;
   
}
</style>
<!-- AdminLTE for demo purposes -->	
<div class="loader" id="loading" style="display:none;">	
	<img src="<?php echo base_url();?>assets/img/nu-loader-2.png" class="loader-img">	
	<h5 class="loader-text">Please wait...</h5>	
</div>	
<style>	
	body.noScroll{	
	   overflow: hidden;	
	   }	
	   .loader{	
	   position: fixed;	
	   top: 0;	
	   z-index: 9999;	
	   left: 0;	
	   width: 100%;	
	   height: 100%;	
	   background-color: rgba(255,255,255,0.7);	
	   }	
	   .loader-img{	
	   width: 50px;	
	   position: fixed;	
	   left: 46%;	
	   top: 50%;	
	   animation: rotation 1.2s infinite linear;	
	   }	
     @keyframes rotation {	
			from {	
				transform:rotate(0deg);	
			}	
			to {	
				transform:rotate(360deg);	
			}	
		}	
	   .loader-text{	
	   position: absolute;	
	   left: 42%;	
	   top: 60%;	
	   }	
	   .outer-div{	
	   background-color: #fff;	
	   padding: 2.5rem;	
	   border-radius: 10px;	
	   }	
</style>
 <?php } ?>
 <script>
  $(document).ready(function(){
    $("#form_upload").on('submit', function(e){
      // setTimer();
      $("#loading").show();
      e.preventDefault();
      $.ajax({
        xhr: function() {
          var xhr = new XMLHttpRequest();
          // var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = ((evt.loaded / evt.total) * 100);
                $(".progress-bar").width(Math.round(percentComplete) + '%');
                $(".progress-bar").html(Math.round(percentComplete)+'%');
            }
          }, false);
          return xhr;
        },
        type: 'POST',
        url: '<?php echo base_url('UploadFile/fileUpload');?>',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(xhr){
          // $(".progress-bar").width('0%');
          // $('#uploadStatus').html('Please wait...');
          $('.local').css("display", "none");
          var filename = $('input[type=file]').val();
          if(!filename){
            xhr.abort();
            $('#uploadStatus').html('<p style="color:#EA4335;">Please sel a file</p>');
          }
        },
        error:function(){
          $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again</p>');
        },
       success: function(data) {
          const obj = JSON.parse(data);
         
          $("#loading").hide();
          if(obj.statusCode == "NP000"){
            //alert(obj.message)

            $('#form_upload')[0].reset();
           
            $('#alertmsg').html('<p style="color:#28A74B;">'+ obj.message +'</p>');
            var url = '<?php echo base_url('FileApprove/approveFiles');?>';
            $(location).attr('href',url);
          }
          else{
            $('#form_upload')[0].reset();
            $('#uploadStatus').html(' ');
            $('#alertmsg').html('<p style="color:#EA4335;">'+ obj.message +'</p>');
          }
        }
      });
    });

    $("#userfile").change(function(){
        var allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-excel'];
        // application/vnd.ms-excel
        var file = this.files[0];
        var fileType = file.type;
        // alert(fileType);
        var fileName = file.name;
        if(!allowedTypes.includes(fileType)){
          $('#form_upload')[0].reset();
          $('#alertmsg').html('<p style="color:#EA4335;">Please upload xlsx file only</p>');
          return false;
        }
    });

  });
  </script>
  <style>
 
.progress {
    display: -ms-flexbox;
    display: flex;
    height: 20px;
    overflow: hidden;
    font-size: .75rem;
    background-color: #e9ecef;
    border-radius: .25rem;
  margin-top: 10px;
}
.progress-bar {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-pack: center;
    justify-content: center;
    overflow: hidden;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    background-color: #28a745;
    transition: width .6s ease;
  font-size: 16px;
  text-align: center;
}

#uploadStatus{
  padding: 10px 20px;
    margin-top: 10px;
  font-size:18px;
  text-align: center;
}
.dash_x .pink_bar{

  margin:15px;
  padding:10px 0;
  border-radius:10px;
  background-color:#9898CC;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
}

.dash_x .pink_bar h4{

  color:#fff !important;
  font-weight:500;
  font-size:20px;
  background:#9898CC


}
.dash_x .upload_button{
  background:#9898CC !important;
  color:#fff !important;
font-weight:400;


}
.dash_x .form-group{
  color:#C03066 !important;
  font-weight:400;

}
  </style>
