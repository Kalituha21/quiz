<?php

namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $attempt_id
 * @property int @question_id
 * @property int @answer_id
 *
 * @property AttemptModel @attempt
 * @property QuestionModel $question
 * @property AnswerModel $answer
 */
class UserAnswersModel extends BaseModel
{
    /** @var string $table */
    public $table = 'user_answers';

    /** @var array $guarded */
    public $guarded = [];


    /**
     * @return HasOne
     */
    public function attempt()
    {
        return $this->hasOne(AttemptModel::class, 'id', 'attempt_id');
    }

    /**
     * @return HasOne
     */
    public function question()
    {
        return $this->hasOne(QuestionModel::class, 'id', 'question_id');
    }

    /**
     * @return HasOne
     */
    public function answer()
    {
        return $this->hasOne(AnswerModel::class, 'id', 'answer_id');
    }
}