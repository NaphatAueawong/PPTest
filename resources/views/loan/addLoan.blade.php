@extends('template')
@section('content')
    <h1>Create Loan</h1>
    <form action="/addLoan"method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Loan Amount: </label>
            <input type="number" min="1000" max="100000000" step="1" id='loanAmount' name='loanAmount' value="1000" class="form-control" required/>
        </div>
        <div class="form-group">  
            <label>Loan Term: </label>
            <input type="number" min="1" max="50" step="1" id="loanTerm" name="loanTerm" value="1" class="form-control" required/>
        </div>
        <div class="form-group">
            <label>Interest Rate: </label>
            <input type="number" min="1" max="36" step="0.01" id="interestRate" name="interestRate" value="1" class="form-control" required/>
        </div>
        <div class="form-group">
            <label>Start Date: </label>
            <select name="startMonth">
                @foreach($months as $key => $month)
                    <option value="{{$month}}">{{$month}}</option>
                @endforeach
            </select>
            <input type="number" min="2017" max="2050" step="1"  id="startYear" name="startYear" value="2017" class="form-control" required/>
        </div>
        <div class="form-group">
            <button type="submit" class="form-control">Create</button>
            <button><a href="/">Back</a></button>
        </div>
    </form>
@endsection