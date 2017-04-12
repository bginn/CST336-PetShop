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
    </head>
    <body>
        <h1>Shopping Cart</h1>
       
        <table>
            
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
            
            <?php
            echo "<a href='index.php?'>
                         <button type=\"button\" class=\"btn btn-default btn-lg\">
                         <span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span> Continue Shopping
                         </button></a>";
            ?>
            
            
            
    </body>
</html>