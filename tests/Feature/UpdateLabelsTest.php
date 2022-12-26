<?php

namespace Tests\Feature;

use PHPUnit\Framework\Assert;
use Tests\TestCase;

class UpdateLabelsTest extends TestCase
{
    public function test_update_labels()
    {
        $response = $this->post('/updateLabels', [
            'entityType' => 'users',
            'entityId' => 1,
            'labels' => [234, 456]
        ]);

        Assert::assertTrue($response->getStatusCode() === 200, $response->getContent());
    }
}
