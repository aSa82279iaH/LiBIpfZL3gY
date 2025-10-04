<?php
// 代码生成时间: 2025-10-05 03:10:25
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

// TreeStructureComponent.php
// 控制器类，处理树形结构相关功能
class TreeStructureComponent extends Controller
{
    // 获取树形结构数据
    public function getTreeData(Request $request)
    {
        try {
            // 从数据库获取数据
            $treeData = DB::table('nodes')
                            ->whereNull('parent_id')
                            ->with(['children' => function ($query) {
                                $query->where('parent_id', '<>', null);
                            }])->get();
            
            // 返回树形结构数据
            return response()->json($this->buildTree($treeData));
        } catch (\Exception $e) {
            // 错误处理
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // 递归构建树形结构
    private function buildTree($nodes)
    {
        $tree = [];
        foreach ($nodes as $node) {
            if ($node->children) {
                $node->children = $this->buildTree($node->children);
            }
            $tree[] = $node;
        }
        return $tree;
    }
}

// routes/web.php
// 注册路由
Route::get('/tree-data', [TreeStructureComponent::class, 'getTreeData']);

// database/migrations/xxxx_xx_xx_xxxxxx_create_nodes_table.php
// 数据库迁移文件，创建nodes表
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodesTable extends Migration
{
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('nodes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nodes');
    }
}

// app/Models/Node.php
// 节点模型
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Node extends Model
{
    protected $table = 'nodes';

    public function children(): HasMany
    {
        return $this->hasMany(Node::class, 'parent_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'parent_id', 'id');
    }
}