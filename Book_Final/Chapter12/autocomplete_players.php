<?php
  // For this sample script we'll use another array; in a 
  // real-world app, we'd probably search a database instead.
  $suggestions = array(
    'James Polk'       => "free agent",
    'James Buchanan'   => "free agent",
    'Franklin Pierce'  => "free agent",
    'Millard Filmore'  => "The Big Whigs",
    'Warren Harding'   => "free agent",
    'Chester Arthur'   => "free agent",
    'Rutherford Hayes' => "free agent",
    'Martin Van Buren' => "The Big Whigs"
  );
  
  $value = isset($_REQUEST['player_name']) ? $_REQUEST['player_name'] : "";  
  $matches = array();
  foreach ($suggestions as $name => $team) {
    // Look for a match (case-insensitive).
    // If found, wrap the matching part in a STRONG tag,
    // wrap the whole thing in an LI,
    // and add it to the array of matches.
    if (FALSE !== stripos($name, $value)) {
      $match = preg_replace('/' . preg_quote($value) . '/i',
       "<strong>$0</strong>", $name, 1);
      $matches[] = "<li>${match}<span class='informal'> ${team}</span></li>\n";
    }
  }
  
  // Join the matches into one string, then surround it
  // with a UL tag.
  echo "<ul>\n" . join("", $matches) . "</ul>\n";
?>