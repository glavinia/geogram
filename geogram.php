<?php 
if(!empty($_GET['location'])){
   $maps_url='https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode($_GET['location']);
   $maps_json=file_get_contents($maps_url);
   $maps_array = json_decode($maps_json,true);
     $lat = $maps_array['results'][0]['geometry']['location']['lat'];
  $lng = $maps_array['results'][0]['geometry']['location']['lng'];
   $instagram_url='https://api.instagram.com/v1/media/search?lat='. $lat . '&lng='. $lng .'&client_id=90db7374d30644beae60c4bf295c67d7';
    $instagram_json = file_get_contents($instagram_url);
    $instagram_array = json_decode($instagram_json,true);
}

?>
<!DOCTYPE html>
<head>
     <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="node_modules/angular-material/angular-material.css">
    <link rel="stylesheet" href="style/style.css">
<meta charset="utf-8">
    <title>goegram</title>

</head>
<body ng-app="geogram">
 
<div layout="row" layout-wrap>
         <md-whiteframe class="md-whiteframe-3dp" flex="grow" layout layout-align="center center">
<form action="">
     <div layout layout-sm="column">
     <md-input-container flex >
         <label>Search like image, location</label>
    <input type="text" name="location"/>
          </md-input-container>
          <md-input-container flex ="30">
    <md-button class="md-raised md-primary" type="submit">submit</md-button>
         </md-input-container>
    </div>
    </form>
    </div>
   </md-whiteframe>
  
    <br/>
    <md-content flex layout-padding
    <div  flex ng-cloak>
  <md-grid-list
        md-cols-sm="1" md-cols-md="2" md-cols-gt-md="6"
        md-row-height-gt-md="1:1" md-row-height="4:3"
        md-gutter="8px" md-gutter-gt-sm="4px" >
    
    <?php
if(!empty($instagram_array)){
foreach($instagram_array['data'] as $image){
   echo '<md-grid-tile>';
    echo '<img src="'.$image['images']['low_resolution']['url'] .'"  alt=""/>';
    echo'</md-grid-tile>';
}
   
}
?>
    
  </md-grid-list>
</div>
</md-content>
     <script src="node_modules/angular/angular.js"></script>
    <script src="node_modules/angular-aria/angular-aria.js"></script>
    <script src="node_modules/angular-animate/angular-animate.js"></script>
    <script src="node_modules/angular-material/angular-material.js"></script>
    <script>
    
    angular.module('geogram', ['ngMaterial'])
.config(function($mdThemingProvider) {
  $mdThemingProvider.theme('default')
    .primaryPalette('pink')
    .accentPalette('orange');
});
    
    </script>
</body>
</html>