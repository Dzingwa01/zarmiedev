<?php
$con=mysqli_connect("zarmie.co.za","awtzjymu_admin","zarmiedev@2017","awtzjymu_zarmie");
// array for JSON response
$response = array();
   if (mysqli_connect_errno()) {
	 $response["success"] = 0;
        $response["message"] = "Failed to connect to the database: " . mysqli_connect_error();
        // echoing JSON response
        echo json_encode($response);
     // echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

$result = mysqli_query($con,"select * from  ingredient");
if (mysqli_num_rows($result) >0) {
//$result=mysqli_fetch_array($result);
while($row=mysqli_fetch_assoc($result)){
$json[]=$row;
}
	echo json_encode($json);
	}
	 else{
    $response["success"] = 0;
     $response["message"] = "No ingredients found found";
    echo json_encode($response);
	}
mysqli_close($con);

?>
