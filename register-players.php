<?php
require_once("functions.php");

registerPlayers($_POST['player-x'], $_POST['players-o']);

if(playersRegistered())
{
    header("location: play.php");
}