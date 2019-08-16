<?php

namespace Quiz\Repositories;

use Illuminate\Database\Eloquent\Model;
use Quiz\Models\QuizModel;

/**
 * @method QuizModel|null one(array $conditions = [])
 * @method QuizModel[] all(array $conditions = [])
 * @method QuizModel create(array $data) : Model
 */
class QuizRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return QuizModel::class;
    }
}