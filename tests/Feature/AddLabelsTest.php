<?php

namespace Tests\Feature;

use PHPUnit\Framework\Assert;
use Tests\TestCase;

class AddLabelsTest extends TestCase
{
    public function test_add_labels()
    {
        $response = $this->post('/addLabels', [
            'entityType' => 'users',
            'entityId' => 1,
            'labels' => [123, 234, 345, 456]
        ]);

        Assert::assertTrue($response->getStatusCode() === 200, $response->getContent());
    }
}
