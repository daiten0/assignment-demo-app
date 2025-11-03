<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ImageAnalysis Controller
 *
 */
class ImageAnalysisController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        // 初期表示
        $this->set('title', 'AI Image Analysis');
        $this->set('message', 'ここに画像分析機能の説明やフォームを置きます。');
    }

    /**
     * Analyze method
     *
     * @return void
     */
    public function analyze()
    {
        // AI解析API実行
        $this->set('result', '解析結果はここに表示されます。');
    }
}
