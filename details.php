<?php

include("includes/connect.php");

$googleMapsApiKey = getenv('GOOGLE_MAPS_API');

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "invalid data type ";
} else {
  $query = 'SELECT * FROM stores where id = '. $_GET['id'];  

  $result = mysqli_query($connect, $query); 
  
  $record = mysqli_fetch_assoc($result);

  $json = json_decode($record['json'], true);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LEGO Store | BrickMMO</title>

  <script type="module" src="./maps.js"></script>

  <!--CDN link for using Bootstrap styling -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <div class="px-5 py-3 d-flex align-items-center gap-5">
      <h1 class="fw-bold"><?=$record['name']?></h1>
      <?php
        if($json['certified'] == 1){
          echo '<p class="m-0 p-1 rounded bg-warning">Certified Store</p>';
        }
      ?>
  </div>

  <div class="mx-5 my-2 bg-body-secondary rounded">
      <div class="d-flex flex-lg-row flex-md-column flex-sm-column justify-content-between">
          <div class="p-3">
            <?php $image = $record['image'] ? $record['image'] : 'images/no_store.png'; ?>
            <img src="<?=$image?>" alt="Lego Store Image">
          </div>

          <div class="p-3 flex-grow-1">
            <div style="height: 100%; width: 100%;" class="flex-grow-1 border border-secondary" id="map"></div>
          </div>
          
      </div>

      <div class="p-4 d-flex gap-5">
        <div class="ps-3 pe-5">
          <h3>Location</h3>
          <p><span class="fw-bold">Country: </span><?=$json['country']?></p>
          <p><span class="fw-bold">City: </span><?=$json['city']?></p>
          <p><span class="fw-bold">Phone: </span><?=$json['phone']?></p>
          <a href="<?=$json['storeUrl']?>">Store Webpage</a>
        </div>
        <div>
          <h3>Hours</h3>
          <?php
            foreach($json['openingTimes'] as $hour){
              echo "<p>".$hour['day'] ." ". $hour['timeRange']."</p>";
            }
          ?>
        </div>
      </div>

      <h3 class="mt-5">Additional Information</h3>
      <?php
        if($json['additionalInfo'] === ""){
          echo "<p>No Additional Info</p>";
        } else {
          echo "<p>".$json['additionalInfo']."</p>";
        }
      ?>
  </div>
    
  <!-- footer -->
  <footer class=" border-top mt-5">
    <div class="text-center py-3">
      <div>© BrickMMO. 2024. All rights reserved.</div>
      <div>LEGO, the LEGO logo and the Minifigure are trademarks of the LEGO Group.</div>
    </div>
  </footer>

  <?php print_r($json['coordinates']) ?>

  <script>
    let coordinates = <?php echo json_encode($json['coordinates']); ?>;
    let lego_store_name = "<?php echo $record['name']; ?>";
  </script>
  <!-- fontawesone -->
  <script src="https://kit.fontawesome.com/db1e295bdd.js" crossorigin="anonymous"></script>
  <!-- Link for Bootstrap javascript functionalities -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"></script>
  <script src="https://account.brickmmo.com/header"></script>

  <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "<?php echo $googleMapsApiKey; ?>", v: "weekly"});</script>
</body>

</html>