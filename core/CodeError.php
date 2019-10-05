<?php
namespace Core;

interface CodeError
{
    const NOT_INIT_APP = -1;
    const NOT_ROUTE = 1;
    const NOT_FOUND_SERVICE = 2;
    const NOT_FOUND_API_KEY_SERVICE = 3;
    const EMPTY_METHOD = 4;
    const NOT_FOUND_METHOD = 5;
}