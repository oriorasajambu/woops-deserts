<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Sales;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $date = collect([
            Carbon::now(),
            Carbon::now()->addDays(-1),
            Carbon::now()->addDays(-2),
            Carbon::now()->addDays(-3),
            Carbon::now()->addDays(-4),
            Carbon::now()->addDays(-5),
            Carbon::now()->addDays(-6),
        ]);

        $statusInvoice = collect([
            'paid', 
            'uploaded',
            'pending', 
            'canceled',
        ]);
        $statusOrder = collect([
            'finish',
            'inprogress',
            'pending',
            'canceled',
        ]);
        $cancelBy = collect([
            'customer',
            'admin',
        ]);

        for($i = 1; $i <= 1000; $i++) {
            $createdAt = $date->random();
            $status = $statusInvoice->random();
            $canceled = $status == "canceled" ? $cancelBy->random() : 'none';
            $invoice = Invoice::create([
                "email"        => $faker->email(),
                "country"      => $faker->country(),
                "first_name"   => $faker->firstName(),
                "last_name"    => $faker->lastName(),
                "company"      => $faker->company(),
                "address"      => $faker->address(),
                "city"         => $faker->city(),
                "province"     => $faker->state(),
                "postal_code"  => $faker->postcode(),
                "phone"        => $faker->phoneNumber(),
                "sub_total"    => "30000",
                "tax"          => "3000",
                "total"        => "33000",
                "orders"       => '{"10":{"id":10,"name":"Product 10","price":15000,"quantity":3,"attributes":{"variant":"Coklat"},"conditions":[],"associatedModel":{"id":10,"category_id":1,"user_id":1,"name":"Product 10","slug":"product-10","description":"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis sed accusantium vel temporibus doloribus maiores, voluptatibus voluptas nesciunt aperiam tempore, quasi earum praesentium nulla excepturi quidem ab! Distinctio, fugit aperiam?","variant":"[\"Keju\",\"Coklat\",\"Vanilla\"]","price":"15000","image":"storage\/uploads\/thumbnails\/1703538690_qZoTsktbkKR6rYPiI6gCG7muFIcl9Z.webp","original":"storage\/uploads\/originals\/1703538690_qZoTsktbkKR6rYPiI6gCG7muFIcl9Z.jpg","created_at":"2023-12-25T23:26:00.000000Z","updated_at":"2023-12-25T23:26:00.000000Z"}},"5":{"id":5,"name":"Product 5","price":15000,"quantity":1,"attributes":{"variant":"Vanilla"},"conditions":[],"associatedModel":{"id":5,"category_id":1,"user_id":1,"name":"Product 5","slug":"product-5","description":"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis sed accusantium vel temporibus doloribus maiores, voluptatibus voluptas nesciunt aperiam tempore, quasi earum praesentium nulla excepturi quidem ab! Distinctio, fugit aperiam?","variant":"[\"Keju\",\"Coklat\",\"Vanilla\"]","price":"15000","image":"storage\/uploads\/thumbnails\/1703538690_qZoTsktbkKR6rYPiI6gCG7muFIcl9Z.webp","original":"storage\/uploads\/originals\/1703538690_qZoTsktbkKR6rYPiI6gCG7muFIcl9Z.jpg","created_at":"2023-12-25T23:26:00.000000Z","updated_at":"2023-12-25T23:26:00.000000Z"}}}',
                "status"       => $status,
                "canceled_by"  => $canceled,
                "created_at"   => $createdAt,
                "updated_at"   => $date->random(),
            ]);

            Order::create([
                "invoice_id"   => $invoice->id,
                "status"       => $statusOrder->random(),
                "created_at"   => $createdAt,
                "updated_at"   => $date->random(),
            ]);

            Payment::create([
                "invoice_id"   => $invoice->id,
                "created_at"   => $createdAt,
                "updated_at"   => $date->random(),
            ]);

            Sales::create([
                "invoice_id"   => $invoice->id,
                "created_at"   => $createdAt,
                "updated_at"   => $date->random(),
            ]);
        }
    }
}
