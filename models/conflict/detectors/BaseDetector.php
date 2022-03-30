<?php

namespace app\models\conflict\detectors;

use app\models\conflict\Conflict;
use app\models\conflict\ConflictMember;
use app\models\conflict\ConflictStatus;

abstract class BaseDetector implements ConflictDetector
{
    abstract public function getReason(): string;

    abstract public function getIntersections(): array;

    public function createConflicts()
    {
        foreach ($this->getIntersections() as $intersection) {
            $isAnyEntrantsInConflict = false;
            foreach ($intersection as $entrant) {
                $isAnyEntrantsInConflict =
                    ConflictMember::find()
                        ->where(['entrant_id' => $entrant])
                        ->exists() || $isAnyEntrantsInConflict;
            }
            if ($isAnyEntrantsInConflict) {
                continue;
            }

            $conflict = new Conflict();
            $conflict->status_id = ConflictStatus::OPEN;
            $conflict->reason = $this->getReason();
            if (!$conflict->save()) {
                dd($conflict->errors);
            }

            foreach ($intersection as $entrant) {
                $member = new ConflictMember();
                $member->conflict_id = $conflict->id;
                $member->entrant_id = $entrant->id;
                if (!$member->save()) {
                    dd($member->errors);
                }
            }
        }
    }
}
