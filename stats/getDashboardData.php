<?
// Modified: [getDashboardData.php] <2014-10-25 17:28:23> [norman@albany:/ftp:pi@192.168.0.31:/home/pi/www/mystats/stats/getDashboardData.php]

$mysqli = mysqli_connect('localhost','fromweb','bollox','mystats');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

$sql = mysqli_query($mysqli, 'SELECT * FROM `actual` WHERE 1 ORDER by `id`');

if (!$sql) {
    die("Error running $sql: " . mysql_error());
}

// load SQL result into a JSON array
// first create the columns
$results = array (
    'cols' => array (
        array('label' => 'id',        'type' => 'number'),
        array('label' => 'systolic',  'type' => 'number'),
        array('label' => 'diastolic', 'type' => 'number'),
        array('label' => 'pulse',     'type' => 'number'),
    ),
    'rows' => array()
);//$results

// now add the rows
while($row = mysqli_fetch_assoc($sql)) {
  
    $results['rows'][] = array('c' => array(

        array('v' => $row['id'], 'f' => null),
        array('v' => $row['systolic'], 'f' => null),
        array('v' => $row['diastolic'],'f' => null),
        array('v' => $row['pulse'],    'f' => null),
    ));
};

$json = json_encode($results, JSON_PRETTY_PRINT);
echo $json;

?>

