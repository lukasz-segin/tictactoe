<?php

require "vendor/autoload.php";
echo "<PRE>" . PHP_EOL;

function getResult(\Foo\ClassicTicTacToe $ticTacToe)
{
    if ($ticTacToe->isEnded()) {
        if ($ticTacToe->isTied()) {
            return "Remis";
        }
        return "Wygrana: " . $ticTacToe->getWinner();
    }
    return "Gramy dalej";
}

$ticTacToe = new \Foo\ClassicTicTacToe();
$ticTacToe->putX(0, 1);
echo "X na 0,0 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putO(0, 2);
echo "O na 0,2 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putX(2, 2);
echo "X na 2,2 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putO(1, 1);
echo "O na 1,1 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putX(2, 0);
echo "X na 2,0 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putO(2, 1);
echo "O na 2,1 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putX(1, 0);
echo "X na 1,0 | " . getResult($ticTacToe) . PHP_EOL;

echo '<br/>get X<br/>';
echo print_r($ticTacToe->getX());
echo '<br/><br/>get O<br/>';
echo print_r($ticTacToe->getO());
$a = array();
for($i=0;$i<9;$i++) {
  $a[$i][0] = 0;
  $a[$i][1] = 0;
}

print_r($a);

