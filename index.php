<?php
    session_start();
    include 'includes/dbConn.php';
    $dbConn = getConnection("online_pets");

    if(!isset($_SESSION['petCart'])){
        $_SESSION['petCart'] = array();
    }

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

        //echo $sql;
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
        #text1
        {
            color:#edae3b;
            text-align:center;
        }
        #table
        {
            color:white;
            text-align:center;
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
      <div class="jumbotron">
               <h1>Online Pet Store</h1>
              </div>


        <form id="text">
            Type:       <select name="type" id="text1">
                            <option value="">All Types</option>
                            <option value="cat">Cat</option>
                            <option value="dog">Dog</option>
                            <option value="bird">Bird</option>
                            <option value="rabbit">Rabbit</option>
                        </select>

            Sex:        <select name="gender" id="text1">
                            <option value="">Both Sexes</option>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>

                        <input type="checkbox" name="status" id="status"/>
                        <label for="status"> Available </label>

            Sort by:    <select name="sort" id="text1">
                            <option value="Age">Age</option>
                            <option value="Weight">Weight</option>
                            <option value="Color">Color</option>
                        </select>
                        <input type="checkbox" name="ascOrDesc" id="status"/>
                        <label for="ascOrDesc"> Ascending </label>

                        <br />
                        <input type="submit" name="submit"/>



        </form>
        <div class="row">
 <div class="col-6 col-md-3"></div>
 <div class="col-6 col-md-6">


        <table id="table">
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
                         . "</td><td>" . $pet['age_months'] . " Months</td><td>" . $pet['weight_pounds'] . " lbs</td><td>". $pet['availability'] . "</td>";
                    echo "<td><a href='supplierInfo.php?petId=" . $pet['pet_id'] . "'>More Info</a></td> ";

                    echo "<td><a href='cart.php?petId=".$pet['pet_id']."'>
                     <button type=\"button\" class=\"btn\">
                     Add to Cart
                     </button></a></td>";

                    echo "</tr>";
                }
            ?>
        </table>
      </div>
      <div class="col-6 col-md-3"></div>
</div>
<p class="text-center" >
      <?php
      echo "<a href='cart.php?'>
                         <button type=\"button\" class=\"btn btn-default btn-lg\">
                         <span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span> View Shopping Cart
                         </button></a>";

      ?>
    </body>
  </p>
</html>
