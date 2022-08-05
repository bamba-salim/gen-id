<?php

namespace App\Http\conf;


abstract class ModelHelpers implements ModelHelpersInterface
{
    protected $inputs;
    public $results;

    /**
     * @return mixed
     */
    public function getInputs()
    {
        return $this->inputs;
    }

    /**
     * @param mixed $inputs
     */
    public function setInputs($inputs): void
    {
        $this->inputs = $inputs;
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param mixed $results
     */
    public function setResults($results): void
    {
        $this->results = $results;
    }


}
