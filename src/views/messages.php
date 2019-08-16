<?php

use Quiz\Session;

?>


<div class="container">
    <?php if (Session::getInstance()->hasErrors()): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach (Session::getInstance()->getErrors(true) as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if (Session::getInstance()->hasMessages()): ?>
        <div class="alert alert-success" role="alert">
            <ul>
                <?php foreach (Session::getInstance()->getMessage(Session::TYPE_MESSAGE,true) as $message): ?>
                    <li><?= $message; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>