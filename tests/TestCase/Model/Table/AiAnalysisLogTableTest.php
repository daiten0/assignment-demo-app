<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AiAnalysisLogTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AiAnalysisLogTable Test Case
 */
class AiAnalysisLogTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AiAnalysisLogTable
     */
    protected $AiAnalysisLog;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.AiAnalysisLog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AiAnalysisLog') ? [] : ['className' => AiAnalysisLogTable::class];
        $this->AiAnalysisLog = $this->getTableLocator()->get('AiAnalysisLog', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AiAnalysisLog);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\AiAnalysisLogTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
