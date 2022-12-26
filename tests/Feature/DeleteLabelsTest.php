<?php

namespace Tests\Feature;

use PHPUnit\Framework\Assert;
use Tests\TestCase;

class DeleteLabelsTest extends TestCase
{
    public function test_example()
    {
        $response = $this->post('/deleteLabels', [
            'entityType' => 'users',
            'entityId' => 1,
            'labels' => [345]
        ]);

        Assert::assertTrue($response->getStatusCode() === 200, $response->getContent());
    }
}
