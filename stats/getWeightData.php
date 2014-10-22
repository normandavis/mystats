<?

// Modified: [getWeightData.php] <2014-10-16 12:20:37> [norman@albany:/ftp:pi@192.168.0.31:/home/pi/www/mystats/stats/getWeightData.php]

$mysqli = mysqli_connect('localhost','fromweb','bollox','mystats');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

 $sql = mysqli_query($mysqli, 'SELECT * FROM `actual` WHERE 1 ORDER by `id`');
//$sql = mysqli_query($mysqli, 'SELECT * FROM `actual` WHERE `id` < 100  ORDER by `id`');

if (!$sql) {
    die("Error running $sql: " . mysql_error());
}

//$cols[] = array('id'=>'','label'=>'weight_in_pounds','pattern'=>'','type'=>'number');

$results = array(
    'cols' => array (
        array('label' => 'id',               'type' => 'number'),
//        array('label' => 'when',             'type' => 'string'),
        array('label' => 'weight_in_pounds', 'type' => 'number')



    ),
    'rows' => array()
);

while($row = mysqli_fetch_assoc($sql))
{

    $DateTime =  explode(' ', $row['when']);
    $Date = $DateTime[0];


    $results['rows'][] = array('c' => array(
        //      array('v' => $Date,             'f' => null),
        array('v' => $row['id'], 'f' => null),
        array('v' => $row['weight_in_pounds'], 'f' => null)
    ));
};

$json = json_encode($results, JSON_PRETTY_PRINT);
echo $json;

?>
