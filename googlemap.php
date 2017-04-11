<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mygovhospital";
	$con = new mysqli($servername, $username, $password, $dbname);
	$sql1 = "SELECT hospitalID, name, longitude, latitude FROM hospital WHERE hshow='Y'";
	$result = mysqli_query($con, $sql1);
	$list = array();
	while($row = $result->fetch_assoc())
	{
		$list[] = $row;
	}
	mysqli_close($con);
	$value = array();
	foreach($list as $key=>$val)
	{
		foreach($val as $k=>$v)
		{ 
        // $v is string.
        // And $k is $val array index (0, 1, ....)
        $value[] = $v; //store the value of each attribute of 
						//each hospital without the key in an array	
		}
	}
	$hospitals = array(); //array of all hospital arrays
	$counter =0; //keep track of number of attributes already stored in a hospital array 
	$length = count($value); //total number of attributes of all hospitals retrieved from database 
	for($i=0;$i<$length;$i++)
	{
		$hospital[] = $value[$i]; //store value of attributes belong to one hospital in an array;
		$counter++;
		if($counter==4) //when a hospital array is full
		{
			$hospitals[] = $hospital; //store it to hospitals array
			$hospital = array(); //reset a hospital array
			$counter = 0; //reset counter
		}
	}
?>
<script type="text/javascript">
// pass PHP array to JavaScript array
var locations = <?php echo json_encode( $hospitals ) ?>;

function initialize()
{
var mapProp = {
  center: new google.maps.LatLng(5.315505, 108.033286),
  zoom:5,
  mapTypeId: google.maps.MapTypeId.ROADMAP
  };

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker,i;
 
for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][2], locations[i][3]),
        title:locations[i][1],
		url:'index.php#' + locations[i][0],
		map: map
      });

google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          window.location.href = this.url;
        }
      })(marker, i));
    }
}
google.maps.event.addDomListener(window, 'load', initialize);

</script>
