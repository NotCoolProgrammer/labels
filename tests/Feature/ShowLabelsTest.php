<?php

namespace Tests\Feature;

use PHPUnit\Framework\Assert;
use Tests\TestCase;

class ShowLabelsTest extends TestCase
{
    public function test_show_labels(): void
    {
        $response = $this->post('/showLabels', [
            'entityType' => 'users',
            'entityId' => 1
        ]);

        Assert::assertTrue($response->getStatusCode() === 200, $response->getContent());
    }
}
