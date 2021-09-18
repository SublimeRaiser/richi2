<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
abstract class AbstractDomainEntityCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var AbstractDomainEntity[]|array
     */
    private array $entities;

    /**
     * @param array $entities
     */
    public function __construct(array $entities = [])
    {
        foreach ($entities as $entity) {
            $this->assertValidType($entity);
        }
        $this->entities = $entities;
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
     * @param AbstractDomainEntity $entity
     */
    public function add(AbstractDomainEntity $entity): void
    {
        $this->assertValidType($entity);
        $entityId                  = (string) $entity->getId();
        $this->entities[$entityId] = $entity;
    }

    /**
     * Returns the entity by ID. If no entity found, then a \LogicException will be thrown.
     *
     * @param AbstractDomainEntityId $entityId
     *
     * @return AbstractDomainEntity
     *
     * @throws \LogicException when the entity is not found by ID
     */
    public function get(AbstractDomainEntityId $entityId): AbstractDomainEntity
    {
        $entityId = (string) $entityId;
        if (!isset($this->entities[$entityId])) {
            throw new \LogicException(\sprintf(
                'Entity of type %s with ID %s is not found.',
                $this->getEntityClass(),
                $entityId
            ));
        }

        return $this->entities[$entityId];
    }

    /**
     * Checks whether the entity is contained in the collection.
     *
     * @param AbstractDomainEntity $entity
     *
     * @return bool
     */
    public function contains(AbstractDomainEntity $entity): bool
    {
        return \in_array($entity, $this->entities, true);
    }

    /**
     * Removes the entity from the collection.
     *
     * @param AbstractDomainEntity $entity
     */
    public function remove(AbstractDomainEntity $entity): void
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
     * @return AbstractDomainEntity|null
     */
    public function first(): ?AbstractDomainEntity
    {
        $first = \reset($this->entities);

        return $first ?: null;
    }

    /**
     * Moves the internal iterator position to the next entity and returns this entity.
     *
     * @return AbstractDomainEntity|null
     */
    public function next(): ?AbstractDomainEntity
    {
        $next = \next($this->entities);

        return $next ?: null;
    }

    /**
     * Returns the entity of the collection at the current iterator position.
     *
     * @return AbstractDomainEntity|null
     */
    public function current(): ?AbstractDomainEntity
    {
        $current = \current($this->entities);

        return $current ?: null;
    }

    /**
     * Sets the internal iterator to the last entity in the collection and returns this entity.
     *
     * @return AbstractDomainEntity|null
     */
    public function last(): ?AbstractDomainEntity
    {
        $last = \end($this->entities);

        return $last ?: null;
    }

    /**
     * Returns the name of the entity class.
     *
     * @return string
     */
    abstract public function getEntityClass(): string;

    /**
     * Checks whether the entity is of a type supported by the collection.
     *
     * @param AbstractDomainEntity $entity
     *
     * @throws \InvalidArgumentException when the entity type does not match the collection
     */
    private function assertValidType(AbstractDomainEntity $entity): void
    {
        if (\get_class($entity) !== $this->getEntityClass()) {
            throw new \InvalidArgumentException(\sprintf(
                'Invalid type for an entity: expected "%s", "%s" given.',
                $this->getEntityClass(),
                \get_debug_type($entity)
            ));
        }
    }
}
