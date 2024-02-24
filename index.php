<?php
require_once("./templates/header.php");
?>

<form action="register-players.php" method="post">
    <div class="welcome">
        <h1>Start Playing Tic Tac Toe</h1>
        <h2>Please Fill in your names</h2>

        <div class="player-name">
            <label for="player-x">First Player (x)</label>
            <input type="text" name="player-x" id="player-x" required>
        </div>

        <div class="player-name">
            <label for="player-o">First Player (o)</label>
            <input type="text" name="player-o" id="player-o" required>
        </div>

        <button type="submit">Start</button>
    </div>
</form>

<?php
require_once("./templates/footer.php");