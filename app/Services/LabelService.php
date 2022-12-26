<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Label;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;

class LabelService
{
    private function getEntityData($entityType): array
    {
        switch ($entityType) {
            case 'users':
                return [User::class, 'Пользователь'];
            case 'sites':
                return [Site::class, 'Сайт'];
            case 'companies':
                return [Company::class, 'Компания'];
            default:
                abort(response('Переданного типа сущности не существует', 404));
        }
    }

    private function getEntity($entityModel, $entityType, $entityId)
    {
        try {
            return (new $entityModel())->findOrFail($entityId);
        } catch (ModelNotFoundException $exception) {
            abort(response("Сущности {$entityType} с идентификатором {$entityId} не существует", 404));
        }
    }

    public function getLabels($attributes)
    {
        [$entityModel, $correctEntityType] = $this->getEntityData($attributes['entityType']);

        $entity = $this->getEntity($entityModel, $correctEntityType, $attributes['entityId']);

        return $entity->labels()->pluck('name');
    }

    public function updateLabels($attributes): void
    {
        [$entityModel, $correctEntityType] = $this->getEntityData($attributes['entityType']);

        $entity = $this->getEntity($entityModel, $correctEntityType, $attributes['entityId']);

        if (!array_key_exists('labels', $attributes)) {
            abort(response('Не был передан параметр "Лейблы"', 500));
        } else if (
            !empty($attributes['labels'])
            && Label::whereIn('name', $attributes['labels'])->doesntExist()
        ) {
            abort(response('Переданные лейблы не содержатся в базе данных', 404));
        }

        $labelIds = Label::whereIn('name', $attributes['labels'] ?? [])->pluck('id');

        try {
            $entity->labels()->sync($labelIds);
        } catch (\ErrorException $exception) {
            abort(response("Не удалось обновить лейблы у сущности {$correctEntityType} с id {$entity->id}", 500));
        }
    }

    public function addLabels($attributes): void
    {
        [$entityModel, $correctEntityType] = $this->getEntityData($attributes['entityType']);

        $entity = $this->getEntity($entityModel, $correctEntityType, $attributes['entityId']);

        if (Label::whereIn('name', $attributes['labels'])->doesntExist()) {
            abort(response('Переданные лейблы не содержатся в базе данных', 404));
        }

        $labelIds = Label::whereIn('name', $attributes['labels'] ?? [])->pluck('id');

        try {
            $entity->labels()->sync($labelIds, false);
        } catch (\Exception $exception) {
            abort(response("Не удалось добавить лейблы к сущности {$correctEntityType} с id {$entity->id}", 500));
        }
    }

    public function deleteLabels($attributes): void
    {
        [$entityModel, $correctEntityType] = $this->getEntityData($attributes['entityType']);

        $entity = $this->getEntity($entityModel, $correctEntityType, $attributes['entityId']);

        if (Label::whereIn('name', $attributes['labels'])->doesntExist()) {
            abort(response('Переданные лейблы не содержатся в базе данных', 404));
        }

        $labelIds = Label::whereIn('name', $attributes['labels'] ?? [])->pluck('id');

        if ($entity->labels()->whereIn('label_id', $labelIds)->doesntExist()) {
            abort(response("У сущности {$correctEntityType} с идентификатором {$attributes['entityId']} нет подходящих лейблов", 404));
        }

        try {
            $entity->labels()->detach($attributes['labels']);
        } catch (\Exception $exception) {
            abort(response("Не удалось удалить лейблы у сущности {$correctEntityType} с id {$entity->id}", 500));
        }
    }
}
