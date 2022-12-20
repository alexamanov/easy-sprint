<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class EmailDomain extends Constraint
{
    public const SUPPORTED_DOMAIN = 'amasty.com';

    private string $message = 'The email  domain "{{ value }}" is not valid. Only the domain "'
        . self::SUPPORTED_DOMAIN . '" supported';

    public function getMessage(): string
    {
        return $this->message;
    }
}
