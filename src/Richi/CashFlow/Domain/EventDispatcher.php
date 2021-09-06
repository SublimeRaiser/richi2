<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var callable[][]|array
     */
    private array $listeners = [];

    /**
     * {@inheritdoc}
     */
    public function addListener(string $eventClassName, callable $listener): void
    {
        if (!isset($this->listeners[$eventClassName])) {
            $this->listeners[$eventClassName] = [];
        }
        if (in_array($listener, $this->listeners[$eventClassName])) {
            throw new \LogicException(
                \sprintf(
                    'This event listener of type "%s" for event %s already added.',
                    get_debug_type($listener),
                    $eventClassName
                )
            );
        }
        $this->listeners[$eventClassName][] = $listener;
    }

    /**
     * {@inheritdoc}
     */
    public function removeListener(string $eventClassName, callable $listener): void
    {
        if (!isset($this->listeners[$eventClassName])) {
            return;
        }
        $key = \array_search($listener, $this->listeners[$eventClassName]);
        if ($key !== false) {
            unset($this->listeners[$eventClassName][$key]);
            $this->listeners[$eventClassName] = \array_values($this->listeners[$eventClassName]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getListenersForEvent(object $event): array
    {
        $listenersForEvent = [];
        foreach ($this->listeners as $eventClassName => $listeners) {
            if (!$event instanceof $eventClassName) {
                continue;
            }
            foreach ($listeners as $listener) {
                $listenersForEvent[] = $listener;
            }
        }

        return $listenersForEvent;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(object ...$events): void
    {
        foreach ($events as $event) {
            foreach ($this->getListenersForEvent($event) as $listener) {
                $listener($event);
            }
        }
    }
}
