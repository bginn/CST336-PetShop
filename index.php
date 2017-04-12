<?php
    include 'includes/dbConn.php';
    $dbConn = getConnection("online_pets");

    function getPetInfo() {
        global $dbConn;
        
        $sql = "SELECT * FROM pets p
		        JOIN breed b ON p.breed_id = b.breed_id
		        JOIN inventory i ON p.pet_id = i.pet_id WHERE 1";
		        
		$sql .= " AND type LIKE :type";
		$namedParameters[':type'] = '%' . $_GET['type'] . '%';
		
		$sql .= " AND gender LIKE :gender";
		$namedParameters[':gender'] = '%' . $_GET['gender'] . '%';
		
		if (isset($_GET['status']) ) { //"status checkbox was checked"
            $sql .= " AND availability = :availability";
            $namedParameters[':availability'] = 'Y';    
        }
    
        if($_GET['sort'] == 'Age') {
            if(isset($_GET['ascOrDesc']))
                $sql .= " ORDER BY age_months ASC";
            else 
                 $sql .= " ORDER BY age_months DESC";
        }
        else if($_GET['sort'] == 'Weight'){
            if(isset($_GET['ascOrDesc']))
                $sql .= " ORDER BY weight_pounds ASC";
            else 
                $sql .= " ORDER BY age_months DESC";
        }
        else if($_GET['sort'] == 'Color'){
            if(isset($_GET['ascOrDesc']))
                $sql .= " ORDER BY color ASC";
            else 
                $sql .= " ORDER BY age_months DESC";
        }
        
        echo $sql;
         $stmt = $dbConn -> prepare ($sql);
        $stmt -> execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        return $records;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Online Pet Store</title>
     
    </head>
    <body>
        <h1>Online Pet Store</h1>
        
        <form>
            Type:       <select name="type">
                            <option value="">All Types</option>
                            <option value="cat">Cat</option>
                            <option value="dog">Dog</option>
                            <option value="bird">Bird</option>
                            <option value="rabbit">Rabbit</option>
                        </select> 
                        
            Sex:        <select name="gender">
                            <option value="">Both Sexes</option>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select> 
                        
                        <input type="checkbox" name="status" id="status"/>
                        <label for="status"> Available </label>
                        
            Sort by:    <select name="sort">
                            <option value="Age">Age</option>
                            <option value="Weight">Weight</option>
                            <option value="Color">Color</option>
                        </select>
                        <input type="checkbox" name="ascOrDesc" id="status"/>
                        <label for="ascOrDesc"> Ascending </label>
                        
                        <br />
                        <input type="submit" name="submit"/>
                        
                        
                    
        </form>
    
        <table>
            <tr>
                <th>Type</th>
                <th>Gender</th>
                <th>Color</th>
                <th>Age</th>
                <th>Weight</th>
                <th>Available</th>
                <th>More Info</th>
            </tr>
            <?php
                $pets = getPetInfo();
                foreach($pets as $pet) {
                    echo "<tr>";
                    echo "<td>" . $pet['type'] . "</td><td>" . $pet['gender']  . "</td><td>" . $pet['color'] 
                         . "</td><td>" . $pet['age_months'] . " Months</td><td>" . $pet['weight_pounds'] . " lbs</td><td>". $pet['availability'] . "</td><td>";
                    echo "<a href='petInfo.php?petId=" . $pet['pet_id'] . "'>More Info</a></td> ";
                    echo "</tr>";
                }
            ?>
        </table>
      
    </body>
</html>