<?php


namespace Quiz\Controlers;


use Quiz\ActiveUser;
use Quiz\Services\ResultsService;

class ResultsController extends BaseController
{
    /** @var ResultsService $resultsService */
    private $resultsService;

    public function __construct()
    {
        $this->resultsService = new ResultsService();

        parent::__construct();
    }

    public function viewResults()
    {
        if (!ActiveUser::isLoggedIn()) {
            redirect('login');
        }

        return $this->view('results');


    }
}