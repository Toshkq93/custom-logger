<?php

namespace Logger\Drivers;

use DateTime;
use Psr\Log\AbstractLogger;

abstract class Driver extends AbstractLogger
{
    /** @var string $dateFormat */
    public $dateFormat = DateTime::RFC2822;

    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return (new DateTime())->format($this->dateFormat);
    }

    /**
     * @param array $context
     * @return false|string|null
     */
    public function contextStringify(array $context = [])
    {
        return !empty($context) ? json_encode($context) : null;
    }
}