<link href="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.css" rel="stylesheet">
<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       andrynirina.portfoliobox.net
 * @since      1.0.0
 *
 * @package    Woo_Georeporting
 * @subpackage Woo_Georeporting/admin/partials
 */
 $resources_url= content_url( "/plugins/woo-georeporting/admin/res/");
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div>
    <nav class="navbar">
        <img class="" src="<?php echo $resources_url;?>logo.png"  alt="">   
        <form class="form-inline pull-right">
            <button class="btn btn-primary" type="button">Nav 1</button>
            <button class="btn btn-primary" type="button">Nav 2</button>
            <button class="btn btn-primary" type="button">Nav 3</button>
            <button class="btn btn-primary" type="button">Nav 4</button>
        </form>
        <hr>
    </nav>
    <nav class="breadcrumb" role="navigation">
        <span>Map://<i id="map_path"></i></span>
    </nav>
    
    <div class="body row">
        <div class="col-sm-8">
            <div class="map_view" id="map_view" style="width:100%; height: 800px"> 
            </div>
        </div>
        <div class="col-sm-4">
            <h3>Detail et information</h3>
            <?php 
                $args = array(
                    'post_type' => 'shop_order',
                    'post_status'=>'wc-completed',
                   'posts_per_page' => '-1'
                  );
                  $my_query = new WP_Query($args);
                  foreach ($my_query->posts as $key => $order) {
                      # code...
                      $order = wc_get_order($order->ID);
                      $order_data = $order->get_data();
                      echo "<strong>".$order_data['shipping']['first_name']." ".$order_data['shipping']['last_name']."</strong><br>";
                      echo "&nbsp <span>".$order_data['shipping']['state']."</span>";
                      echo "&nbsp <span>".$order_data['shipping']['country']."</span>";
                      echo "&nbsp <span>".$order_data['shipping']['city']."</span>";
                      echo "&nbsp <span>".$order_data['shipping']['postcode']."</span>";
                      echo "&nbsp <span>".$order_data['shipping']['address_1']."</span>";

                      echo "&nbsp <span> / ".$order_data['billing']['email']."</span>";
                      echo "&nbsp <span> - ".$order_data['billing']['phone']."</span>";
                      echo   '<hr>';
                  }
                  
                
                ?>
        </div>
        
    </div>
</div>

<script>
        var myCustomStyle = {
            stroke: true,
            fill: true,
            fillColor: '#fff',
            fillOpacity: 1
        }
        var myGeoJSONPath = "<?php echo content_url( "/plugins/woo-georeporting/admin/res/custom.geo.json"); ?>";
        
        jQuery.getJSON(myGeoJSONPath,function(data){
            var map = L.map('map_view').setView([52.482780222078226,0.3515625], 1);
            L.geoJson(data, {
                clickable: true,
                style: myCustomStyle,
                onEachFeature: function (featureData, featureLayer) {
                    featureLayer.on('click', function (ev) {
                        var latlng_click = map.mouseEventToLatLng(ev.originalEvent);
                        var continent_name=featureData.properties.continent;
                        var contry_name=featureData.properties.brk_name;
                        jQuery("#map_path").text(continent_name+"/"+contry_name);
                        console.log(latlng_click);
                        map.setView([latlng_click.lat,latlng_click.lng],4);    
                    });
                }
            }).addTo(map);
        })
    </script>

<?php    
?>