<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * ImageAnalysis Controller
 *
 */
class ImageAnalysisController extends AppController
{
    private const SUCCESS = 1;

    /**
     * Index method
     *
     * @return void
     */
    public function index(){}

    /**
     * Analyze method
     *
     * @return void
     */
    public function analyze()
    {
        // フォームから送信されたファイルを取得
        $image = $this->request->getData('image');

        // 存在チェック
        if (!$image || $image->getError() !== UPLOAD_ERR_OK) {
            $this->Flash->error('画像が取得できませんでした。');
            return $this->render('index');
        }

        // MIMEタイプチェック
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($image->getClientMediaType(), $allowedTypes)) {
            $this->Flash->error('JPEG, PNG 以外の画像はアップロードできません。');
            return $this->render('index');
        }

        // ファイルサイズチェック（5MBまで）
        $maxSize = 5 * 1024 * 1024;
        if ($image->getSize() > $maxSize) {
            $this->Flash->error('画像サイズは5MB以下にしてください。');
            return $this->render('index');
        }

        // 保存先ディレクトリ
        $uploadDir = WWW_ROOT . 'uploads' . DS;
        $imagePath = $uploadDir . $image->getClientFilename();

        // インスタンス生成
        $aiAnalysisLogTable = TableRegistry::getTableLocator()->get('AiAnalysisLog');

        // リクエスト前タイムスタンプ
        $requestTimestamp = (new \DateTime())->format('Y-m-d H:i:s.u');

        // AI解析API実行
        $response = $this->mockApi($imagePath);

        // レスポンス後タイムスタンプ
        $responseTimestamp = (new \DateTime())->format('Y-m-d H:i:s.u');

        // レスポンスチェック
        if (!$response['success']) {
            // 失敗
            $this->Flash->error('AI解析APIの実行に失敗しました。');
            return $this->render('index');
        }

        // 保存データ
        $data = [
            'image_path'            => $imagePath,
            'success'               => ImageAnalysisController::SUCCESS,
            'message'               => $response['message'],
            'class'                 => $response['estimated_data']['class'],
            'confidence'            => $response['estimated_data']['confidence'],
            'request_timestamp'     => $requestTimestamp,
            'response_timestamp'    => $responseTimestamp,
        ];
        $aiAnalysisLog = $aiAnalysisLogTable->newEntity($data);

        // 解析結果を格納
        if (!$aiAnalysisLogTable->save($aiAnalysisLog)) {
            // 失敗
            $this->Flash->error('解析結果の保存に失敗しました。');
            return $this->render('index');
        } 

        $this->Flash->success('解析結果を保存しました。');
        return $this->render('index');
    }

    /**
     * mockApi method
     *
     * @return array
     */
    public function mockApi(string $imagePath)
    {
        // 画像ファイルの検証
        if (is_null($imagePath)) {
            return [
                'success' => false,
                'message' => 'Error:E50021',
                'estimated_data' => []
            ];
        }

        // ランダムでエラーを返す（テスト用）
        $rand = random_int(1, 100);
        if ($rand <= 20) {
            return [
                'success' => false,
                'message' => 'Error:E50021',
                'estimated_data' => []
            ];
        }

        // 仮のAI解析結果を生成
        return [
            'success' => true,
            'message' => 'success',
            'estimated_data' => [
                'class' => random_int(1, 10), // ランダムでクラス値を返す（テスト用）
                'confidence' => mt_rand(0, 10000)/10000, // ランダムで確信度を返す（テスト用）
            ],
        ];
    }
}
