<?php

namespace Blueprint\Models\Statements;

class AuthorizeStatement
{
    /**
     * @var string
     */
    private $reference;

    public function __construct(string $reference)
    {
        $this->reference = $reference;
    }

    public function context($context): string
    {
        switch ($context) {
            case 'show':
                return 'view';

            case 'destroy':
                return 'delete';
        }
        return $context;
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function output(string $context)
    {
        $code = '$this->authorize(';
        $code .= "'" . $this->context($context) . "', ";
        $code .= '$' . str_replace('.', '->', $this->reference());
        $code .= ');';

        return $code;
    }
}
