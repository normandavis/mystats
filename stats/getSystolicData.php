<?

$mysqli = mysqli_connect('localhost','fromweb','bollox','mystats');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

 $sql = mysqli_query($mysqli, 'SELECT * FROM `actual` WHERE 1 ORDER by `id`');

if (!$sql) {
    die("Error running $sql: " . mysql_error());
}

$results = array(
    'cols' => array (
//        array('label' => 'date',     'type' => 'date'),
        array('label' => 'id',       'type' => 'number'),
        array('label' => 'systolic', 'type' => 'number')
    ),
    'rows' => array()
);

while($row = mysqli_fetch_assoc($sql)) {

   // datetime assumes CCYY-MM-DD HH:MM:SS)
   $DateTime =  explode(' ', $row['when']);
   $Date = $DateTime[0];
   $Time = $DateTime[1];

   // date assumes "yyyy-MM-dd" format
   $dateArr = explode('-', $Date);
   $year  = (int) $dateArr[0];
   $month = (int) $dateArr[1] - 1; // subtract 1 to make month compatible with javascript months
   $day   = (int) $dateArr[2];

   $when = $day."-".$month."-".$year;

   // time assumes "hh:mm:ss" format
   $timeArr = explode(':', $Time);
   $hour   = (int) $timeArr[0];
   $minute = (int) $timeArr[1];
   $second = (int) $timeArr[2];

    $results['rows'][] = array('c' => array(
        array('v' => $row['id']),
        array('v' => $row['systolic'])
    ));
}

$json = json_encode($results, JSON_NUMERIC_CHECK);

echo $json;

?>
