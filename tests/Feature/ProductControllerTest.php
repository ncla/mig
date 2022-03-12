<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;
use App\Http\Middleware\VerifyCsrfToken;

class ProductControllerTest extends TestCase
{
    private function makeFakeProductData() {
        $factory = Product::factory();
        return $factory->make()->attributesToArray();
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

        $response = $this->put('/product', $this->makeFakeProductData());

        $response->assertStatus(419);
    }
}
