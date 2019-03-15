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
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div>
    <div class="header">
        <h1>Woo Georeporting</h1>
        <hr>
    </div>
    <div class="body row">
        <div class="col col-sm-2">
            <h3>Menu de navigation</h3>
        </div>
        <div class="col-sm-6">
            <span>Map://<i id="map_path"></i></span>
            <div class="map_view" id="map_view" style="width:100%; height: 800px"> 
            </div>
        </div>
        <div class="col-sm-4">
            <h3>Detail et information</h3>
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
