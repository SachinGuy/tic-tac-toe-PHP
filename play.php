<?php
require_once(".templates/headers.php");

if (!playersRegistered())
{
    header("location: index.php");
}

if($_POST['cell'])
{

}
?>

<h2><?php echo currentPlayer() ?>'s turn</h2>