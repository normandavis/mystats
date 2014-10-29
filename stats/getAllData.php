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
        array('label' => 'id',               'type' => 'number'),
        array('label' => 'when',             'type' => 'string'),
        array('label' => 'weight_in_pounds', 'type' => 'number'),
        array('label' => 'systolic',         'type' => 'number'),
        array('label' => 'diastolic',        'type' => 'number'),
        array('label' => 'pulse',            'type' => 'number'),
        array('label' => 'comment',          'type' => 'string'),
    ),
    'rows' => array()
);

while($row = mysqli_fetch_assoc($sql))
{
    $results['rows'][] = array('c' => array(
        array('v' => $row['id'],               'f' => null),
        array('v' => $row['when'],             'f' => null),
        array('v' => $row['weight_in_pounds'], 'f' => null),
        array('v' => $row['systolic'],         'f' => null),
        array('v' => $row['diastolic'],        'f' => null),
        array('v' => $row['pulse'],            'f' => null),
        array('v' => $row['comment'],          'f' => null),
    ));
};

$json = json_encode($results, JSON_PRETTY_PRINT);
echo $json;

?>
