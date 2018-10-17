<?php  
/*
*	Plugin Name: Ticket Book Plugin
*	Plugin URI: http://benzwaxm.com
*	Description: Ticket Book Plugin For http://benzwaxm.com
*	Version: 1.0
*	Author: Benzwaxm
*	Author URI: http://benzwaxm.com
*	License: Benzwaxm
*
*/

$plugin_url = WP_PLUGIN_URL . '/ticket-book';

$options = array();
	function ticket_book_menu(){
		add_menu_page(
			'Ticket Book Plugin',
			'Ticket-Booking Plugin',
			'manage_options',
			'ticket_book_options',
			'ticket_book_display'
		);
	}
	add_action('admin_menu', 'ticket_book_menu');

	function ticket_book_display(){
		if (!current_user_can('manage_options' )){
			wp_die('You do not have enough permission to view this page');
		}

		global $plugin_url;
		global $options;

		if (isset($_POST['form_submit'])){
		// These files need to be included as dependencies when on the front end.
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );

		echo '<br><br><h2 style="color:green">Updated Successfully</h2>';

		    
		    if(isset($_POST['redeem'])){
		        
		        
		        $data=($_POST['redeem']);
		        
		  
		    
		  
		 
		    
		    
		     global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM wpye_ticketinfo order by id DESC", OBJECT );


 foreach ( $results as $result ){
     
    if (in_array($result->id, $data)){
        $userid = $result->id;
		       
		       $wpdb->query("UPDATE wpye_ticketinfo SET tick=1 WHERE id=$userid");
    }else{
        $userid = $result->id;
        $wpdb->query("UPDATE wpye_ticketinfo SET tick=0 WHERE id=$userid");
    }
     
 }
    
		    
		    
		    //print_r($data[0]);
		    
		    
		  
		   }else{
		       
		       
		           global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM wpye_ticketinfo order by id DESC", OBJECT );


 foreach ( $results as $result ){
     
   
        $userid = $result->id;
		       
		       $wpdb->query("UPDATE wpye_ticketinfo SET tick=0 WHERE id=$userid");
  
     
 }
		       
		   }
		    
		    
		    
		    //exit;
		
		}


	if (isset($_POST['form_submit_6'])){
		// These files need to be included as dependencies when on the front end.
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );

		echo '<br><br><h2 style="color:green">Updated Successfully</h2>';

		$css1 = $_POST['css1'] ;						
		$options['css1'] = $css1;
		update_option('css1_db_yelp', $options);
	}

	$options = get_option('hnp_yelp');
		if ($options != ''){
			$name = $options['name'];
			$phone = $options['phone'];
			$address = $options['address'];
			$country = $options['country'];
			$image_link = $options['image_link'];
			$postal_code = $options['postal_code'];
			$street_address = $options['street_address'];
			$profile_link = $options['profile_link'];
		}



	$options = get_option('css1_db_yelp');
		if ($options != ''){
			$css1 = $options['css1'];
		}

	require('inc/options-page-wrapper.php');
	}


	


?>
<?php

function my_header_script(){?> 

<style type="text/css">
<?php
$options = get_option('css1_db_yelp');
		if ($options != ''){
			$css1 = $options['css1'];
		}
		ob_start();
if($options != '') {



echo $css1;
 }else{ ?>
	.profil1{color:block;} 
<?php	} 
		
?>
</style>
<?php }


add_action('wp_head','my_header_script');



ob_start();
	function hnp_yelp_shortcode($atts, $content = null){
		global $post;
		$options = get_option('hnp_yelp');
		if ($options != ''){
			$name = $options['name'];
			$phone = $options['phone'];
			$address = $options['address'];
			$country = $options['country'];
			$image_link = $options['image_link'];
			$street_address = $options['street_address'];
			$postal_code = $options['postal_code'];
			$profile_link = $options['profile_link'];
		}
		ob_start();
		if($profile_link!=''){
			require ('inc/front-end.php');
		}
		$content = ob_get_clean();
		return $content;
	}
	add_shortcode('hnp-yelp-bewertung', 'hnp_yelp_shortcode' );


	?>