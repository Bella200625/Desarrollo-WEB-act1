<?php
declare(strict_types=1);

require_once __DIR__ . '/DomainEvent.php';
require_once __DIR__ . '/../Models/GastoModel.php';

final class GastoDeletedEvent extends DomainEvent
{
    private GastoModel $gasto;

    public function __construct(GastoModel $gasto)
    {
        parent::__construct('gasto.deleted');
        $this->gasto = $gasto;
    }

    public function payload(): array
    {
        return [
            'id' => $this->gasto->id()->value(),
            'deleted_at' => date('Y-m-d H:i:s')
        ];
    }
}