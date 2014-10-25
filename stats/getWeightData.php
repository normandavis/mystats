<?
// Modified: [getWeightData.php] <2014-10-25 17:23:55> [norman@albany:/ftp:pi@192.168.0.31:/home/pi/www/mystats/stats/getWeightData.php]

$mysqli = mysqli_connect('localhost','fromweb','bollox','mystats');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

 $sql = mysqli_query($mysqli, 'SELECT * FROM `actual` WHERE 1 ORDER by `id`');
//$sql = mysqli_query($mysqli, 'SELECT * FROM `actual` WHERE `id` < 100  ORDER by `id`');

if (!$sql) {
    die("Error running $sql: " . mysql_error());
}

$results = array(
    'cols' => array (
        array('label' => 'when',             'type' => 'string'),
        array('label' => 'weight_in_pounds', 'type' => 'number'),
    ),
    'rows' => array()
);//$results

// now add the rows
while($row = mysqli_fetch_assoc($sql))
{

   // datetime assumes CCYY-MM-DD HH:MM:SS)
   $DateTime =  explode(' ', $row['when']);
   $Date = $DateTime[0];
   $Time = $DateTime[1];

   // date assumes "CCYY-MM-DD" format
   $dateArr = explode('-', $Date);
   $year  = (int) $dateArr[0];
   $month = (int) $dateArr[1] - 1; // subtract 1 to make month compatible with javascript months
   $day   = (int) $dateArr[2];

   // time assumes "hh:mm:ss" format
   $timeArr = explode(':', $Time);
   $hour   = (int) $timeArr[0];
   $minute = (int) $timeArr[1];
   $second = (int) $timeArr[2];

   $results['rows'][] = array('c' => array(

       array('v' => "Date($year, $month, $day, $hour, $minute, $second)", 'f' => null),
       array('v' => $row['weight_in_pounds'], 'f' => null)
   ));
};

$json = json_encode($results, JSON_PRETTY_PRINT);
echo $json;

?>
