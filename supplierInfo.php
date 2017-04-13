<?php
    include 'includes/dbConn.php';
    $dbConn = getConnection("online_pets");

    function getInfo(){
        global $dbConn;

        $sql = "SELECT * FROM inventory i
		        JOIN pets p ON p.pet_id = i.pet_id
		        JOIN supplier s ON s.supp_id = i.supp_id
		        JOIN breed b ON b.breed_id = p.breed_id
		        WHERE p.pet_id = :petId";
		$np[':petId'] = $_GET['petId'];


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
        <title>Pet Info: <?=$_GET['petId']?></title>
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
                    background: black;


                }
                #text
                {
                    color: white;
                    text-align:center;
                }
                #table
                {
                    color:white;
                }
                table, th, td {
                border: 1px solid white;
                }
                table {
             width: 100%;
                  }

        th {
            height: 50px;
        }

                </style>







    </head>
    <body>
        <h1>More Info For Pet: <?=$_GET['petId']?></h1>

        <table>
            <tr>
                <th>Breed</th>
                <th>Supplier</th>
                <th>Address</th>
                <th>Country</th>
                <th>Phone</th>
                <th>Price</th>

            </tr>
            <?php
                $pets = getInfo();
                foreach($pets as $pet) {
                    echo "<tr>";
                    echo "<td>" . $pet['breed'] . "</td><td>" . $pet['supp_name']  . "</td><td>" . $pet['address']
                         . "</td><td>" . $pet['country'] . " Months</td><td>" . $pet['phone'] . " </td><td>$". $pet['price'] . "</td><td>";
                    echo "</tr>";
                }
            ?>
            </table>

            <?php
            echo "<a href='index.php?'>
                         <button type=\"button\" class=\"btn btn-default btn-lg\">
                         <span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span> Continue Shopping
                         </button></a>";
            ?>
    </body>
</html>
