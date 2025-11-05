<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AiAnalysisLog Model
 *
 * @method \App\Model\Entity\AiAnalysisLog newEmptyEntity()
 * @method \App\Model\Entity\AiAnalysisLog newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\AiAnalysisLog> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AiAnalysisLog get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\AiAnalysisLog findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\AiAnalysisLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\AiAnalysisLog> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AiAnalysisLog|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\AiAnalysisLog saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\AiAnalysisLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AiAnalysisLog>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AiAnalysisLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AiAnalysisLog> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AiAnalysisLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AiAnalysisLog>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AiAnalysisLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AiAnalysisLog> deleteManyOrFail(iterable $entities, array $options = [])
 */
class AiAnalysisLogTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('ai_analysis_log');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('image_path')
            ->maxLength('image_path', 255)
            ->allowEmptyString('image_path');

        $validator
            ->boolean('success')
            ->requirePresence('success', 'create')
            ->notEmptyString('success');

        $validator
            ->scalar('message')
            ->maxLength('message', 255)
            ->allowEmptyString('message');

        $validator
            ->integer('class')
            ->allowEmptyString('class');

        $validator
            ->decimal('confidence')
            ->allowEmptyString('confidence');

        $validator
            ->dateTime('request_timestamp')
            ->allowEmptyDateTime('request_timestamp');

        $validator
            ->dateTime('response_timestamp')
            ->allowEmptyDateTime('response_timestamp');

        return $validator;
    }
}
