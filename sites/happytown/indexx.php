
<!DOCTYPE html>

<html>
<head>
    <title>Geo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry"></script>
    <link rel='stylesheet' type='text/css' href='css/reset.css'>
    <link rel='stylesheet' type='text/css' href='css/styles.css'>
    <link rel='stylesheet' type='text/css' href='css/bootstrap.css'>
    <meta charset="UTF-8">
    
</head>

<body>

<?php

    include_once("back.php");
    $ong = new sQuery();
    $sql = "select * from post_tbl";
    $result = $ong -> executeQuery($sql);
    
    $row=mysql_fetch_array($result);
       
 


?> 

<div class="topbar">
<img src="images/ht-logo.png" width="150px;">
<div class="input-append fright">
    <form class="form-search">
  <div class="input-append barsearch">
    <input type="text" class="span2 search-query ">
    <button type="submit" class="btn">Search</button>
  </div>

</form>
  </div>
</div>
<div class="bottom">
<img src="images/home.png" width="80px" class="fleft">
<img src="images/setings.png" width="80px" class="fleft">
<img src="images/list.png" width="80px" class="fleft">
<a href="form.php"><img src="images/map.png" width="80px" class="fleft"></a>
</div>



  
    <section class="geo">
        <article>
            <div id='map_canvas' style='width:100%; height:1200px;'></div>
        </article>
        <div id="respuesta">
            
        </div>
     

   

    </section>
    


    <script type="text/javascript">
    
 
        var sevilla = new google.maps.LatLng(37.38264, -5.996295);

        var map;
        var latitud;
        var longitud;
        var precision;
        
        var aray = "<?php echo $row; ?>" ;

        $(document).ready(function() {
            localizame();            
        });
        
        function localizame() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(coordenadas, errores);
          
            }else{
                alert('Oops! Tu navegador no soporta geolocalización. Bájate Chrome, que es gratis!');
            }
        }
        
        function coordenadas(position) {
            latitud = position.coords.latitude;
            longitud = position.coords.longitude;
            precision = position.coords.accuracy;  
            cargarMapa();
            
        }
        
        function errores(err) {
            if (err.code == 0) {
              alert("Oops! Algo ha salido mal");
            }
            if (err.code == 1) {
              alert("Oops! No has aceptado compartir tu posición");
            }
            if (err.code == 2) {
              alert("Oops! No se puede obtener la posición actual");
            }
            if (err.code == 3) {
              alert("Oops! Hemos superado el tiempo de espera");
            }
        }
         
        function cargarMapa() {
            var image = 'anthropo.png';
            
            var latlon = new google.maps.LatLng(latitud,longitud);
            var myOptions = {
                zoom: 15,
                center: latlon,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map($("#map_canvas").get(0), myOptions);
            
            var coorMarcador = new google.maps.LatLng(latitud,longitud);
                
            var marcador = new google.maps.Marker({
                position: coorMarcador,
                map: map,
                icon: image,
                title: "Where I am?"

            });
        
            
        
          
           

            for (var i = 0; i < 10; i++) {
                num=aleatorio(-200,200);
                num2=aleatorio(-300,300);
               

                var dif=num/900000;
                var dif2=num/50000;
                var coorMarcador2 = new google.maps.LatLng(latitud+(-7*dif),longitud-(9*dif2));
                var coorMarcador3 = new google.maps.LatLng(latitud+dif2,longitud+dif);
                //alert(distance(coorMarcador,coorMarcador2);
                
                var marcador2 = new google.maps.Marker({
                    position: coorMarcador2,
                    map: map,
                    title: "Dónde estoy?"
                   
                });

                var marcador2 = new google.maps.Marker({
                    position: coorMarcador3,
                    map: map,
                    title: "Dónde estoy?"
                   
                });
                distance = google.maps.geometry.spherical.computeDistanceBetween(coorMarcador,coorMarcador2); 
            
               

            };
           
            
        }



        function aleatorio(inferior,superior){ 
            numPosibilidades = superior - inferior ;
            aleat = Math.random() * numPosibilidades ;
            aleat = Math.round(aleat) ;
            return parseInt(inferior) + aleat ;
        } 


        function distance()
        {

            firstLatLng = new google.maps.LatLng(37.764778,-122.453338);
            secondLatLng = new google.maps.LatLng(37.765533,-122.452708);
            distance = google.maps.geometry.spherical.computeDistanceBetween(firstLatLng,secondLatLng); 
   
            return distance;
    

        }

           
   
          



    </script>
</body>
</html>
