<?php 
	include_once('connection.php');

	/*Function to select last record date*/
	function getLastRecordDate($con){
		$sql_date = "select date from dht22 order by date desc limit 1";
        $date_data = $con->query($sql_date);
        if($date_data->num_rows>0){
			$lastDate = $date_data->fetch_assoc();
			return $lastDate['date'];
		}
	}

	/*Function to fetch soil all data*/
	function getSoilDataForDate($con, $RecordDate){
		$temp_humidity = getDHT22_data($con,$RecordDate);
		$moist = getHygrometer_data($con,$RecordDate);
		$complete_data = array();
		array_push($complete_data, $temp_humidity);
		array_push($complete_data, $moist);
		return $complete_data;
	}

	/*Function to date wise DHT22 data*/
	function getDHT22_data($con,$RecordDate){
		$sql = "select distinct humidity,temperature from dht22 where date = '".$RecordDate."' order by date desc limit 1";
		$data_th = $con->query($sql);
		if($data_th->num_rows>0){
			return $data_th->fetch_assoc();
		}else
			return "No data found";
	}
	/*Function to date wise hygrometer data*/
	function getHygrometer_data($con,$RecordDate){
		$sql = "select distinct moisture from hygrometer where date = '".$RecordDate."' order by date desc limit 1";
		$data_th = $con->query($sql);
		if($data_th->num_rows>0){
			return $data_th->fetch_assoc();
		}else
			return "No data found";
	}


	/*Function to display date selector*/
	function displayDateSelector($con,$RecordDate){
		$sql_date = "select distinct date from dht22";
        $date_data = $con->query($sql_date);
        if($date_data->num_rows>0){
            while($date_row=$date_data->fetch_assoc()){
          		if($date_row == $RecordDate){
          			$msg = "<option value='".$date_row['date']."' selected >".$date_row['date']."</option>";
          		}else{
          		$msg = "<option value='".$date_row['date']."'>".$date_row['date']."</option>";
          		}
          		echo $msg;
            }
        }
	}

	/*Functiont to fetch lastest temperature and humidity*/
	function LastTempHumidityReading($con){
		$dht_22 = "SELECT humidity, temperature FROM dht22 ORDER BY srno DESC LIMIT 1;";
  		$dht_data = $con->query($dht_22);
  		if($dht_data->num_rows ==1){
    		$dht22_row = $dht_data->fetch_assoc();
    		return $dht22_row;
  		}else{
  			echo "No data found";
  		}
	}

	/*Function to fetch Last hygrometer readings*/
	function LastHygroReading($con){
		$hygro = "SELECT moisture FROM hygrometer ORDER BY srno DESC LIMIT 1;";
  		$hygro_data = $con->query($hygro);
	  	if($hygro_data->num_rows ==1){
	    	$hygro_row = $hygro_data->fetch_assoc();
	    	return $hygro_row;
	  	}else{
	  		echo "No data found";
	  	}
	}

	/*Function to give textual status of temperature humidity suitable for planst*/
	function getTempHumdityStatus($con){
		$t_h = LastTempHumidityReading($con);
		$t = $t_h['temperature'];
		$h = $t_h['humidity'];
		$temperature = '';
		$humidity = '';
		/*Temperature status code*/
		if(50 <= $t and $t <=100){
			$temperature = 'High';
		}elseif(15 <= $t and $t <=49){
			$temperature = 'Normal';
		}else{
			$temperature = 'Low';
		}
		/*Humidity status code*/
		if(70 <= $h and $h <=100){
			$humidity = 'High';
		}elseif(35<= $h and $h <=69){
			$humidity = 'Normal';
		}else{
			$humidity = 'Low';
		}

		$tempHumidity = array();
		array_push($tempHumidity, $temperature);
		array_push($tempHumidity, $humidity);
		return $tempHumidity;
	}

	/*Function to get temperature status code*/
	function temperatureCode($con,$t){
		$temperature = '';
		/*Temperature status code*/
		if(50 <= $t and $t <=100){
			$temperature = 'High';
		}elseif(15 <= $t and $t <=49){
			$temperature = 'Normal';
		}else{
			$temperature = 'Low';
		}
		return $temperature;
	}
	function humidityCode($con,$h){
		$humidity = '';
		/*Humidity status code*/
		if(70 <= $h and $h <=100){
			$humidity = 'High';
		}elseif(35<= $h and $h <=69){
			$humidity = 'Normal';
		}else{
			$humidity = 'Low';
		}
		return $humidity;
	}

	function moistureCode($con,$m){
		$moisture = '';
		/*Moisture status code*/
		if(70 <= $m and $m <=100){
			$moisture = 'High';
		}elseif(15 <= $m and $m <=69){
			$moisture = 'Normal';
		}else{
			$moisture = 'Low';
		}
		return $moisture;
	}
	/*Function to give textual status of temperature humidity suitable for planst*/
	function getMoistureStatus($con){
		$m = LastHygroReading($con);
		$moisture = '';
		/*Moisture status code*/
		if(70 <= $m and $m <=100){
			$moisture = 'High';
		}elseif(30 <= $m and $m <=69){
			$moisture = 'Normal';
		}else{
			$moisture = 'Low';
		}
		return $moisture;
	}
