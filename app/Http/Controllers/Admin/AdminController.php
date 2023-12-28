<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class AdminController extends Controller
{
    public function index()
    {
        DB::statement("SET SQL_MODE=''");

        $dailyOrderQuery = Order::selectRaw('dayname(orders.created_at) day, count(*) num_rows, sum(sub_total) sub_total_pament, sum(total) total_payment, sum(tax) tax_payment')
            ->join('invoices', 'invoices.id', '=', 'orders.invoice_id')
            ->orderBy('orders.created_at', 'DESC')
            ->groupBy(DB::raw('Date(orders.created_at)'))
            ->where('orders.status', 'finish')
            ->whereDate('orders.created_at', '>=', Carbon::now()->addDays(-6))
            ->get()
            ->toArray();

        $dailyOrderResult = array_column($dailyOrderQuery, 'num_rows');
        $currentDayCycle = array_column($dailyOrderQuery, 'day');
        $dailyPayment = array_column($dailyOrderQuery, 'sub_total_pament');

        $monthlyOrderQuery = Order::selectRaw('year(orders.created_at) year, monthname(orders.created_at) month, count(*) num_rows')
            ->join('invoices', 'invoices.id', '=', 'orders.invoice_id')
            ->groupBy('year', 'month')
            ->orderBy('year', 'DESC')
            ->where('orders.status', 'finish')
            ->whereDate('orders.created_at', '>=', Carbon::now()->addMonth(-11))
            ->get()
            ->toArray();

        $monthlyOrderResult = array_column($monthlyOrderQuery, 'num_rows');
        $currentMonthCycle = array_column($monthlyOrderQuery, 'month');

        $monthlyInvoiceQuery = Invoice::selectRaw('year(created_at) year, monthname(created_at) month, count(*) num_rows')
                ->groupBy('year', 'month')
                ->orderBy('year', 'DESC')
                ->where('status', 'paid')
                ->whereDate('created_at', '>=', Carbon::now()->addMonth(-11))
                ->get()
                ->toArray();

        $monthlyInvoiceResult = array_column($monthlyInvoiceQuery, 'num_rows');
        $currentMonthCycle = array_column($monthlyInvoiceQuery, 'month');

        // dd($dailyOrderResult);

        $data = [
            'page' => 'dashboard',
            'day_cycle' => $currentDayCycle,
            'month_cycle' => $currentMonthCycle,
            'daily_order_chart' => $dailyOrderResult,
            'daily_order_payment' => $dailyPayment,
            'monthly_order_chart' => $monthlyOrderResult,
            'monthly_invoice_chart' => $monthlyInvoiceResult,
        ];
        return view('admin.contents.dashboard.index', $data);
    }

    public function category() 
    {
        $data = [
            'page' => 'categories',
        ];
        return view('admin.contents.category.index', $data);
    }

    public function product() 
    {
        $data = [
            'page' => 'products',
        ];
        return view('admin.contents.product.index', $data);
    }

    public function config() 
    {
        $data = [
            'page' => 'configs',
        ];

        return view('admin.contents.config.index', $data);
    }

    public function postage() 
    {
        $data = [
            'page' => 'postage_cost'
        ];
        return view('admin.contents.postagecost.index', $data);
    }

    public function expense() 
    {
        $data = [
            'page' => 'expense',
        ];
        return view('admin.contents.expense.index', $data);
    }

    public function sales() 
    {
        $data = [
            'page' => 'sales'
        ];
        return view('admin.contents.sales.index', $data);
    }

    public function order() 
    {
        $data = [
            'page' => 'order',
        ];
        return view('admin.contents.order.index', $data);
    }

    public function payment() 
    {
        $data = [
            'page' => 'payment'
        ];
        return view('admin.contents.payment.index', $data);
    }

    public function invoices() 
    {
        $data = [
            'page' => 'invoices',
        ];
        return view('admin.contents.invoices.index', $data);
    }


    public function logout() {
        session()->flush();
        return redirect()->to('/');
    }

    public function downloadInvoice(Invoice $invoice) {
        $pdf = PDF::loadView('admin.components.invoice', ['invoice' => $invoice]);
        return $pdf->stream();
    }

    public function downloadReceipt(Payment $payment)
    {
        $pdf = PDF::loadView('admin.components.receipt', ['receipt' => $payment]);
        return $pdf->stream();
    }
}
