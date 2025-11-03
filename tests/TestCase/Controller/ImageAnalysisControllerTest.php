<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ImageAnalysisController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ImageAnalysisController Test Case
 *
 * @link \App\Controller\ImageAnalysisController
 */
class ImageAnalysisControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.ImageAnalysis',
    ];

    /**
     * Test index method
     *
     * @return void
     * @link \App\Controller\ImageAnalysisController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test analyze method
     *
     * @return void
     * @link \App\Controller\ImageAnalysisController::analyze()
     */
    public function testAnalyze(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
