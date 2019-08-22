<?php 
/*
Let say we have a csv file which has huge amount of data containing emplyees name, phone number, email, address, job, position, city, oprovience etc.
And we want only data of employees of particular city.
for that we can open a csv file with PHP fopen, read (hugeData.csv)
and then create a new empty csv file which we will also open for writing filtered data.(filteredData.csv)
*/
$csvColumnNames  = array();
$counter = 0;
$row = 0;

if (($openCSVFile = fopen("hugeData.csv", "r")) !== FALSE) {
	$file = fopen('filteredData.csv', 'w');//
	while(($data = fgetcsv($handle, 1000, ",")) !== false) { //https://www.php.net/manual/en/function.fgetcsv.php 
  
    //https://stackoverflow.com/questions/43485787/how-to-get-the-header-value-on-getcsv-in-php
		// Grab the Column names on first iteration
		if ($counter == 0) {
			// store them in an array
			$csvColumnNames = $data;
			// increment counter
			$counter++;                  
		}                
		
		if( $row == 0) {      
			//https://www.php.net/manual/en/function.fputcsv.php
			fputcsv($file, $csvColumnNames);//add Column names in new csv file
		} else { 

			if($data[0] == "abc") {
				fputcsv($file, $data); // add only rows data if above conditions are true
			} 
		} 
		$row++; 
	}
	fclose($file); //close the filteredData.csv
}
?>
