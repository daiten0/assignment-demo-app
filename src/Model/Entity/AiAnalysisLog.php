<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AiAnalysisLog Entity
 *
 * @property int $id
 * @property string|null $image_path
 * @property bool $success
 * @property string|null $message
 * @property int|null $class
 * @property string|null $confidence
 * @property \Cake\I18n\DateTime|null $request_timestamp
 * @property \Cake\I18n\DateTime|null $response_timestamp
 */
class AiAnalysisLog extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'image_path' => true,
        'success' => true,
        'message' => true,
        'class' => true,
        'confidence' => true,
        'request_timestamp' => true,
        'response_timestamp' => true,
    ];
}