/*Function to return class color code based on status*/
	function getClassColorCode($status){
		$ccode = '';
		switch ($status) {
			case 'High':
				$ccode = 'red';
				break;
			case 'Low':
				$ccode = 'purple';
				break;
			default:
				$ccode = 'green';
				break;
		}
		return $ccode;
	}

	/*Function to get required water level percentage depending on moisute level*/
	function requiredWaterLevel($moisture){
		$wpercent = '';
		
		if($moisture>=50){
			$wpercent = 'No more water required';
		}if($moisture< 50){
			$wpercent = 50-$moisture;
			$wpercent.=' %';
		}
		return $wpercent;
	}

/*Function to water level status code*/
	function getWaterlevelColorCode($status){
		$wCcode = '';
		if($status != 'No more water required'){
			$wCcode = 'red';	
		}else{
			$wCcode = 'green';
		}
		return $wCcode;
	}

function soilInitialData($con,$lastdate){
	$soilData = getSoilDataForDate($con, $lastdate);
  	$dht22_row =LastTempHumidityReading($con);
  	$hygro_row =LastHygroReading($con);
	
	$all_data='
		<div class="col s12 m12 l12">
              <br>
              <table class="bordered stripped highlight grey lighten-2">
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><b>Humidity</b></td>
                    <td>
                      <a href="javascript:void(0);" 
                      class="'.getClassColorCode(humidityCode($con,$soilData[0]["humidity"])). ' btn">
                        '.$soilData[0]["humidity"].' %
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><b>Temperature</b></td>
                    <td>
                      <a href="javascript:void(0);" class="'.getClassColorCode(temperatureCode($con,$soilData[0]["temperature"])).' btn">
                        '.$soilData[0]["temperature"].' &#8451;
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><b>Moisture</b></td>
                    <td>
                      <a href="javascript:void(0);" class="'.getClassColorCode(moistureCode($con,$soilData[1]["moisture"])).' btn">
                        '.$soilData[1]["moisture"].' %
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <br>
            </div>
            <div class="col s12 m12 l12">
              <p class="flow-text center" style="color:white;">Preventive Measures</p>
              <table class="bordered stripped highlight grey lighten-2">
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><b>Water Needed</b></td>
                    <td>
                      <a href="javascript:void(0);" class="btn '. getWaterlevelColorCode(requiredWaterLevel($soilData[1]["moisture"])).'">'.
                        requiredWaterLevel($soilData[1]["moisture"]).'
                      	</a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><b>Fertilizers Needed</b></td>
                    <td>
                      <a href="javascript:void(0);" class="btn red">26%</a>
                     <!--  <a href="javascript:void(0);" class=" btn right green darken-2">read more...</a> -->
                    </td>
                  </tr>
                </tbody>
              </table>
              <br>
            </div>
	';
	echo $all_data;
	}


/*Function to load Plant condition Data*/
function plantInitialData($con,$lastdate){
	$soilData = getSoilDataForDate($con, $lastdate);
  	$dht22_row =LastTempHumidityReading($con);
  	$hygro_row =LastHygroReading($con);
	
	$all_data='
		<div class="col s12 m12 l12">
              <br>
              <table class="bordered stripped highlight grey lighten-2">
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><b>Disease</b></td>
                    <td>
                      <a href="javascript:void(0);" 
                      class="'.getClassColorCode(humidityCode($con,$soilData[0]["humidity"])). ' btn">
                        '.$soilData[0]["humidity"].' %
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><b>No of plants affected</b></td>
                    <td>
                      <a href="javascript:void(0);" 
                      class="'.getClassColorCode(humidityCode($con,$soilData[0]["humidity"])). ' btn">
                        '.$soilData[0]["humidity"].' %
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><b>PH level</b></td>
                    <td>
                      <a href="javascript:void(0);" class="'.getClassColorCode(temperatureCode($con,$soilData[0]["temperature"])).' btn">
                        '.$soilData[0]["temperature"].' &#8451;
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><b>Fertilizers for plant</b></td>
                    <td>
                      <a href="javascript:void(0);" class="'.getClassColorCode(temperatureCode($con,$soilData[0]["temperature"])).' btn">
                        '.$soilData[0]["temperature"].' &#8451;
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><b>Fertilizers for soil</b></td>
                    <td>
                      <a href="javascript:void(0);" class="'.getClassColorCode(temperatureCode($con,$soilData[0]["temperature"])).' btn">
                        '.$soilData[0]["temperature"].' &#8451;
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <br>
            </div>
            
	';
	echo $all_data;
	}
?>