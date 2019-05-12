<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Customer;
use Illuminate\Routing\Redirector;
use Carbon\Carbon;

class LoanController extends Controller
{
    public   $months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"); 

    public function showCustomer()
    {
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('homePage')->with('customers', $customers);
    }

    public function showDetailLoan($id)
    {
        $customer = Customer::find($id);
        $rePaymentSchedules = $this->calculateRePaymentSchedule($customer);
        return view(('/loan/detailLoan'), ['customer' => $customer, 
                                    'rePaymentSchedules' => $rePaymentSchedules]);
    }

    public function addLoan()
    {
        return view('/loan/addLoan')->with('months', $this->months);
    }

    public function add(Request $request)
    {
        $newCustomer = new Customer;    
        $newCustomer->loanAmount     = $request->input('loanAmount');
        $newCustomer->loanTerm       = $request->input('loanTerm');
        $newCustomer->interestRate   = $request->input('interestRate');
        $newCustomer->startMonth     = $request->input('startMonth');
        $newCustomer->startYear      = $request->input('startYear');
        $newCustomer->save();
        
        $rePaymentSchedules = $this->calculateRePaymentSchedule($newCustomer);
        return view(('/loan/detailLoan'), ['customer' => $newCustomer,
                                        'rePaymentSchedules' => $rePaymentSchedules]);
    }

    public function editLoan($id)
    {
        $customer = Customer::find($id); 
        return view(('/loan/editLoan'), ['customer' => $customer, 
                                  'months' => $this->months]);
    }

    public function edit(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->loanAmount     = $request->input('loanAmount');
        $customer->loanTerm       = $request->input('loanTerm');
        $customer->interestRate   = $request->input('interestRate');
        $customer->startMonth     = $request->input('startMonth');
        $customer->startYear      = $request->input('startYear');
        $customer->save();
        
        $rePaymentSchedules = $this->calculateRePaymentSchedule($customer);
        return view(('/loan/detailLoan'), ['customer' => $customer, 
                                    'rePaymentSchedules' => $rePaymentSchedules]);
    }

    public function deleteLoan($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return  redirect('/');
    }


    //--------------------------------------------------------------------------------------------------------------------

    public function calculateRePaymentSchedule($customer)
    {
        $rePaymentSchedules = array();
        $paymentAmount = null;
        $outStandingBalance = $customer->loanAmount;
        $interest = null;

        for ($i=1; $i<=$customer->loanTerm*12; $i++) {
            
            $date = $this->calculateDate($customer, $i);
            $paymentAmount =  $this->calculatePaymentAmount($customer);
            $interest = $this->calculateInterest($customer, $outStandingBalance);
            $principle = $this->calculatePrinciple($paymentAmount, $interest);
            $outStandingBalance = $this->calculateOutStandingBalance($outStandingBalance, $principle);
            
            $rePaymentScheduleObj = (object) [
                'payNo' => $i,
                'date' =>  $date,
                'paymentAmount' => $paymentAmount,
                'principle' => $principle,
                'interest' => $interest,
                'outStandingBalance' => $outStandingBalance
            ];

            array_push($rePaymentSchedules, $rePaymentScheduleObj);
       
        }
        return ($rePaymentSchedules);
    }

    public function calculateDate($customer, $i)
    {
        $startMonthYear = join('-', [$customer->startMonth, $customer->startYear]);
        $startMonthYear = Carbon::parse($startMonthYear);
        $startMonthYear->addMonthsNoOverflow($i);
        return $startMonthYear->isoFormat('MMM YYYY');
    }

    public function calculatePaymentAmount($customer)
    {   
        $loanAmount = $customer->loanAmount;
        $interestRateDecimal = $customer->interestRate/100;
        $yearTerm = $customer->loanTerm;
        $paymentAmount = ($loanAmount*($interestRateDecimal/12))/(1-pow(1+($interestRateDecimal/12),-12*$yearTerm));
        return $paymentAmount;
    }

    public function calculateInterest($customer, $outStandingBalance)        
    {
        $interestRateDecimal = $customer->interestRate/100;
        $interest = ($interestRateDecimal/12)*$outStandingBalance;
        return $interest;
    }

    public function calculatePrinciple($paymentAmount, $interest)
    {
        return $paymentAmount-$interest;
    }

    public function calculateOutStandingBalance($outStandingBalance, $principle)
    {
        $outStandingBalance = $outStandingBalance-$principle;
        if($outStandingBalance <= 0){
            return 0;
        }else{
            return $outStandingBalance;
        }
    }
}