<?php
$con=mysqli_connect("zarmie.co.za","awtzjymu_admin","zarmiedev@2017","awtzjymu_zarmie");
// array for JSON response
$response = array();
   if (mysqli_connect_errno()) {
	 $response["success"] = 0;
        $response["message"] = "Failed to connect to the database: " . mysqli_connect_error();
        echo json_encode($response);
    }

	$result = mysqli_query($con,"select * from menu_categories");
	if (mysqli_num_rows($result) >0) {
		while($row=mysqli_fetch_assoc($result)){
		$json[]=$row;
		}
		echo json_encode($json);
	}
	 else{
    $response["success"] = 0;
     $response["message"] = "No users";
    echo json_encode($response);
	}
mysqli_close($con);

?>
