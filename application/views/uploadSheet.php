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
<div class="col-md-12 mt-4">
        <div class="row">
          <div class="pink_bar"> <h4>UPLOAD SHEET</h4> </div>
        </div>
        <form id="upload" action="<?php echo base_url() ?>uploadSheet/save" method="POST" enctype="multipart/form-data" accept-charset="utf-8" id="form_upload">
            <?php echo form_open(); ?>
          <div class="col-md-3 pl-0 pr-0 mx-auto mt-4" >
           <div class="form-group " >
                <label for="sel1">Annexure Type :</label>
                <select required ="required" class="form-control" id="sel1" name="annexure_type">
                  <option value="0" disabled selected>Select Annexure </option>
                  <option value="1">Original</option>
                  <option value="6">Original DD</option>
                  <option value="2">Lower Court</option>
                  <option value="7">Lower Court DD </option>
                  <option value="3">High Court</option>
                  <option value="8">High Court DD</option>
                  <option value="4">Supreme Court</option>
                  <option value="5">Supreme Court DD</option>
                  
                </select>
              </div>
            <div class="upload_one col-md-12 p-0" style="">
              <div class="upload_inner" id="1">
                 
                
                <input name="userfile" id="userfile"  class="form-control filestyle" value="" data-icon="false" type="file"  required/>
                 <span>Upload only xls or xlsx files</span>
               <!-- <p>Uploaded Sheets</p>-->
                
              </div>
            </div>
          </div>
         
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
 <?php } ?>
