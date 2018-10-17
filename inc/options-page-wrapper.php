<!-- Create a header in the default WordPress 'wrap' container -->
<link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div class="wrap">
   <div id="icon-themes" class="icon32"></div>
   <h2>ALL Tickets List</h2>
   <?php settings_errors(); ?>
   <?php
      if( isset( $_GET[ 'tab' ] ) ) {
          $active_tab = $_GET[ 'tab' ];
      }else{
        $active_tab = 'profile_1';
      }
      ?>
  
   <form id="featured_upload" method="post" action="">
       
        <table id="myTable" class="display" style="width:100%">
   <thead>
      <tr>
         <th>Ticket Number</th>
         <th>Name</th>
         <th>Phone</th>
         <th>Amount</th>
         <th>Redeem</th>
      </tr>
   </thead>
   <tbody>
      
   <?php 


   global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM wpye_ticketinfo order by id DESC", OBJECT );
$cnt=0;
//echo $results[0]->result_id;

 foreach ( $results as $result ){ ?>

 

    
      <tr>
         <td><center><?php echo $result->ticket_no;?></center></td>
         <td><center><?php echo $result->name;?></center></td>
         <td><center><?php echo $result->phone;?></center></td>
         <td><center><?php echo $result->amount;?></center> </td>
         <td><center><input type="checkbox" value="<?php echo $result->id;?>" name="redeem[]" <?php if($result->tick==1){echo "checked";} ?>></center></td>
      </tr>
    



    

     
    
      




<?php }



    ?>
    
       </tbody>
   
</table>
      
      <input class="button-primary" type="submit" name="form_submit" value="Update" />
      
   </form>
</div>

  <script type="text/javascript">
    jQuery(document).ready( function () {
    jQuery('#myTable').DataTable();
} );</script>
<!-- /.wrap -->