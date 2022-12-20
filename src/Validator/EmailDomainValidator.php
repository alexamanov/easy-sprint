<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailDomainValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var EmailDomain $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        if (EmailDomain::SUPPORTED_DOMAIN !== $this->getEmailDomain($value)) {
            $this->context->buildViolation($constraint->getMessage())
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    private function getEmailDomain(string $email): string
    {
        $parts = explode('@', $email);

        return array_pop($parts);
    }
}
