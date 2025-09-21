<?php
// 代码生成时间: 2025-09-21 20:24:40
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;

class ExcelGenerator extends Controller
{
    /**
     * 生成Excel文件
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function generateExcel(Request $request)
    {
        // 错误处理
        try {
            // 创建一个新的PhpSpreadsheet对象
            $spreadsheet = new PhpSpreadsheet();

            // 获取工作表
            $sheet = $spreadsheet->getActiveSheet();

            // 根据请求数据设置Excel表格内容
            // 这里可以根据需要添加更多的逻辑来填充数据
            $sheet->setCellValue('A1', 'Header 1');
            $sheet->setCellValue('B1', 'Header 2');
            $sheet->setCellValue('A2', 'Data 1');
            $sheet->setCellValue('B2', 'Data 2');

            // 设置响应头和内容类型
            $response = response()->make();
            $response->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $response->header('Content-Disposition', 'attachment; filename="data.xlsx"');

            // 使用XlsxWriter保存Excel文件到内存中
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');

            return $response;
        } catch (\Exception $e) {
            // 错误处理逻辑
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
