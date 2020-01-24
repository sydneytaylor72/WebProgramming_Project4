<?php
// Names: Kenton Carrier, Sydney Taylor

ini_set("allow_url_fopen", 1);
$info = file_get_contents('https://www.cs.uky.edu/~paul/public/P4_Sources.json');
$result = json_decode($info);
echo "\n";

// Start html
function start_html() {
	echo "
	<html>
	<head>
	<title>Project4</title>
	</head>
	<body>
	";
}

// End html
function end_html() {
	echo "
	</body>
	</html>
	";
}

// Loop through sources value from url to get sourcedata and fielddata
foreach ($result->sources as $key => $value) {
  $sourcejson[$key] = $value->name;
  $searchfields[$key] = $value->searchfields;
  $l = 0;
  // Loop through the searchfields for all the values
  for ($i = 0; $i < count($searchfields); $i++) {
    // Loop through the searchfields for each individual value
    for ($f = 0; $f < count($searchfields[$i]); $f++) {
      $fielddata[$l] = $searchfields[$i][$f];
      $l++;
    }
  }
  echo "\n";
}

// Display form
start_html();
if (!isset($_GET['sourcedata']) && !isset($_GET['fielddata'])) {
echo $result->title;
?>
<form>
<select name="sourcedata" type="text" id="source" class="required">
	<option disabled value>-- Select One --</option>
<?php foreach($sourcejson as $source): ?>
  <option><?php echo $source; ?></option>
<?php endforeach; ?>
</select>
<br><select name="fielddata" type="text" id="field" class="required">
	<option disabled selected value>-- Select One --</option>
<?php foreach($fielddata as $field): ?>
  <option><?php echo $field; ?></option>
<?php endforeach; ?>
</select>
<br><select name="findorsort" type="text" id="field" class="required">
	<option disabled selected value>-- Select One --</option>
  <option value="Find">Find</option>
  <option value="Sort">Sort</option>
</select>
<br>What to Find: <input type="text" name="whattofind">
<br><input type='submit' value='Do it!'>
</form>

<?php
// If the user has chosen a value for sourcedata, print the report
} elseif (isset($_GET['sourcedata'])) {
  // Loop through sources from original url to get keys and values
  foreach ($result->sources as $key => $value) {
    // If the name field of the value matches the name chosen by the user, 
    // get the url and groupfields
    if ($value->name == $_GET['sourcedata']) {
      $url = $value->url;
      $groupfields = $value->groupfields;
    }
  }
  $sources = file_get_contents($url);
  $sourceresult = json_decode($sources, true);
  // If there is an error in the json decode, print an error message
  if (json_last_error() != JSON_ERROR_NONE) {
    print("Invalid URL.");
  }
  // Loop through the groupfields for the user's chosen sourcedata
  for ($i = 0; $i < count($groupfields); $i++) {
    $group = $groupfields[$i];
    $field = $sourceresult[$group];
    // Loop through the field values to get the keys and values
    foreach ($field as $newkey => $newvalue) {
      // If the value is an array, print the key and loop through the values
      // Else, print the values
      if (is_array($newvalue)) {
        print($newkey);
        echo ":";
	echo "<br>";
	// Loop through the values of the array and get the keys and values
        foreach ($newvalue as $arraykey => $arrayvalue) {
          print($arraykey);
          echo ": ";
          print($arrayvalue);
          echo "<br>";
        }
      } else {
        print($newvalue);
        echo "<br>";
      }
    }
    echo "<br>";
    echo "<br>";
  }
} 

end_html();
?>
