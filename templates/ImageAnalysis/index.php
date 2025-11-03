<h1><?= h($title) ?></h1>
<p><?= h($message) ?></p>

<!-- 画像アップロードフォーム -->
<form method="post" enctype="multipart/form-data" action="<?= $this->Url->build(['action' => 'analyze']) ?>">
    <label>画像を選択:</label>
    <input type="file" name="image" accept="image/*" required>
    <button type="submit">解析する</button>
</form>