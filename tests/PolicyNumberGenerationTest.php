<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Aforance\Aforance\Contracts\Business\Policy;

class PolicyNumberGenerationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanGenerateFuneralPolicyNumbers()
    {
        $policy = Mockery::mock('Aforance\Aforance\Contracts\Business\Policy');
        $policy->shouldReceive('policyNumber')->twice()->andReturn('XYZSIC20160700002');
        $generator = app('funeral.number_generator');

        $this->assertEquals($generator->generate($policy), 'XYZFP20160700003');

    }
}
