<?php

namespace app\components\helpers\model;

use app\components\helpers\ListHelper;

trait SerializableQueryTrait
{
    protected function listIdFieldName(): string
    {
        return 'id';
    }

    protected function listNameFieldName(): string
    {
        return 'name';
    }

    public function selectList(
        ?string $emptyName = null,
        int $emptyKey = -1
    ): array {
        $list = $this->all();
        if ($emptyName) {
            $list[$emptyKey] = $emptyName;
        }

        return ListHelper::toSelectList(
            $list,
            $this->listIdFieldName(),
            $this->listNameFieldName()
        );
    }

    public function depDropList(
        ?string $emptyName = null,
        int $emptyKey = -1
    ): array {
        $list = $this->all();
        if ($emptyName) {
            $list[$emptyKey] = $emptyName;
        }

        return ListHelper::toDepDropList(
            $list,
            $this->listIdFieldName(),
            $this->listNameFieldName()
        );
    }
}
