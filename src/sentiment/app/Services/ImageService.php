<?php
namespace App\Services;

class ImageService
{

    /**
     * イメージファイルのバリデーション
     *
     * @return string | null
     */
    public function validateImage(array $image)
    {
        $result = null;
        $regex = '/^(?:png|jpe?g|JPE?G)$/';
        if (!preg_match($regex, $image['extension'])) {
            $result = "指定された形式以外のファイルはアップロードできません";
        }
        return $result;
    }

    /**
     * dataURLをデコードする
     *
     * @return array
     */
    public function decodeDataUrl(string $data_url)
    {
        $image = [
            "data" => null,
            "path" => null,
            "extension" => null,
        ];
        $needle = 'base64,';
        // base64データの開始位置
        $offset = strpos($data_url, $needle) + mb_strlen($needle);
        // base64データの開始位置から最後までの文字列を取得
        $base64_data = substr($data_url, $offset);
        $image['data'] = base64_decode($base64_data);
        // mime typeを取得
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_buffer($finfo, $image['data']);
        // 拡張子を取得
        $image['extension'] = explode('/', $mime_type)[1];
        $filename = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 64);
        $image['path'] = "reverse_card/{$filename}.{$image['extension']}";
        return $image;
    }
}
