<?php
    session_start();

    include 'includes/dbConn.php';
    $dbConn = getConnection("online_pets");

    function getInfo($petID){
        global $dbConn;

        $sql = "SELECT * FROM inventory i
		        JOIN pets p ON p.pet_id = i.pet_id
		        JOIN supplier s ON s.supp_id = i.supp_id
		        JOIN breed b ON b.breed_id = p.breed_id
		        WHERE p.pet_id = :petId";
		$np[':petId'] = $petID;


	//	echo $sql;
        $stmt = $dbConn -> prepare ($sql);
        $stmt -> execute($np);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
      <!-- *********************************************************************************** -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

      <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- ***************************-->


    <!-- ************************** -->
        <style>
        .jumbotron
        {
          text-align: center;
          background-color: #edae3b;

        }
        .img-circle
        {
          margin-left: auto;
          margin-right:auto;
        }
        body
        {
          background-color: black;
        }
        #text
        {
          color:white;
          text-align: center;
        }

        </style>

<!-- **************************** -->




    </head>
    <body>


<!-- ********************************************* -->
              <div class="jumbotron">
              <h1>Shopping Cart</h1>
              </div>
<!-- ********************************************* -->

<div class="row">
<div class="col-6 col-md-4"></div>
<div class="col-6 col-md-4">  <img src="http://th31.st.depositphotos.com/11153276/14392/v/450/depositphotos_143926991-stock-illustration-logo-template-for-pet-shops.jpg" class="img-circle" alt="Cinque Terre" width="304" height="236">
</div>
<div class="col-6 col-md-4"></div>
</div>

<!-- ********************************************* -->

<div class="row">
<div class="col-6 col-md-2"></div>
<div class="col-6 col-md-8">
<p class="text-center">
<table id="text">



            <?php

                if(!isset($_SESSION['petCart'][$_GET['petId']]) && isset($_GET['petId']))
                     $_SESSION['petCart'][$_GET['petId']] = $_GET['petId'];
                $petIds = $_SESSION['petCart'];
                $itemCount = 1;
                $totalPrice = 0;
                echo "<tr>";
                    echo "<td>Item #</td>";

                    echo "<td> Type </td><td> Gender </td><td> Color </td>";
                    echo "<td> Age(months)</td><td> Weight(lbs)</td>";
                    echo "<td> Breed </td><td> Country</td><td> Price</td>";
                echo "</tr>";
                foreach($petIds as $petId) {

                    $pet = getInfo($petId);
                    $pet = $pet[0];
                    echo "<tr>";
                        echo "<td>Item " . $itemCount . "</td>";

                        echo "<td>" . $pet['type'] . "</td><td>" . $pet['gender']  . "</td><td>" . $pet['color'] . "</td>";
                        echo "<td>" . $pet['age_months'] . " Months</td><td>" . $pet['weight_pounds'] . " lbs</td>";
                        echo "<td>" . $pet['breed'] . "</td><td>" . $pet['country'] . "</td><td>$" . $pet['price'] . "</td>";
                    echo "</tr>";
                    $itemCount++;
                    $totalPrice += $pet['price'];
                }
                echo "<tr><td>Total Price: $" . $totalPrice . "</td></tr>";
            ?>

            </table>
          </p>
           <p class="text-center">

            <?php
            echo "<a href='index.php?'>
                         <button type=\"button\" class=\"btn btn-default btn-lg\">
                         <span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span> Continue Shopping
                         </button></a>";
            ?>

</p>
</div>
<div class="col-6 col-md-2"></div>
</div>


    </body>
</html>
