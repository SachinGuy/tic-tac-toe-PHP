<?php

session_start();
error_reporting(E_ERROR | E_PARSE); //SETS which errors to show.

function registerPlayers($playerX="", $playerO="") {
    $_SESSION['PLAYER_X_NAME'] = $playerX;
    $_SESSION['PLAYER_O_NAME'] = $playerO;
    setTurn('x');
    resetBoard();
    resetWins();
}
//Checks if players registered.
function playersRegistered() {
    return $_SESSION['PLAYER_X_NAME'] && $_SESSION['PLAYER_O_NAME'];
}
//Default Turn is x.
function setTurn($turn='x') {
    $_SESSION['TURN'] = $turn;
}
//Give turn if there's turn otherwise default(x).
function getTurn() {
    return $_SESSION['TURN'] ? $_SESSION['TURN'] : 'x';
}

function getCell($cell='') {
    return $_SESSION['CELL_' . $cell];
}
function resetBoard() {
    resetPlaysCount();

    for ( $i = 1; $i <= 9; $i++ ) {
        unset($_SESSION['CELL_' . $i]);
    }
}

function resetPlaysCount() {
    $_SESSION['PLAYS'] = 0;
}
//RESETs The win of players
function resetWins() {
    $_SESSION['PLAYER_X_WINS'] = 0;
    $_SESSION['PLAYER_O_WINS'] = 0;
}
function playerName($player='x') {
    return $_SESSION['PLAYER_' . strtoupper($player) . '_NAME'];

}

function currentPlayer() {
    return playerName(getTurn());
}

function play($cell='') {
    //Checks if cell is already played
    if (getCell($cell)) {
        return false;
    }

    $_SESSION['CELL_' . $cell] = getTurn();
    addPlaysCount();
    $win = playerPlayWin($cell);

    if (! $win) {
        switchTurn();
    }
    else {
        markWin(getTurn());
        resetBoard();
    }

    return $win;
}

function playerPlayWin($cell=1) {
    if (playsCount() < 3) {
        return false;
    }

    $column = $cell % 3;
    //If it's the last column cell.
    if (! $column) {
        $column = 3;
    }

    $row = ceil($cell / 3);

    $player = getTurn();

    return isVerticalWin($column, $player) || isHorizontalWin($row, $player) || isDiagonalWin($player);
}
function isVerticalWin($column=1, $turn='x') {
    return getCell($column) == $turn &&
        getCell($column + 3) == $turn &&
        getCell($column + 6) == $turn;
}

function isHorizontalWin($row=1, $turn='x') {
    return getCell(($row - 1) * 3 + 1) == $turn &&
        getCell(($row - 1) * 3 + 2) == $turn &&
        getCell(($row - 1) * 3 + 3) == $turn;
}

function isDiagonalWin($turn='x') {
    $win = getCell(1) == $turn &&
        getCell(9) == $turn;

    if (! $win) {
        $win = getCell(3) == $turn &&
            getCell(7) == $turn;
    }

    return $win && getCell(5) == $turn;
}

function switchTurn() {
    switch (getTurn()) {
        case 'x':
            setTurn('o');
            break;
        default:
            setTurn('x');
            break;
    }
}

//Increases Wins of players.
function markWin($player='x') {
    $_SESSION['PLAYER_' . strtoupper($player) . '_WINS']++;
}

function playsCount() {
    return $_SESSION['PLAYS'] ? $_SESSION['PLAYS'] : 0;
}

function addPlaysCount() {
    if (! $_SESSION['PLAYS']) {
        $_SESSION['PLAYS'] = 0;
    }

    $_SESSION['PLAYS']++;
}
function score($player='x') {
    $score = $_SESSION['PLAYER_' . strtoupper($player) . '_WINS'];
    return $score ? $score : 0;
}
