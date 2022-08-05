<?php

namespace App\Http\Repositories\ModelHelpers;

use App\Http\conf\ModelHelpers;
use App\Http\Repositories\UserRepository;

/**
 *
 *
 * @returns string
 */
class CreateSubscriptionModelHelpers extends ModelHelpers
{

    public function __construct($inputs)
    {
        $this->inputs = $inputs;
        $this->execute();
    }

    public function execute()
    {
        $this->results = UserRepository::findWithSubs($this->inputs);
    }



}
