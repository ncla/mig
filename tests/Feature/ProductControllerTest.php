<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    private function makeFakeProductData()
    {
        $factory = Product::factory();
        return $factory->make()->attributesToArray();
    }

    private function createProductsWithPredefinedPriceOrder()
    {
        $priceOrder = [900, 850, 800, 750, 400, 322, 300, 250, 222, 1000];

        return Product::factory(10)
            ->sequence(fn ($sequence) => ['price_with_tax' => $priceOrder[$sequence->index]])
            ->create();
    }

    public function test_create_endpoint_returns_unauthorized_response_code_when_csrf_is_missing()
    {
        // In \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::runningUnitTests
        // the class disables CSRF checking when running in tests,
        // so let's fake that we are not running in test env.
        $mock = $this->mock(VerifyCsrfToken::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial()
            ->shouldReceive('runningUnitTests')
            ->andReturn(false)
            ->getMock();

        $this->instance(
            VerifyCsrfToken::class,
            $mock
        );

        $response = $this->put('/create-product', $this->makeFakeProductData());

        $response->assertStatus(419);
    }

    public function test_create_endpoint_inserts_data_in_database()
    {
        $fakeData = $this->makeFakeProductData();
        $response = $this->put('/create-product', $fakeData);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('products', [
            'ean_13' => $fakeData['ean_13'],
        ]);
    }

    public function test_products_are_sorted_by_price_in_order()
    {
        $this->createProductsWithPredefinedPriceOrder();

        $this->get('/?sortPrice=desc')
            ->assertSeeInOrder(
                array_map(fn ($val) => "class=\"price\">" . $val, [1000, 900, 850]),
                false
            );

        $this->get('/?sortPrice=asc')
            ->assertSeeInOrder(
                array_map(fn ($val) => "class=\"price\">" . $val, [222, 250, 300]),
                false
            );
    }

    public function test_products_are_listed_without_sorting_by_price_when_price_sort_value_is_invalid()
    {
        $this->createProductsWithPredefinedPriceOrder();

        $this->get('/?sortPrice=invalidvalue')
            ->assertStatus(200)
            ->assertSeeInOrder(
                array_map(fn ($val) => "class=\"price\">" . $val, [900, 850, 800]),
                false
            );
    }
}
