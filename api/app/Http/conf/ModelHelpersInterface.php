<?php

namespace App\Http\conf;

interface ModelHelpersInterface
{
    function __construct($inputs);
    function execute();
}
