<?php
/**
 * @var View $this
 *
 */

use Quiz\ActiveUser;
use Quiz\View;

$userResults = ActiveUser::getResults();
?>


<?php foreach ($userResults as $userResult): ?>
    <h4>
        <?= $userResult->quiz->title; ?>
    </h4>
    <?php foreach ($userResult->userAnswers as $userAnswer): ?>
        <h6>
            <?= $userAnswer->question->text; ?>
        </h6>
        <p>
            You select:  -
            <span class="
            <?php if ((bool) $userAnswer->answer->is_correct): ?>
            bg-success
            <?php else: ?>
            bg-danger
            <?php endif; ?>
            ">
                <?= $userAnswer->answer->text; ?>
            </span>
        </p>

    <?php endforeach; ?>
<?php endforeach; ?>
