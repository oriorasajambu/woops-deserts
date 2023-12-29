<?php

namespace App\Livewire\Card;

use App\Models\Invoice;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderCard extends Component
{
    use WithFileUploads, AuthorizesRequests;

    //Image upload defaults
    protected string $defThumbName = 'post-thumb.jpg';
    protected string $defThumbPath = 'uploads';

    public $total = null;
    public ?Invoice $invoice;
    public ?Order $order;
    public $image = null;

    public function render()
    {
        $orders = Order::where('session', session()->getId())->get();
        return view('livewire.card.order-card', compact('orders'));
    }

    public function initData(Invoice $invoice, Order $order) {
        $this->invoice = $invoice;
        $this->order = $order;
        $this->total = $invoice->total;
    }

    public function uploadPayment()
    {
        if (!empty($this->image)) {
            $filename = md5($this->image . microtime()) . '_' . Str::random(30) . '.' . $this->image->extension();
            $fileLocation = $this->image->storeAs($this->defThumbPath, $filename, 'uploads');
        }
        $this->invoice->update([
            'status' => 'uploaded',
            'payment_proof' => 'storage/' . $fileLocation ?? $this->defThumbName,
        ]);
        $this->refreshContent('Success Update Status to Uploaded', 'modal-upload-payment');
    }

    public function cancel() {
        $this->invoice->update([
            'status' => 'canceled',
            'canceled_by' => 'customer',
        ]);
        $this->order->update([
            'status' => 'canceled',
        ]);
        $this->refreshContent('Success! Order Canceled', 'modal-cancel-order');
    }

    public function refreshContent(?string $message = null, ?string $modal = null)
    {
        //Close the active modal
        if ($modal) {
            $this->dispatch('cancel', $modal);
        }
        if ($message) {
            session()->flash('message', $message);
        }
        $refresh;
    }
}
