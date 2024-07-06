

<?php


$path      =base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
if($this->session->flashdata('item')) {
$message = $this->session->flashdata('item');
?>
<div class="<?php echo $message['class'] ?>"><?php echo htmlspecialchars($message['message']); ?>

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
          <div class="pink_bar"> <h4>download annexures file </h4> </div>
        </div>
        
     
          <div class="col-md-3 pl-0 pr-0" style="text-align: center;
margin-left: 38%;margin-bottom:10%;">
           <div class="form-group" >
                <label for="sel1">Annexure Type :</label>
               <select required ="required" class="form-control"  name="annexure_type" id="Annexure_download">
                  <option disabled selected>Select Annexure </option>
                  <option value="Original">Original</option>
                  <option value="LowerCourt">Lower Court</option>
                  <option value="HighCourt">High Court</option>
                  <option value="SupremeCourt">Supreme Court</option>
                  <option value="DD">Supreme Court DD</option>
                  <option value="Original_DD">Original DD</option>
                  <option value="LowerCourt_DD">Lower Court DD</option>
                  <option value="HighCourt_DD">High Court DD</option>
                  
                </select>
              </div>
            <div class="upload_one">
              <div class="upload_inner" id="1">
                 
                 
              <br>    <div class="upload_inner" id="show_download_button">
                
              </div>
                
              </div>
            </div>
          </div>
         
        
     
      </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>

<script type="application/javascript">
/** After windod Load */
$(window).bind("load", function() {
  window.setTimeout(function() {
    $(".alert").fadeTo(5000, 0).slideUp(5000, function(){
        $(this).remove();
    });
}, 5000);
});

$(function() {
    $("#Annexure_download").change(function() {
    var annxr_name =$( "#Annexure_download option:selected" ).text();
    var filename =$( "#Annexure_download" ).val(); //alert(filename);
    var fileValue =filename+'.xlsx';
    var url ='<?php echo base_url()?>upload/'+filename+'/'+filename+'.xlsx';
    url   = "this.href="+"'"+url+"';";
    var html ='<div><a href="complexDownload" download="'+fileValue+'" onclick="'+url+'"><button class="btn-anxr"><i class="fa fa-download"></i> Download '+annxr_name+' Annexure</button></a></div>';
       // alert( html );
        $('#show_download_button').html(html);
    });
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
    justify-content: center;
    height: 100%;
	}
	.modal-content{
		margin:auto;
	}
	.modal {
   
    background: #00000078;
}
</style>
<style>
.btn-anxr {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 12px 30px;
    font-size: 16px;
    cursor: pointer;
    font-size: 20px;
}

/* Darker background on mouse-over */
.btn-anxr:hover {
    background-color: RoyalBlue;
}
</style>

