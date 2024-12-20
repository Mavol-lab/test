<?php

function getPurifier()
{
  $config = HTMLPurifier_Config::createDefault();
  return new HTMLPurifier($config);
}
