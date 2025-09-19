<?php
// 代码生成时间: 2025-09-19 09:04:41
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderService;

class OrderProcessingController extends Controller
{
    /**
     * Handle the order processing.
     *
     * @param  \Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'items' => 'required|array',
        ]);

        try {
            // Start DB transaction
            DB::beginTransaction();

            // Create a new order
            $order = Order::create(['user_id' => auth()->id()]);

            // Process each item in the order
            foreach ($validatedData['items'] as $item) {
                // Create a new order item
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Return a success response
            return response()->json(['message' => 'Order processed successfully', 'order' => $order], 200);

        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            // Return an error response
            return response()->json(['message' => 'Error processing order'], 500);
        }
    }
}

/**
 * OrderService.php
 */

class OrderService
{
    /**
     * Process an order.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function processOrder(array $data)
    {
        // Start DB transaction
        DB::beginTransaction();

        // Create a new order
        $order = Order::create(['user_id' => auth()->id()]);

        // Process each item in the order
        foreach ($data['items'] as $item) {
            // Create a new order item
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Commit the transaction
        DB::commit();

        // Return a success response
        return response()->json(['message' => 'Order processed successfully', 'order' => $order], 200);
    }
}
