<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class addLoanTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('addLoan')
                    ->value('#loanAmount', '10000')
                    ->value('#loanTerm', '1')
                    ->value('#interestRate', '1')
                    ->select('startMonth', 'Jun')
                    ->value('startYear', '2017')
                    ->click('button[type="submit"]')
                    ->assertSee('Loan Details');
                    
        });
    }
}
