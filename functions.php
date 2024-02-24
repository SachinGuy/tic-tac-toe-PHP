<?php

session_start();
error_reporting(E_ERROR | E_PARSE); //SETS which errors to show.

function registerPlayers($playerX = "", $playerO = "") 
{
    $_SESSION['PLAYER_X_NAME'] = $playerX;
    $_SESSION['PLAYER_O_NAME'] = $playerO;
    setTurn('x'); 
    resetBoard(); //Resets Plays count & unsets Board(cells) Values
    resetWins();
}
//Checks if players registered.
function playersRegistered()
{
    return $_SESSION['PLAYER_X_NAME'] && $_SESSION['PLAYER_O_NAME'];
}
//Default Turn is x.
function setTurn($turn = 'x')
{
    $_SESSION['TURN'] = $turn;
}
//Give turn if there's turn otherwise default(x).
function getTurn()
{
    return $_SESSION['TURN'] ? $_SESSION['TURN'] : 'x';
}

function resetBoard() 
{
    //Reset Plays Count
    resetPlaysCount();

    //Reset Board Values
    for( $i = 1; $i < 9; $i++ )
    {
        unset($_SESSION['CELL_' . $i]);
    }
}

function resetPlaysCount()
{
    $_SESSION['PLAYS'] = 0;
}
//RESETs The win of players
function resetWins()
{
    $_SESSION['PLAYER_X_WINS'] = 0;
    $_SESSION['PLAYER_O_WINS'] = 0;
}

function playerName($player='x')
{
    return $_SESSION['PLAYER_' . strtoupper($player) . '_NAME'];
}

function currentPlayer()
{
    return playerName(getTurn());
}