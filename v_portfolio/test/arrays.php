<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$id_sizes = array( "1"=>"2","4"=>"1","1"=>"0","4"=>"2" );
//$id_sizesA = array();
$id_sizes_json = "[";

foreach( $id_sizes as $key=>$val ){
	
	$id_sizes_json .= "{'iid': '" . $key . "', 'size': " . $val . "}"; 
	end($id_sizes);
	if( $key !== key($id_sizes) ){
		$id_sizes_json .= ",";
	}
}

$id_sizes_json .= "]";

echo $id_sizes_json;


//print_r(array_values($id_sizes));

/*$ids = array('3', '4', '4', '3', '1', '7');
$sizes = array('0', '1', '2', '2', '0', '2');
$id_sizes = array_combine($ids, $sizes);

print_r($id_sizes);

foreach($array as $key => $element) {
    reset($array);
    if ($key === key($array))
        echo 'FIRST ELEMENT!';

    end($array);
    if ($key === key($array))
        echo 'LAST ELEMENT!';
}

 if ($key === array_key_first($array))
        echo 'FIRST ELEMENT!';

    if ($key === array_key_last($array))
        echo 'LAST ELEMENT!';

*/

?>