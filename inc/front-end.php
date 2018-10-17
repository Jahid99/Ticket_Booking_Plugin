<?php
//header('content-type:text/plain');
 if (!function_exists('get_web_page_ratings_google'))   {

function get_web_page_ratings_google( $url )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept-Language: en']);
    $content = curl_exec( $ch );
    global $full_content;
    $full_content = $content;
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;


 $start = strpos($content, '<meta itemprop="ratingValue" content="')+38;

$end = strpos($content, '</span>', $start);

$length = $end-$start;

$content = substr($content, $start, $length);

    return $content;
}

}


$string = trim(get_web_page_ratings_google($profile_link));

$string = explode("\"",$string);

$ratings = $string[0];

 $reviews = explode(">",$string[3])[1];



  echo "<p class='prof1_reviews'>".$reviews." Bewertungen auf <a href='".$profile_link."' target='_blank'> yelp.com</a></p>";
  
?>
 <p class="prof1_ratings"><?php echo $ratings ; ?> von 5 Sternen </p>

<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "LocalBusiness",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?php echo $street_address; ?>",
      "postalCode":"<?php echo $postal_code; ?>",
      "addressLocality": "<?php echo $address; ?>",
      "addressCountry": "<?php echo $country; ?>"
    },
    "name": "<?php echo $name; ?>",
    "telephone": "<?php echo $phone ; ?>",
    "image": "<?php echo $image_link; ?>",
    "url": "<?php echo $profile_link; ?>"
    ,
    "aggregateRating": {
      "@type": "AggregateRating",
      "bestRating": "5",
      "worstRating": "1",
      "ratingValue": "<?php echo $ratings ; ?>",
      "ratingCount": "<?php echo $reviews; ?>"
    }
    }
  </script>
