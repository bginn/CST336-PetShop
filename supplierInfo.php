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