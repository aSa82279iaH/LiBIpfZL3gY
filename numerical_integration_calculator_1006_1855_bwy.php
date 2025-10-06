<?php
// 代码生成时间: 2025-10-06 18:55:18
use Illuminate\Http\Request;

class NumericalIntegrationCalculator
{
    /**
     * 计算定积分
     *
     * @param float $a     积分下限
     * @param float $b     积分上限
     * @param callable $f   被积函数
     * @param int $n        分割区间数
     * @return float
     */
    public function integrate(float $a, float $b, callable $f, int $n): float
    {
        // 检查区间是否合理
        if ($a > $b) {
            throw new InvalidArgumentException('积分下限必须小于上限');
        }

        // 检查区间数是否大于0
        if ($n <= 0) {
            throw new InvalidArgumentException('分割区间数必须大于0');
        }

        // 计算每个小区间的宽度
        $dx = ($b - $a) / $n;

        // 初始化积分结果
        $integral = 0.0;

        // 计算定积分
        for ($i = 0; $i < $n; $i++) {
            $x = $a + $i * $dx + $dx / 2; // 取区间中点
            $integral += $dx * call_user_func($f, $x);
        }

        return $integral;
    }
}

// 使用示例
$calculator = new NumericalIntegrationCalculator();
$a = 0.0;
$b = 1.0;
$n = 1000;
$f = function($x) {
    return $x * $x; // 被积函数 f(x) = x^2
};

try {
    $result = $calculator->integrate($a, $b, $f, $n);
    echo '定积分结果: ' . $result;
} catch (Exception $e) {
    echo '错误: ' . $e->getMessage();
}
