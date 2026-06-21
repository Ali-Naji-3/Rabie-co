<?php

namespace Tests\Feature;

use App\Filament\Resources\OrderResource\Pages\EditOrder;
use App\Models\Order;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * F10.1 — order financial fields (subtotal/tax/shipping/total) are SSOT values
 * from PricingService and must not be editable through the Filament admin form.
 */
class OrderTotalsReadonlyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    private function order(): Order
    {
        return Order::factory()->create([
            'subtotal' => 100.00,
            'tax'      => 0.00,
            'shipping' => 10.00,
            'total'    => 110.00,
        ]);
    }

    public function test_total_fields_are_disabled_in_the_admin_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $order = $this->order();

        Livewire::actingAs($admin)
            ->test(EditOrder::class, ['record' => $order->getRouteKey()])
            ->assertFormFieldIsDisabled('subtotal')
            ->assertFormFieldIsDisabled('tax')
            ->assertFormFieldIsDisabled('shipping')
            ->assertFormFieldIsDisabled('total');
    }

    public function test_totals_remain_visible_with_their_stored_values(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $order = $this->order();

        Livewire::actingAs($admin)
            ->test(EditOrder::class, ['record' => $order->getRouteKey()])
            ->assertFormSet([
                'subtotal' => '100.00',
                'shipping' => '10.00',
                'total'    => '110.00',
            ]);
    }

    public function test_submitting_tampered_totals_does_not_overwrite_stored_values(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $order = $this->order();

        // Force tampered values into the form state, then save. Because the fields
        // are not dehydrated, the malicious values must be ignored on persist.
        Livewire::actingAs($admin)
            ->test(EditOrder::class, ['record' => $order->getRouteKey()])
            ->fillForm([
                'subtotal' => 1,
                'tax'      => 1,
                'shipping' => 1,
                'total'    => 1,
            ])
            ->call('save');

        $order->refresh();
        $this->assertEquals(100.00, (float) $order->subtotal);
        $this->assertEquals(10.00, (float) $order->shipping);
        $this->assertEquals(110.00, (float) $order->total);
    }
}
