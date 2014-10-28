<?
// Modified: [getBPData.php] <2014-10-28 07:20:24> [norman@albany:/ftp:pi@192.168.0.31:/home/pi/www/mystats/stats/getBPData.php]

$mysqli = mysqli_connect('localhost','fromweb','bollox','mystats');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

// $sql = mysqli_query($mysqli, 'SELECT * FROM `actual` WHERE 1 ORDER by `id`');
 $sql = mysqli_query($mysqli, 'SELECT * FROM `actual` WHERE `id` > 397 ORDER by `id`');

if (!$sql) {
    die("Error running $sql: " . mysql_error());
}

// load SQL result into a JSON array
// first create the columns
$results = array (
    'cols' => array (
//        array('label' => 'when',      'type' => 'string'),
        array('label' => 'id',  'type' => 'number'),
        array('label' => 'systolic',  'type' => 'number'),
        array('label' => 'diastolic', 'type' => 'number'),
        array('label' => 'pulse',     'type' => 'number'),
    ),
    'rows' => array()
);//$results

// now add the rows
while($row = mysqli_fetch_assoc($sql)) {
  
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

//the Google Charts API does now support a custom valid JSON representation of dates as a string in the following format: Date(year, month, day[,hour, minute, second[, millisecond]]) where everything after day is optional, and months are zero-based.

//        array('v' => "Date($year, $month, $day, $hour, $minute, $second)", 'f' => null),
        array('v' => $row['id'], 'f' => null),
        array('v' => $row['systolic'], 'f' => null),
        array('v' => $row['diastolic'],'f' => null),
        array('v' => $row['pulse'],    'f' => null),
    ));
};

$json = json_encode($results, JSON_PRETTY_PRINT);
echo $json;

?>

