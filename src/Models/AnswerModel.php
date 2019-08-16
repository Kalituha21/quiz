<?php

namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $text
 * @property int $is_correct
 * @property int @question_id
 *
 * @property QuestionModel $question
 */
class AnswerModel extends BaseModel
{
    /** @var string $table */
    public $table = 'answers';

    /**
     * @return HasOne
     */
    public function question()
    {
        return $this->hasOne(QuestionModel::class, 'id', 'question_id');
    }

}