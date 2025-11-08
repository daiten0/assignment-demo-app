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
            ->maxLength('image_path', 255, 'image_pathは255文字までです。')
            ->allowEmptyString('image_path');

        $validator
            ->boolean('success', 'successは0または1を指定してください。')
            ->requirePresence('success', 'create', 'successは必須パラメータです。')
            ->notEmptyString('success', 'successは必須パラメータです。');

        $validator
            ->scalar('message')
            ->maxLength('message', 255, 'messageは255文字までです。')
            ->allowEmptyString('message');

        $validator
            ->integer('class', 'classは整数で指定してください。')
            ->add('class', 'maxDigits', [
                'rule' => function ($value) {
                    return strlen((string)abs((int)$value)) <= 11;
                },
                'message' => 'classは最大11桁までです。'
            ])
            ->allowEmptyString('class');

        $validator
            ->add('confidence', 'validLength', [
                'rule' => function ($value) {
                    // 整数＋小数点＋小数 = 合計5桁以内か確認
                    if (!is_numeric($value)) {
                        return false;
                    }
                    // 小数点を除いた桁数をチェック
                    $digits = strlen(str_replace('.', '', (string)$value));
                    return $digits <= 5;
                },
                'message' => 'confidenceは最大5桁（うち小数4桁）で指定してください。'
            ])
            ->allowEmptyString('confidence');

        $validator
            ->add('request_timestamp', 'validFormat', [
                'rule' => function ($value) {
                    if (empty($value)) {
                        return true;
                    }
                    // マイクロ秒6桁付きの日時 (例: 2025-11-09 23:12:19.109514)
                    return preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d{6}$/',$value) === 1;
                },
                'message' => 'request_timestampは「YYYY-MM-DD HH:MM:SS.######」形式で指定してください。'
            ])
            ->allowEmptyDateTime('request_timestamp');

        $validator
            ->add('response_timestamp', 'validFormat', [
                'rule' => function ($value) {
                    if (empty($value)) {
                        return true;
                    }
                    // マイクロ秒6桁付きの日時 (例: 2025-11-09 23:12:19.109514)
                    return preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d{6}$/',$value) === 1;
                },
                'message' => 'response_timestampは「YYYY-MM-DD HH:MM:SS.######」形式で指定してください。'
            ])
            ->allowEmptyDateTime('response_timestamp');

        return $validator;
    }
}
