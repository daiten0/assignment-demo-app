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
            return $this->renderError('画像が取得できませんでした。');
        }

        // MIMEタイプチェック
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($image->getClientMediaType(), $allowedTypes)) {
            return $this->renderError('JPEG, PNG 以外の画像はアップロードできません。');
        }

        // ファイルサイズチェック（5MBまで）
        $maxSize = 5 * 1024 * 1024;
        if ($image->getSize() > $maxSize) {
            return $this->renderError('画像サイズは5MB以下にしてください。');
        }

        // 保存先ディレクトリ
        $uploadDir = WWW_ROOT . 'uploads' . DS;
        $imagePath = $uploadDir . $image->getClientFilename();

        // インスタンス生成
        $aiAnalysisLogTable = $this->fetchTable('AiAnalysisLog');

        // リクエスト前タイムスタンプ
        $requestTimestamp = (new \DateTime())->format('Y-m-d H:i:s.u');

        // AI解析API実行
        $response = $this->mockApi($imagePath);

        // レスポンス後タイムスタンプ
        $responseTimestamp = (new \DateTime())->format('Y-m-d H:i:s.u');

        // レスポンスチェック
        if (!$response['success']) {
            // 失敗
            return $this->renderError('AI解析APIの実行に失敗しました。');
        }

        // 解析データ
        $data = [
            'image_path'            => $imagePath,
            'success'               => self::SUCCESS,
            'message'               => $response['message'],
            'class'                 => $response['estimated_data']['class'],
            'confidence'            => $response['estimated_data']['confidence'],
            'request_timestamp'     => $requestTimestamp,
            'response_timestamp'    => $responseTimestamp,
        ];
        // バリデーション
        $aiAnalysisLog = $aiAnalysisLogTable->newEntity($data);
        $errorMessage = '';
        if ($aiAnalysisLog->getErrors()) {
            $errors = $aiAnalysisLog->getErrors();
            foreach ($errors as $field => $fieldErrors) {
                foreach ($fieldErrors as $rule => $message) {
                    $errorMessage = $errorMessage . "{$message}<br>";
                }
            }
            return $this->renderError($errorMessage);
        }

        // 解析結果を保存
        try {
            if (!$aiAnalysisLogTable->save($aiAnalysisLog)) {
                return $this->renderError('解析結果の保存に失敗しました。');
            } 
        } catch (\Throwable $e) {
            return $this->renderError($e->getMessage());
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

    private function renderError(string $message)
    {
        $this->Flash->error($message, ['escape' => false]);
        return $this->render('index');
    }
}
