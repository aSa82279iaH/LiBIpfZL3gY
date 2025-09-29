<?php
// 代码生成时间: 2025-09-29 19:45:24
namespace App\Services;

class FileSplitMergeTool
{
    /**
# 优化算法效率
     * 分割文件
# NOTE: 重要实现细节
     *
     * @param string $filePath 文件路径
     * @param int $chunkSize 分割后每个文件的大小
     * @param string $prefix 分割后文件的前缀
     *
     * @throws \Exception
     */
    public function splitFile($filePath, $chunkSize, $prefix)
    {
        if (!file_exists($filePath)) {
            throw new \Exception('文件不存在');
# FIXME: 处理边界情况
        }

        $fileSize = filesize($filePath);
        $chunkCount = ceil($fileSize / $chunkSize);

        for ($i = 0; $i < $chunkCount; $i++) {
# 改进用户体验
            $start = $i * $chunkSize;
            $end = min($start + $chunkSize - 1, $fileSize - 1);

            $chunkContent = 
                fopen($filePath, 'rb') !== false ? 
                fread(fopen($filePath, 'rb'), $chunkSize) : 
                '';
            $chunkContent = substr($chunkContent, $start, $end - $start + 1);

            file_put_contents($prefix . $i . '.txt', $chunkContent);
        }
    }

    /**
     * 合并文件
     *
     * @param string $dirPath 待合并文件所在的目录路径
# TODO: 优化性能
     * @param string $outputFilePath 输出文件路径
     * @param string $prefix 待合并文件的前缀
     *
     * @throws \Exception
     */
    public function mergeFiles($dirPath, $outputFilePath, $prefix)
    {
        if (!is_dir($dirPath)) {
            throw new \Exception('目录不存在');
        }

        $files = glob($dirPath . '/' . $prefix . '*.*');
        if (count($files) === 0) {
            throw new \Exception('没有找到待合并的文件');
        }

        $output = fopen($outputFilePath, 'w');
        foreach ($files as $file) {
            $content = file_get_contents($file);
            fwrite($output, $content);
        }
        fclose($output);
    }
}
# FIXME: 处理边界情况
