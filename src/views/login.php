<?php
/**
 * @var View $this
 */

use Quiz\View;


?>

<div class="container"><form action="/loginPost" method="POST">
<h1>Logg In</h1>
    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" name="password" class="form-control" id="pwd">
    </div>
    <div class="row">
        <div class="col-8"><button type="submit" class="btn btn-primary">Sing in</button></div>
        <div><a href="/register" class="btn btn-info">Register</a></div>
    </div>
</form></div>
