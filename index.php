<?php

include("includes/connect.php");

$query = 'SELECT long_name
FROM countries
RIGHT JOIN stores
on countries.id = stores.country_id
GROUP BY long_name';    
$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LEGO Store | BrickMMO</title>
  <!--CDN link for using Bootstrap styling -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <main>
    <div class="d-flex justify-content-center align-items-center border-bottom">
        <div style="width: 50px; height: auto;">
            <img src="https://cdn.brickmmo.com/icons@1.0.0/stores.png" style="width:100%" alt="Bricksum-icon" />
        </div>
        <h1 class="my-3">LEGO® Stores</h1>
    </div>
    <div class="px-5 py-3">
        <p>On this page, you can view a list of all LEGO stores along with their respective countries. Simply open an accordion to see the stores available in each country.</p>
    </div>

    <div class="accordion px-5 pb-3" id="accordionExample">
        <?php if (mysqli_num_rows($result)): ?>

            <?php while($country = mysqli_fetch_assoc($result)): ?>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo str_replace(" ","",$country['long_name'])?>" aria-expanded="false" aria-controls="<?php echo $country['long_name']?>">
                            <?php echo $country['long_name']?>
                        </button>
                    </h2>
                    <div id="<?php echo str_replace(" ","",$country['long_name'])?>" class="accordion-collapse collapse" data-bs-parent="#accordion<?php echo str_replace(" ","",$country['long_name'])?>">
                        <?php
                            $query = 'SELECT stores.id, name, long_name
                            FROM stores LEFT JOIN countries
                            on stores.country_id = countries.id 
                            WHERE long_name = "'.$country['long_name'].'"';    
                            $result_stores = mysqli_query($connect, $query);

                            if (mysqli_num_rows($result_stores)){
                                echo '<ol>';
                                    while($store = mysqli_fetch_assoc($result_stores)){
                                        echo '<li><a href="details.php?id='.$store['id'].'">'.$store['name'].'</a></li>';
                                    }
                                echo '</ol>';
                            }
                        ?>
                    </div>
                </div>

            <?php endwhile;?> 
        <?php endif;?>
    </div>

    <div class="px-5 py-3">
        
    </div>

    

    <!-- <div class="mx-5 my-2 bg-body-secondary rounded">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Accordion Item #1
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Accordion Item #2
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Accordion Item #3
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
                </div>
            </div>
        </div>
    </div> -->


  <!-- footer -->
  <footer class=" border-top mt-3">
    <div class="text-center py-3">
      <div>© BrickMMO. 2024. All rights reserved.</div>
      <div>LEGO, the LEGO logo and the Minifigure are trademarks of the LEGO Group.</div>
    </div>
  </footer>
  <!-- fontawesone -->
  <script src="https://kit.fontawesome.com/db1e295bdd.js" crossorigin="anonymous"></script>
  <!-- Link for Bootstrap javascript functionalities -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <script src="https://account.brickmmo.com/header"></script>
</body>

</html>