<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AiAnalysisLogFixture
 */
class AiAnalysisLogFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'ai_analysis_log';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'image_path' => 'Lorem ipsum dolor sit amet',
                'success' => 1,
                'message' => 'Lorem ipsum dolor sit amet',
                'class' => 1,
                'confidence' => 1.5,
                'request_timestamp' => '',
                'response_timestamp' => '',
            ],
        ];
        parent::init();
    }
}
