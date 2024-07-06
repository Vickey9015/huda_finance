<style>
<pre>
 table {
  border-collapse: collapse;
  border-radius: 1em;
  overflow: hidden;
}
</pre>
/* The container */
label.custom_chk {
    display: block;
    position:relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
	
  }

/* Hide the browser's default checkbox */
.custom_chk input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 16px;
   left: 30px;
    height: 25px;
    width: 25px;
    background-color: inherit;
    border: 1px solid #000;
}

/* On mouse-over, add a grey background color */
.custom_chk:hover input ~ .checkmark {
    background-color: transparent;
}

/* When the checkbox is checked, add a blue background */
.custom_chk input:checked ~ .checkmark {
    border: 1px solid #000;
	background:inherit;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.custom_chk input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.custom_chk .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid #000;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.fade{
                opacity:99999999
        }
  .error {
    color:green;
    }  
	</style>
  <div class="col-md-11 mt-4 rjct_white">
        <div class="row">
<?php

if($this->session->flashdata('item')) {
$message = $this->session->flashdata('item');
?>
<div class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?>

</div>
<?php
}

?>
          <div class="pink_bar"> <h4>rejected list</h4> <div class="col-md-6 ml-auto pink_right"> <div class="dropdown aab">
    <button class="btn month_button" type="button" data-toggle="dropdown">Month
    <span class=""><i class="fa fa-angle-down" aria-hidden="true"></i></span></button>
    <ul class="dropdown-menu">
      <li><a href="#">HTML</a></li>
      <li><a href="#">CSS</a></li>
      <li><a href="#">JavaScript</a></li>
      <li class="divider"></li>
      <li><a href="#">About Us</a></li>
    </ul>
  </div>

<div class="dropdown aac">
  <button class="btn all_button" type="button" data-toggle="dropdown">All
    <span class=""><i class="fa fa-angle-down" aria-hidden="true"></i></span></button>
  <ul class="dropdown-menu">
      <li><a href="#">HTML</a></li>
      <li><a href="#">CSS</a></li>
      <li><a href="#">JavaScript</a></li>
      <li class="divider"></li>
      <li><a href="#">About Us</a></li>
    </ul>
</div>

</div>   </div>
        </div>
		
        <div class="row mandates">
   
   <table class="data reject_size">
  <tr>
    <th scope="col">Select all</th>
      <th scope="col">Group name</th>
      <th scope="col"><div class="dropdown grup_typ">
  <button class="btn grup_bt dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  type
  </button>
  
</div></th>
      <th scope="col">Upload Date</th>
      <th scope="col">returned Date</th>
      <th scope="col">Total Records</th>
      <th scope="col">Reason</th>
  </tr>
  <tr>
     <td scope="row"> 
     <label class="custom_chk">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>
      </td>
      <td>HisarXHF</td>
      <td>High Court</td>
      <td>10 MAR 2018</td>
      <td>12 MAR 2018</td>
	  <td>32</td>
	  <td><a href="#" class="return_click"> <button type="button" class="btn reason_bt" data-toggle="modal" data-target="#exampleModal">
  Click Here
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title dmy_txt">Dummy text is text that is used in the 
publishing industry or by web designers
to occupy the space which will later be 
filled with 'real' content.</h5>
        
      </div>
      <div class="modal-body">
        Reason
      </div>
      <div class="modal-footer reason_futr mx-auto">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times; <cite class="reasn_txt">close </cite></span>
        </button>
      </div>
    </div>
  </div>
</div>
</a></td>
	  
  </tr>
  <tr>
     <td scope="row"> 
          <label class="custom_chk">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>
     </td>
      <td>RohtkTR</td>
      <td> Supreme Court</td>
      <td>15 MAR 2018</td>
      <td>18 MAR 2018</td>
	  <td>42</td>
	   <td><a href="#" class="return_click"> <button type="button" class="btn reason_bt" data-toggle="modal" data-target="#exampleModal">
  Click Here
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title dmy_txt">Dummy text is text that is used in the 
publishing industry or by web designers
to occupy the space which will later be 
filled with 'real' content.</h5>
        
      </div>
      <div class="modal-body">
        Reason
      </div>
      <div class="modal-footer reason_futr mx-auto">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times; close</span>
        </button>
      </div>
    </div>
  </div>
