<?php

namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 *
 * @property QuestionModel[] $questions
 * @property AttemptModel[] $attempts
 */
class QuizModel extends BaseModel
{
    /** @var string $table */
    public $table = 'quizzes';

    /**
     * @return HasMany
     */
    public function questions()
    {
        return $this->hasMany(QuestionModel::class, 'quiz_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function attempts()
    {
        return $this->hasMany(AttemptModel::class, 'quiz_id', 'id');
    }
}