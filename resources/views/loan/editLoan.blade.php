@extends('template')
@section('content')
    <h1>Edit Loan</h1>
    <form action="/editLoan/{{$customer->id}}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <span>Loan Amount</span>
            <input type="number"  min="1000" max="100000000" step="1" id='loanAmount' name='loanAmount' value="{{$customer->loanAmount}}" class="form-control" required/>
        </div>
        <div class="form-control">
            <span>Loan Term</span>
            <input type="number" min="1" max="50" step="1" id="loanTerm" name="loanTerm" value="{{$customer->loanTerm}}" class="form-control" required/>
        </div>
        <div class="form-group">
            <span>Interest Rate</span>
            <input type="number" min="1" max="36" step="0.01" id="interestRate" name="interestRate" value="{{$customer->interestRate}}" class="form-control" required/>
        </div>
        <div class="form-group">
            <span>Start Date</span>
            <select name="startMonth">
            @foreach($months as $key => $month)
                @if($month == $customer->startMonth)
                    <option selected value="{{$month}}">{{$month}}</option >
                @else   
                    <option value="{{$month}}">{{$month}}</option>
                @endif
            @endforeach
            </select>
            <input type="number" min="2017" max="2050" step="1" id="startYear" name="startYear" value="{{$customer->startYear}}" class="form-control" required/>
        </div>
        <div class="form-group">
            <button type="submit" class="form-control">Update</button>
            <button><a href="/">Back</a></button>
        </div>
    </form>                     
@endsection