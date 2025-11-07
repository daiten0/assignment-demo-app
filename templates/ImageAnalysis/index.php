<h1>AI Image Analysis</h1>

<!-- 画像アップロードフォーム -->
<?= $this->Form->create(null, [
    'type' => 'file', 
    'url' => ['action' => 'analyze']
]) ?>
    <label>画像を選択:</label>
    <?= $this->Form->file('image', ['accept' => 'image/*', 'required' => true]) ?>
    <?= $this->Form->button('解析する') ?>
<?= $this->Form->end() ?>