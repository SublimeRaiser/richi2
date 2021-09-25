<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
abstract class AbstractAggregateRoot extends AbstractEntity
{
    /**
     * @var EventInterface[]|array
     */
    private array $recordedEvents = [];

    /**
     * Returns recorded events and removes them from the aggregate root.
     *
     * @return array
     */
    public function releaseRecordedEvents(): array
    {
        $recordedEvents       = $this->recordedEvents;
        $this->recordedEvents = [];

        return $recordedEvents;
    }

    /**
     * Records the event of the aggregate root for subsequent release.
     *
     * @param EventInterface $event
     *
     * @throws \LogicException when the event of the same type has already been recorded
     */
    protected function recordEvent(EventInterface $event): void
    {
        if (\in_array($event, $this->recordedEvents)) {
            throw new \LogicException(
                \sprintf('Event of type "%s" already recorded.', get_debug_type($event))
            );
        }
        $this->recordedEvents[] = $event;
    }
}
