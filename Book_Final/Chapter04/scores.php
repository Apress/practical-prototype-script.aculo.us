<?php
// scores.php
//
// This mock scoring server runs on a 10-minute cycle, after which scores reset. 
// Clients are expected to poll every 30 seconds.

class Player {
  var $time;
  function Player() {
    global $time;
    $this->time = $time;
  }
}

// QB throws for 10 yards every 30 seconds and a touchdown every four minutes.
class QB extends Player {
  function stats() {
    $yards = floor($this->time / 30) * 10;
    $tds   = floor($this->time / 240);
    
    return array(
      "yards"  => $yards,
      "TD"     => $tds,
      "points" => floor($yards / 25) + (4 * $tds),
      "summary" => $yards . " yards passing, " . $tds . " TD"
    );
  }
}

// RB1 runs for 5 yards every 30 seconds and scores at minute #6.
class RB1 extends Player {
  function stats() {
    $yards = floor($this->time / 30) * 5;
    $tds   = floor($this->time / 360);
    
    return array(
      "yards"   => $yards,
      "TD"      => $tds,
      "points"  => floor($yards / 10) + (6 * $tds),
      "summary" => $yards . " yards rushing, " . $tds . " TD"
    );
  }
}

// RB2 runs for 5 yards every 40 seconds and does not score.
class RB2 extends Player {
  function stats() {
    $yards = floor($this->time / 40) * 5;

    return array(
      "yards"   => $yards,
      "TD"      => 0,
      "points"  => floor($yards / 10),
      "summary" => $yards . " yards rushing, 0 TD"
    );
  }
}

// WR makes one catch every minute for 15 yds and scores at minute #4.
class WR1 extends Player {
  function stats() {
    $yards = floor($this->time / 60) * 15;
    $tds   = $this->time > 240 ? 1 : 0;
    
    return array(
      "yards"   => $yards,
      "TD"      => $tds,
      "points"  => floor($yards / 10) + (6 * $tds),
      "summary" => $yards . " yards receiving, " . $tds . " TD"
    );
  }
}

// WR makes one catch every two minutes for 25 yds and does not score.
class WR2 extends Player {
  function stats() {
    $yards = floor($this->time / 120) * 25;
    
    return array(
      "yards"   => $yards,
      "TD"      => 0,
      "points"  => floor($yards / 10),
      "summary" => $yards . " yards receiving, 0 TD"
    );
  }
}

// TE makes one catch at minute #8 for a TD.
class TE extends Player {
  function stats() {
    $yards = $this->time > 480 ? 20 : 0;
    $tds   = $this->time > 480 ? 1 : 0;
    
    return array(
      "yards"   => $yards,
      "TD"      => $tds,
      "points"  => floor($yards / 10) + (6 * $tds),
      "summary" => $yards . " yards receiving, " . $tds . " TD"
    );
  }
}

// Adds a player's score to a running total; used to 
// compute a team's total score
function score_sum($a, $b) {
  $a += $b["points"];
  return $a;
}

$time = time() % 600; // figure out where we are in the ten-minute interval

$qb  = new QB();
$rb1 = new RB1();
$rb2 = new RB2();
$wr1 = new WR1();
$wr2 = new WR2();
$te  = new TE();

$team1 = array();
$team1["players"] = array(
  "QB"  => $qb->stats(),
  "RB1" => $rb1->stats(),
  "RB2" => $rb1->stats(),
  "WR1" => $wr1->stats(),
  "WR2" => $wr1->stats(),
  "TE"  => $te->stats()
);

$team1["points"] = array_reduce($team1["players"], "score_sum");

$team2 = array();
$team2["players"] = array(
  "QB"  => $qb->stats(),
  "RB1" => $rb1->stats(),
  "RB2" => $rb2->stats(),
  "WR1" => $wr1->stats(),
  "WR2" => $wr2->stats(),
  "TE"  => $te->stats()
);

$team2["points"] = array_reduce($team2["players"], "score_sum");


// deliver it in one large JSON chunk
header("Content-type: application/json");
echo json_encode(array("team_1" => $team1, "team_2" => $team2));
?>