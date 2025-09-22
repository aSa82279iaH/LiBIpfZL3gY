<?php
// 代码生成时间: 2025-09-22 23:29:00
use Illuminate\Support\Str;

class TestDataGenerator {

    /**<ol>
     * Generates a random string of a specified length.
     * 
     * @param int $length The length of the string to generate
     * @return string
     */
    public function generateRandomString($length = 10) {
        if ($length <= 0) {
            throw new InvalidArgumentException('Length must be greater than 0.');
        }

        return Str::random($length);
    }

    /**<ol>
     * Generates a random integer within a specified range.
     * 
     * @param int $min The minimum value of the range
     * @param int $max The maximum value of the range
     * @return int
     */
    public function generateRandomInteger($min = 0, $max = 100) {
        if ($min > $max) {
            throw new InvalidArgumentException('Minimum value cannot be greater than maximum value.');
        }

        return rand($min, $max);
    }

    /**<ol>
     * Generates a random boolean value.
     * 
     * @return bool
     */
    public function generateRandomBoolean() {
        return rand(0, 1) === 1;
    }

    /**<ol>
     * Generates an array of random data.
     * 
     * @param int $count The number of elements in the array
     * @return array
     */
    public function generateRandomArray($count = 10) {
        if ($count <= 0) {
            throw new InvalidArgumentException('Count must be greater than 0.');
        }

        return array_fill(0, $count, $this->generateRandomString());
    }

    /**<ol>
     * Generates a random date within a specified range.
     * 
     * @param string $startDate The start date of the range in 'Y-m-d' format
     * @param string $endDate The end date of the range in 'Y-m-d' format
     * @return string
     */
    public function generateRandomDate($startDate = '1970-01-01', $endDate = '2023-12-31') {
        $timestamp = strtotime($startDate) + rand(0, strtotime($endDate) - strtotime($startDate));

        return date('Y-m-d', $timestamp);
    }
}
