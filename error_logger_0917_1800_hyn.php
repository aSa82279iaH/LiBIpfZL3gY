<?php
// 代码生成时间: 2025-09-17 18:00:06
 * It follows the best practices and ensures code maintainability and scalability.
 */

use Psr\Log\LogLevel;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Log;

class ErrorLogger {
    /**
     * Logger instance
     * 
     * @var Logger
     */
    protected $logger;

    /**
     * Create a new error logger instance.
     * 
     * @return void
     */
    public function __construct() {
        // Create a new logger instance
        $this->logger = new Logger('error_logger');

        // Set the log level to debug for detailed error messages
        $this->logger->pushProcessor(new \Monolog\Processor\PsrLogMessageProcessor());

        // Create a stream handler to log errors to a file
        $stream = new StreamHandler(storage_path('logs/error.log'), LogLevel::ERROR);

        // Add the stream handler to the logger
        $this->logger->pushHandler($stream);
    }

    /**
     * Log an error message.
     * 
     * @param string $message The error message to log
     * @param array $context Additional context for the error message
     * @return void
     */
    public function logError($message, $context = []) {
        try {
            // Log the error message with the provided context
            $this->logger->error($message, $context);
        } catch (Exception $e) {
            // Handle any exceptions that occur during logging
            Log::error('Error logging error: ' . $e->getMessage());
        }
    }

    /**
     * Log an exception.
     * 
     * @param \Throwable $exception The exception to log
     * @return void
     */
    public function logException($exception) {
        try {
            // Log the exception with its stack trace and message
            $this->logger->error($exception->getMessage(), ['exception' => $exception]);
        } catch (Exception $e) {
            // Handle any exceptions that occur during logging
            Log::error('Error logging exception: ' . $e->getMessage());
        }
    }
}
