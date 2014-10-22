<?
// Modified: [getbollox.php] <2014-10-17 19:52:13> [norman@albany:/ftp:pi@192.168.0.31:/home/pi/www/mystats/stats/getbollox.php]


// connect to the database
$mysqli = mysqli_connect('localhost','fromweb','bollox','mystats');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

$sql = mysqli_query($mysqli, 'SELECT * FROM `actual` WHERE id > 100 and id < 200 ORDER by `id`');

if (!$sql) {
    die("Error running $sql: " . mysql_error());
}

// load the column headings
$results = array(
    'cols' => array (
        array('label' => 'id',               'type' => 'number'),
        array('label' => 'weight_in_pounds', 'type' => 'number'),
        array('label' => 'floor',            'type' => 'number'),
        array('label' => 'ceiling',          'type' => 'number'),
        array('label' => 'middle',           'type' => 'number'),
    ),
    'rows' => array()
);

// Starting Weight  - *B2* the starting weight supplied
// Goal Weight      - *B3* the goal weight supplied
// The rate of loss - supplied
// or 
// the target goal date - supplied
// loss rate        - *B4* determined by one of the two above
// c/f ratio        - *B5* not sure (0.6?)
// buffer           - *B6* not sure (o.oo75?)

// investigate the use of dashboard sliders for input for these
$start_weight = 247.6;
$goal_weight  = 230;
$loss_rate    = 0.05;
$cfratio      = 0.3;
$buffer       = 0.0075;

// load the starting values 
$floor        = $start_weight - ($start_weight * $buffer * 0.5);
  $ceiling      = $start_weight + ($start_weight * $buffer * 0.5);
  $middle       = ($floor + $ceiling)/2;

while($row = mysqli_fetch_assoc($sql))
{
     
    $results['rows'][] = array('c' => array(
        array('v' => $row['id'], 'f' => null),
        array('v' => $row['weight_in_pounds'], 'f' => null),
        array('v' => $floor,   'f' => null),
        array('v' => $ceiling, 'f' => null),
        array('v' => $middle,  'f' => null),
    ));

    // load the values calculated from the previous ones here.
    $floor   = $floor   - ((($floor   - $goal_weight) * $loss_rate));
    $ceiling = $ceiling - ((($ceiling - ( $goal_weight + $goal_weight * $buffer)) * $loss_rate * $cfratio));
    $middle  = ($floor + $ceiling)/2;

};


$json = json_encode($results, JSON_PRETTY_PRINT);
echo $json;

?>
