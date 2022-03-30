<?php

namespace app\models\conflict\detectors;

interface ConflictDetector
{
    public function getReason(): string;

    public function getIntersections(): array;

    public function createConflicts();
}
