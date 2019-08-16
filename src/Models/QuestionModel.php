<?php

namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $text
 * @property int @quiz_id
 *
 * @property QuizModel $quiz
 * @property AnswerModel[] $answers
 */
class QuestionModel extends BaseModel
{
    /** @var string $table */
    public $table = 'questions';

    /**
     * @return HasOne
     */
    public function quiz()
    {
        return $this->hasOne(QuizModel::class, 'id', 'quiz_id');
    }

    /**
     * @return HasMany
     */
    public function answers()
    {
        return $this->hasMany(AnswerModel::class, 'question_id', 'id');
    }
}