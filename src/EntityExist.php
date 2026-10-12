<?php

declare(strict_types=1);

namespace Happyr\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class EntityExist extends Constraint
{
    /**
     * Readable violation code: API clients can translate it without parsing the
     * message. Symfony's own constraints use UUIDs; a readable name is easier to
     * act upon.
     */
    public const NOT_FOUND_ERROR = 'ENTITY_NOT_FOUND';

    protected const ERROR_NAMES = [
        self::NOT_FOUND_ERROR => 'NOT_FOUND_ERROR',
    ];

    /**
     * Neutral on purpose: the previous default exposed the entity class name to
     * API clients. `%entity%`, `%property%` and `%value%` are still available to
     * a custom message.
     */
    public $message = 'This value does not exist.';
    public $property = 'id';
    public $entity;

    public function __construct(?string $entity = null, ?string $property = null, ?string $message = null, mixed $options = null, ?array $groups = null, mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);

        $this->entity = $entity ?? $this->entity;
        $this->property = $property ?? $this->property;
        $this->message = $message ?? $this->message;
    }
}
