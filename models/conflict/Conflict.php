<?php

namespace app\models\conflict;

use app\models\entrant\Entrant;

interface Conflict
{
    public function getReason(): string;

    public function getEntrants(): array;
}
