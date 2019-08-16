<?php
/**
 * @var View $this
 */

use Quiz\View;


?>

<div class="container"><form action="/registerPost" method="POST">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="name" name="name" class="form-control" id="name">
        </div>
        <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" name="password" class="form-control" id="pwd">
    </div>
    <div class="form-group">
        <label for="pwd">Confirm password:</label>
        <input type="password" name="password_confirmation" class="form-control" id="pwd">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form></div>
