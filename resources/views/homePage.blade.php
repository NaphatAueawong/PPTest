@extends('template')
@section('content')
    <h1>All Loans</h1>
    <button><a href="/addLoan">Add New Loan</a></button>
    
    <button onclick="showAdvanceSearch()">Advance Search</button>
    <div id="advanceSearch" style="display:none">
        <form action="/advanceSearch"method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Loan Amount(THB) </label>
                <div>
                    <label>Min: </label>
                    <input type="number" min="1000" max="100000000" step="1" id='minLoanAmount' name='minLoanAmount' value="1000" class="form-control" required/>
                    <label>Max: </label>
                    <input type="number" min="1000" max="100000000" step="1" id='maxLoanAmount' name='maxLoanAmount' value="100000000" class="form-control" required/>
                </div>
            </div>
            <div class="form-group">  
                <label>Interest Rate </label>
                <div>
                    <label>Min: </label>
                    <input type="number" min="1" max="36" step="0.01" id="minLoanTerm" name="minLoanTerm" value="1" class="form-control" required/>
                    <label>Max: </label>
                    <input type="number" min="1" max="36" step="0.01" id="maxLoanTerm" name="maxLoanTerm" value="36" class="form-control" required/>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="form-control">Search</button>
            </div>
        </form>
    </div>

    <hr>
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
    <script>
        function showAdvanceSearch() {
            var advanceSearch = document.getElementById("advanceSearch");
            if (advanceSearch.style.display == "none") {
                advanceSearch.style.display = "block";
            } else {
                advanceSearch.style.display = "none";
            }
        }
    </script>   


@endsection
