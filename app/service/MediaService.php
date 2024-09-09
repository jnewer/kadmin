<?php

namespace app\service;

use app\model\Media;
use Webman\Http\UploadFile;
use app\service\BaseService;
use app\validator\MediaValidator;
use Illuminate\Database\Eloquent\Builder;
use support\exception\BusinessException;

/**
 * @method Media findModel(int $id)
 */
class MediaService extends BaseService
{
    protected string $model = Media::class;
    protected string $validator = MediaValidator::class;

    public function builder(array $filters = []): Builder
    {
        return Media::query()
            ->when(!empty($filters['storage']), fn($query) => $query->where('storage', $filters['storage']))
            ->when(!empty($filters['category']), fn($query) => $query->where('category', $filters['category']))
            ->when(!empty($filters['created_at_start']), fn($query) => $query->where('created_at', '>=', $filters['created_at_start']))
            ->when(!empty($filters['created_at_end']), fn($query) => $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59'));
    }

    public function upload(UploadFile $file, string $relativeDir): array
    {
        $relativeDir = ltrim($relativeDir, '\\/');
        $publicPath = rtrim(config('app.public_path', ''), '\\/');
        $baseDir = $publicPath ? $publicPath . DIRECTORY_SEPARATOR : base_path() . '/public/';
        $fullDir = $baseDir . $relativeDir;

        if (!is_dir($fullDir)) {
            mkdir($fullDir, 0777, true);
        }

        $ext = $file->getUploadExtension() ?: null;
        $mimeType = $file->getUploadMimeType();
        $fileName = $file->getUploadName();
        $fileSize = $file->getSize();

        if (!$ext && $fileName === 'blob') {
            $ext = explode('/', $mimeType)[1];
        }

        $ext = strtolower($ext);
        $forbiddenExts = ['php', 'php3', 'php5', 'css', 'js', 'html', 'htm', 'asp', 'jsp'];

        if (in_array($ext, $forbiddenExts)) {
            throw new BusinessException('不支持该格式的文件上传', 400);
        }

        $relativePath = $relativeDir . '/' . bin2hex(pack('Nn', time(), random_int(1, 65535))) . ".$ext";
        $fullPath = $baseDir . $relativePath;
        $file->move($fullPath);

        $imageInfo = getimagesize($fullPath) ?: [];
        $imageWidth = $imageInfo[0] ?? 0;
        $imageHeight = $imageInfo[1] ?? 0;
        $mimeType = $imageInfo['mime'] ?? $mimeType;

        return [
            'url' => "/$relativePath",
            'name' => $fileName,
            'realpath' => $fullPath,
            'size' => $fileSize,
            'mimeType' => $mimeType,
            'imageWidth' => $imageWidth,
            'imageHeight' => $imageHeight,
            'ext' => $ext,
        ];
    }

    public function create(array $data): Media
    {
        $file = $data['file'] ?? null;

        if (!$file || !$file->isValid()) {
            throw new BusinessException('未找到文件');
        }

        $uploadedFile = $this->upload($file, '/upload/files/' . date('Ymd'));

        return Media::create([
            'name' => $uploadedFile['name'],
            'url' => $uploadedFile['url'],
            'realpath' => $uploadedFile['realpath'],
            'file_size' => $uploadedFile['size'],
            'mime_type' => $uploadedFile['mimeType'],
            'image_width' => $uploadedFile['imageWidth'],
            'image_height' => $uploadedFile['imageHeight'],
            'ext' => $uploadedFile['ext'],
            'category' => $data['category'],
            'storage' => $data['storage'] ?? 'local',
            'user_id' => $data['user_id'] ?? 0,
        ]);
    }
}
