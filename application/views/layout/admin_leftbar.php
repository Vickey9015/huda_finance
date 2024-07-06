
   <div class="col-md-2 white_bg" id="sidebar">
         
          <div class="aside_bar mt-5">
            <ul>
  <li class="<?php if($this->uri->segment(2)=="memberView" OR $this->uri->segment(2)=="updateMember"){echo "active";}?>"> <a href="<?php echo base_url() ?>admin/bankmemberView"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Member Listing</cite>
		  <span class="tooltiptext">Member Listing</span></div></a>
		  </li>
		  
		   <li class="<?php if($this->uri->segment(2)=="addMember" ){echo "active";}?>"> <a href="<?php echo base_url() ?>admin/addBankMember"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Add Member</cite>
		  <span class="tooltiptext">Add Member</span></div></a>
		  </li>
		  
		 
			  </ul>
          </div>
        </div>

  <style>
  cite{
font-style:normal; 
 }
  
  </style>