</div>
</a></td>
	 
  </tr>
  <tr>
     <td scope="row">
          <label class="custom_chk">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>
     </td>
      <td>Karnhui</td>
      <td>lower Court</td>
      <td>15 MAR 2018</td>
      <td>20 MAR 2018</td>
	  <td>12</td>
	   <td><a href="#" class="return_click"> <button type="button" class="btn reason_bt" data-toggle="modal" data-target="#exampleModal">
  Click Here
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title dmy_txt">Dummy text is text that is used in the 
publishing industry or by web designers
to occupy the space which will later be 
filled with 'real' content.</h5>
        
      </div>
      <div class="modal-body">
        Reason
      </div>
      <div class="modal-footer reason_futr mx-auto">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times; close</span>
        </button>
      </div>
    </div>
  </div>
</div>
</a></td>
	   
  </tr>
  <tr>
      <td scope="row">
           <label class="custom_chk">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>
      </td>
      <td>PKLERTY</td>
      <td>Supreme Court</td>
      <td>16 MAR 2018</td>
      <td>21 MAR 2018</td>
	  <td>54</td>
	   <td><a href="#" class="return_click"> <button type="button" class="btn reason_bt" data-toggle="modal" data-target="#exampleModal">
  Click Here
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title dmy_txt">Dummy text is text that is used in the 
publishing industry or by web designers
to occupy the space which will later be 
filled with 'real' content.</h5>
        
      </div>
      <div class="modal-body">
        Reason
      </div>
      <div class="modal-footer reason_futr mx-auto">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times; close</span>
        </button>
      </div>
    </div>
  </div>
</div>
</a></td>
	 
  </tr>
  <tr>
 <td scope="row"> 
      <label class="custom_chk">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>
 </td>
      <td>MarnIOP</td>
      <td> Lower Court</td>
      <td>16 MAR 2018</td>
      <td>22 MAR 2018</td>
	  <td>23</td>
	   <td><a href="#" class="return_click"> <button type="button" class="btn reason_bt" data-toggle="modal" data-target="#exampleModal">
  Click Here
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title dmy_txt">Dummy text is text that is used in the 
publishing industry or by web designers
to occupy the space which will later be 
filled with 'real' content.</h5>
        
      </div>
      <div class="modal-body">
        Reason
      </div>
      <div class="modal-footer reason_futr mx-auto">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times; close</span>
        </button>
      </div>
    </div>
  </div>
</div>
</a></td>
	  
	   </tr>
	     <tr>
 <td scope="row">  <label class="custom_chk">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label></td>
     <td>PKLNOD</td>
      <td>High Court</td>
      <td>20 MAR 2018</td>
      <td>23 MAR 2018</td>
	  <td>15</td>
	   <td><a href="#" class="return_click"> <button type="button" class="btn reason_bt" data-toggle="modal" data-target="#exampleModal">
  Click Here
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title dmy_txt">Dummy text is text that is used in the 
publishing industry or by web designers
to occupy the space which will later be 
filled with 'real' content.</h5>
        
      </div>
      <div class="modal-body">
        Reason
      </div>
      <div class="modal-footer reason_futr mx-auto">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times; close</span>
        </button>
      </div>
    </div>
  </div>
</div>
</a></td>
	  
	   </tr>
	   
	     <tr>
 <td scope="row">   <label class="custom_chk">
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label></td>
      <td>HaryIO</td>
      <td>High Court</td>
      <td>21 MAR 2018</td>
      <td>27 MAR 2018</td>
	  <td>43</td>
	   <td><a href="#" class="return_click"> <button type="button" class="btn reason_bt" data-toggle="modal" data-target="#exampleModal">
  Click Here
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title dmy_txt">Dummy text is text that is used in the 
publishing industry or by web designers
to occupy the space which will later be 
filled with 'real' content.</h5>
        
      </div>
      <div class="modal-body">
        Reason
      </div>
      <div class="modal-footer reason_futr mx-auto">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times; close</span>
        </button>
      </div>
    </div>
  </div>
</div>
</a></td>
	
	   </tr>
</table>


</div>
      
      </div>
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