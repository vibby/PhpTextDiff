<?php

namespace PhpTextDiff;

abstract class FineDiffOp
{
    abstract public function getFromLen();
    abstract public function getToLen();
    abstract public function getOpcode();
}
