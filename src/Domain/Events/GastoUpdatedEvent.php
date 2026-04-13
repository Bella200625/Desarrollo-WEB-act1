<?php
declare(strict_types=1);

require_once __DIR__ . '/DomainEvent.php';
require_once __DIR__ . '/../Models/GastoModel.php';

final class GastoUpdatedEvent extends DomainEvent
{
    private GastoModel $gasto;

    public function __construct(GastoModel $gasto)
    {
        parent::__construct('gasto.updated');
        $this->gasto = $gasto;
    }

    public function payload(): array
    {
        return $this->gasto->toArray();
    }
}