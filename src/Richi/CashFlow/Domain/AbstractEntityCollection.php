<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
abstract class AbstractEntityCollection implements \Countable, \IteratorAggregate
{
    /**
     * @param array $entities
     */
    public function __construct(
        private array $entities = [],
    ) {
        foreach ($entities as $entity) {
            $this->assertValidType($entity);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->entities);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->entities);
    }

    /**
     * Adds the entity to the collection.
     *
     * @param AbstractEntity $entity
     */
    public function add(AbstractEntity $entity): void
    {
        $this->assertValidType($entity);
        $entityId                  = (string) $entity->getId();
        $this->entities[$entityId] = $entity;
    }

    /**
     * Returns the entity by ID. If no entity found, then a \LogicException will be thrown.
     *
     * @param AbstractEntityId $entityId
     *
     * @return AbstractEntity
     *
     * @throws \LogicException when the entity is not found by ID
     */
    public function get(AbstractEntityId $entityId): AbstractEntity
    {
        $entityId = (string) $entityId;
        if (!isset($this->entities[$entityId])) {
            throw new \LogicException(\sprintf(
                'Entity of type %s with ID %s is not found.',
                $this->getSupportedEntityClass(),
                $entityId
            ));
        }

        return $this->entities[$entityId];
    }

    /**
     * Checks whether the entity is contained in the collection.
     *
     * @param AbstractEntity $entity
     *
     * @return bool
     */
    public function contains(AbstractEntity $entity): bool
    {
        return \in_array($entity, $this->entities, true);
    }

    /**
     * Removes the entity from the collection.
     *
     * @param AbstractEntity $entity
     */
    public function remove(AbstractEntity $entity): void
    {
        $entityId = (string) $entity->getId();
        unset($this->entities[$entityId]);
    }

    /**
     * Returns all the entities of this collection that satisfy the predicate p. The order of the entities is preserved.
     *
     * @param \Closure $p
     *
     * @return static
     */
    public function filter(\Closure $p): static
    {
        return new static(\array_filter($this->entities, $p));
    }

    /**
     * Clears the collection, removing all entities.
     */
    public function clear(): void
    {
        $this->entities = [];
    }

    /**
     * Checks whether the collection is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->entities);
    }

    /**
     * Returns all keys (entity IDs) of the collection.
     *
     * @return array
     */
    public function getKeys(): array
    {
        return \array_map(
            function ($entityId) { return (string) $entityId; },
            \array_keys($this->entities)
        );
    }

    /**
     * Returns all values (entities) of the collection.
     *
     * @return array
     */
    public function getValues(): array
    {
        return \array_values($this->entities);
    }

    /**
     * Sets the internal iterator to the first entity in the collection and returns this entity.
     *
     * @return AbstractEntity|null
     */
    public function first(): ?AbstractEntity
    {
        $first = \reset($this->entities);

        return $first ?: null;
    }

    /**
     * Moves the internal iterator position to the next entity and returns this entity.
     *
     * @return AbstractEntity|null
     */
    public function next(): ?AbstractEntity
    {
        $next = \next($this->entities);

        return $next ?: null;
    }

    /**
     * Returns the entity of the collection at the current iterator position.
     *
     * @return AbstractEntity|null
     */
    public function current(): ?AbstractEntity
    {
        $current = \current($this->entities);

        return $current ?: null;
    }

    /**
     * Sets the internal iterator to the last entity in the collection and returns this entity.
     *
     * @return AbstractEntity|null
     */
    public function last(): ?AbstractEntity
    {
        $last = \end($this->entities);

        return $last ?: null;
    }

    /**
     * Returns the name of the supported entity class.
     *
     * @return string
     */
    abstract public function getSupportedEntityClass(): string;

    /**
     * Checks whether the entity is of a type supported by the collection.
     *
     * @param AbstractEntity $entity
     *
     * @throws \InvalidArgumentException when the entity type does not match the collection
     */
    private function assertValidType(AbstractEntity $entity): void
    {
        $supportedEntityClass = $this->getSupportedEntityClass();
        if (!$entity instanceof $supportedEntityClass) {
            throw new \InvalidArgumentException(\sprintf(
                'Invalid type for an entity: expected "%s", "%s" given.',
                $this->getSupportedEntityClass(),
                \get_debug_type($entity)
            ));
        }
    }
}
