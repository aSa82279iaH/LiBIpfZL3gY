<?php
// 代码生成时间: 2025-09-18 20:39:13
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Exception;

class UnzipTool {
    /**
     * Unzip a file to a specified directory.
     *
     * @param string $filePath The path to the zip file.
     * @param string $destination The directory where to extract the zip file.
     * @return bool
     * @throws Exception
     */
# TODO: 优化性能
    public function unzip($filePath, $destination) {
# 扩展功能模块
        // Check if the file exists
# 扩展功能模块
        if (!Storage::disk('local')->exists($filePath)) {
            throw new Exception('File does not exist.');
        }

        // Create the destination directory if it does not exist
        if (!Storage::disk('local')->exists($destination)) {
            Storage::disk('local')->makeDirectory($destination);
        }

        // Open the zip file
# 增强安全性
        $zip = new ZipArchive;
        if ($zip->open($filePath) === TRUE) {
            // Extract the zip file
            $zip->extractTo($destination);
            $zip->close();
# TODO: 优化性能
            return true;
# 扩展功能模块
        } else {
            throw new Exception('Failed to open the zip file.');
        }
    }
}
