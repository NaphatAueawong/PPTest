@extends('template')
@section('content')
    <h1>Loan Details</h1>
    <p>ID:  {{$customer->id}}</p>
    <p>Loan Amount: {{$customer->loanAmount}}   ฿</p>
    <p>Loan Term:  {{$customer->loanTerm}} Years</p>
    <p>Interest Rate:  {{$customer->interestRate}} %</p>
    <p>Created At:  {{$customer->created_at}}</p>

    <button><a href="/">Back</a></button>
    <hr>

    <h1>Repayment Schedules</h1>
    <table>
        <thead>
            <tr>
                <th>Payment No</th>
                <th>Date</th>
                <th>Payment Amount</th>
                <th>Principle</th>
                <th>Interest</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rePaymentSchedules as $rePaymentSchedule)
            <tr>
                <td>{{ $rePaymentSchedule->payNo }}</td>
                <td>{{ $rePaymentSchedule->date }}</td>
                <td>{{ number_format($rePaymentSchedule->paymentAmount, 2)}}</td>            
                <td>{{ number_format($rePaymentSchedule->principle, 2) }}</td>            
                <td>{{ number_format($rePaymentSchedule->interest, 2) }}</td>   
                <td>{{ number_format($rePaymentSchedule->outStandingBalance, 2) }}</td>     
            </tr>            
            @endforeach
            </tr>
        </tbody>
    </table>

    <hr>
    <button><a href="/">Back</a></button>
@endsection