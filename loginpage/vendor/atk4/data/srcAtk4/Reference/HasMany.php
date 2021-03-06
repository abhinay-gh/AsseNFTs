<?php

declare(strict_types=1);

namespace Atk4\Data\Reference;

use atk4\data\Exception;
use atk4\data\Field;
use atk4\data\Model;
use atk4\data\Reference;

/**
 * Reference\HasMany class.
 */
class HasMany extends Reference
{
    /**
     * Returns our field value or id.
     *
     * @return mixed
     */
    protected function getOurValue()
    {
        $ourModel = $this->getOurModel();

        if ($ourModel->loaded()) {
            return $this->our_field
                ? $ourModel->get($this->our_field)
                : $ourModel->getId();
        }

        // create expression based on existing conditions
        return $ourModel->action('field', [
            $this->getOurFieldName(),
        ]);
    }

    /**
     * Returns our field or id field.
     */
    protected function referenceOurValue(): Field
    {
        $ourModel = $this->getOurModel();

        $ourModel->persistence_data['use_table_prefixes'] = true;

        return $this->getOurField();
    }

    /**
     * Returns referenced model with condition set.
     */
    public function ref(array $defaults = []): Model
    {
        $ourModel = $this->getOurModel();

        return $this->getTheirModel($defaults)->addCondition(
            $this->their_field ?: ($ourModel->table . '_' . $ourModel->id_field),
            $this->getOurValue()
        );
    }

    /**
     * Creates model that can be used for generating sub-query actions.
     */
    public function refLink(array $defaults = []): Model
    {
        $ourModel = $this->getOurModel();

        $theirModelLinked = $this->getTheirModel($defaults)->addCondition(
            $this->their_field ?: ($ourModel->table . '_' . $ourModel->id_field),
            $this->referenceOurValue()
        );

        return $theirModelLinked;
    }

    /**
     * Adds field as expression to our model.
     * Used in aggregate strategy.
     */
    public function addField(string $fieldName, array $defaults = []): Field
    {
        if (!isset($defaults['aggregate']) && !isset($defaults['concat']) && !isset($defaults['expr'])) {
            throw (new Exception('Aggregate field requires "aggregate", "concat" or "expr" specified to hasMany()->addField()'))
                ->addMoreInfo('field', $fieldName)
                ->addMoreInfo('defaults', $defaults);
        }

        $defaults['aggregate_relation'] = $this;

        $alias = $defaults['field'] ?? null;
        $field = $alias ?? $fieldName;

        if (isset($defaults['concat'])) {
            $defaults['aggregate'] = $this->getOurModel()->dsql()->groupConcat($field, $defaults['concat']);
            $defaults['read_only'] = false;
            $defaults['never_save'] = true;
        }

        if (isset($defaults['expr'])) {
            $fx = function () use ($defaults, $alias) {
                $theirModelLinked = $this->refLink();

                return $theirModelLinked->action('field', [$theirModelLinked->expr(
                    $defaults['expr'],
                    $defaults['args'] ?? []
                ), 'alias' => $alias]);
            };
            unset($defaults['args']);
        } elseif (is_object($defaults['aggregate'])) {
            $fx = function () use ($defaults, $alias) {
                return $this->refLink()->action('field', [$defaults['aggregate'], 'alias' => $alias]);
            };
        } elseif ($defaults['aggregate'] === 'count' && !isset($defaults['field'])) {
            $fx = function () use ($defaults, $alias) {
                return $this->refLink()->action('count', ['alias' => $alias]);
            };
        } elseif (in_array($defaults['aggregate'], ['sum', 'avg', 'min', 'max', 'count'], true)) {
            $fx = function () use ($defaults, $field) {
                return $this->refLink()->action('fx0', [$defaults['aggregate'], $field]);
            };
        } else {
            $fx = function () use ($defaults, $field) {
                return $this->refLink()->action('fx', [$defaults['aggregate'], $field]);
            };
        }

        return $this->getOurModel()->addExpression($fieldName, array_merge([$fx], $defaults));
    }

    /**
     * Adds multiple fields.
     *
     * @see addField()
     *
     * @return $this
     */
    public function addFields(array $fields = [])
    {
        foreach ($fields as $defaults) {
            $fieldName = $defaults[0];
            unset($defaults[0]);
            $this->addField($fieldName, $defaults);
        }

        return $this;
    }
}
