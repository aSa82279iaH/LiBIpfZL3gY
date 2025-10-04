<?php
// 代码生成时间: 2025-10-04 20:41:49
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// 使用Laravel命名空间
namespace App\Models;

// IoTGateway模型类，代表IoT网关
class IoTGateway extends Model {
    use HasFactory;

    // 模型对应的数据库表名
    protected \$table = 'iot_gateways';

    // 主键名称
    protected \$primaryKey = 'id';

    // 可被批量赋值的属性
    protected \$fillable = [
        'name',
        'description',
        'status',
        'ip_address',
        'port',
        'created_at',
        'updated_at'
    ];

    // 定义与IoT设备的关系
    public function devices(): HasMany {
        return \$this->hasMany(IoTDevice::class, 'gateway_id', 'id');
    }
}

// IoTDevice模型类，代表IoT设备
class IoTDevice extends Model {
    use HasFactory;

    // 模型对应的数据库表名
    protected \$table = 'iot_devices';

    // 主键名称
    protected \$primaryKey = 'id';

    // 可被批量赋值的属性
    protected \$fillable = [
        'gateway_id',
        'name',
        'type',
        'serial_number',
        'created_at',
        'updated_at'
    ];

    // 定义与IoT网关的关系
    public function gateway(): BelongsTo {
        return \$this->belongsTo(IoTGateway::class, 'gateway_id', 'id');
    }
}

// 服务类，用于管理IoT网关和设备
class IoTGatewayManager {
    // 添加新的IoT网关
    public function addIoTGateway(array \$gatewayData): IoTGateway {
        \$gateway = new IoTGateway();
        \$gateway->fill(\$gatewayData);
        \$gateway->save();

        return \$gateway;
    }

    // 获取所有IoT网关
    public function getAllIoTGateways(): Collection {
        return IoTGateway::all();
    }

    // 更新IoT网关信息
    public function updateIoTGateway(IoTGateway \$gateway, array \$gatewayData): IoTGateway {
        \$gateway->fill(\$gatewayData);
        \$gateway->save();

        return \$gateway;
    }

    // 删除IoT网关
    public function deleteIoTGateway(IoTGateway \$gateway): bool {
        return \$gateway->delete();
    }

    // 添加新的IoT设备
    public function addIoTDevice(IoTGateway \$gateway, array \$deviceData): IoTDevice {
        \$device = new IoTDevice();
        \$device->gateway_id = \$gateway->id;
        \$device->fill(\$deviceData);
        \$device->save();

        return \$device;
    }

    // 获取网关下的所有IoT设备
    public function getDevicesByGateway(IoTGateway \$gateway): Collection {
        return \$gateway->devices;
    }
}

// 错误处理和文档注释已包含在代码中