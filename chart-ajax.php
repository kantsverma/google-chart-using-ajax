<?php 
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "googlechart";

// Create connection
$con=mysql_connect($servername,$username,$password);
mysql_select_db('googlechart') ;

if($_POST['formType'] > 1){
  $result = mysql_query("SELECT * FROM chart where form_id ='".$_POST['formType']."'");  
}else{  
  $result = mysql_query("SELECT * FROM chart where form_id ='1'");
}

    $rows = array();
    $table = array();
    $table['cols'] = array(

      // Labels for your chart, these represent the column titles.
      /* 
          note that one column is in "string" format and another one is in "number" format 
          as pie chart only required "numbers" for calculating percentage 
          and string will be used for Slice title
      */

      array('label' => 'Weekly Task', 'type' => 'string'),
      array('label' => 'Percentage', 'type' => 'number')

    );
   
   while($row = mysql_fetch_array($result)){ 
	    $temp = array();

      // The following line will be used to slice the Pie chart

      $temp[] = array('v' => (string) $row['weekly_task']); 

      // Values of the each slice

      $temp[] = array('v' => (int) $row['percentage']); 
      $rows[] = array('c' => $temp);
    }
     
$table['rows'] = $rows;

// convert data into JSON format
$jsonTable = json_encode($table);
echo $jsonTable;

?>
