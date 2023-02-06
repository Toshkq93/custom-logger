<?php

namespace Logger\Drivers;


class FileDriver extends Driver
{
    /** @var string $filePath */
    public $filePath;
    /** @var string $template */
    public $template = "{date} {level} {message} {context}";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!file_exists($this->filePath)) {
            mkdir(dirname($this->filePath));
            touch($this->filePath);
        }
    }

    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = []): void
    {
        file_put_contents($this->filePath, trim(strtr($this->template, [
                '{date}'    => $this->getDate(),
                '{level}'   => $level,
                '{message}' => $message,
                '{context}' => $this->contextStringify($context),
            ])) . PHP_EOL, FILE_APPEND);
    }
}