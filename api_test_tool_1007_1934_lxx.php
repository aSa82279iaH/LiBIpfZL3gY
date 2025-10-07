<?php
// 代码生成时间: 2025-10-07 19:34:43
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class ApiTestTool
{
    /**
     * 发送HTTP请求到API端点
     *
     * @param string $method 请求方法（GET, POST, PUT, DELETE等）
     * @param string $url API端点的URL
     * @param array $headers 请求头
     * @param mixed $body 请求体
     * @return Response
     */
    public function sendRequest(string $method, string $url, array $headers = [], $body = null): Response
    {
        try {
            $client = new Client();
            $request = new Request($method, $url, $headers, $body);
            $response = $client->send($request);

            return $response;
        } catch (RequestException $e) {
            // 错误处理
            if ($e->hasResponse()) {
                return $e->getResponse();
            } else {
                throw new \Exception('请求失败：' . $e->getMessage());
            }
        }
    }
}

// 使用示例
$apiTestTool = new ApiTestTool();
$response = $apiTestTool->sendRequest('GET', 'https://jsonplaceholder.typicode.com/posts/1');
echo $response->getBody()->getContents();