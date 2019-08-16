<?php
/**
 * @var View $this
 *
 */

use Quiz\ActiveUser;
use Quiz\View;

$userName = ActiveUser::getLoggedInUser()->name;

?>

<div class="row">
    <div class="col-md-12">

        <quiz :name='<?= json_encode($userName)?>' :quizzes-prop='<?= json_encode($quizData)?>'></quiz>
    </div>
</div>
