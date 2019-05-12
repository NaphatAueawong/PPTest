@extends('template')
@section('content')
    <h1>All Loans</h1>
    <button><a href="/addLoan">Add New Loan</a></button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Loan Amount</th>
                <th>Loan Term</th>
                <th>Interest Rate</th>
                <th>Created At</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->loanAmount }} ฿</td>
                <td>{{ $customer->loanTerm }} Years</td>            
                <td>{{ $customer->interestRate }} %</td>            
                <td>{{ $customer->created_at }}</td>   
                <td>
                    <a href="/detailLoan/{{$customer->id}}">View</a>
                    <a href="/editLoan/{{$customer->id}}">Edit</a>
                    <a onclick="return confirm('You click delete Customer {{$customer->id}}, Are you sure?')" href="/deleteLoan/{{$customer->id}}">Delete</a>
                </td>    
                  
            </tr>            
            @endforeach
            </tr>
        </tbody>
    </table>

@endsection
