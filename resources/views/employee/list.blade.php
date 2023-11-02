<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Laravel CRUD Example</title>
     <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    
    <style>
        .navbar-dark {
            background-color: #343a40 !important;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <h4 class="text-light">Employees</h4>
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item">
                    <a class="nav-link btn btn-success ml-2" href="{{ route('employees.create') }}">Create</a>
                </li>
            </ul>
        </div>
    </nav>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif


<div class="container mt-4">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>
                 
               
                <img src="{{ asset($employee->image) }}" alt="Employee Image" width="50" height="50" class="rounded-circle">

</td> 
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->address }}</td>
                <td>{{ $employee->created_at }}</td>
                <td>
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <a href="#" onclick="deleteEmployee({{ $employee->id }})" class="btn btn-danger btn-sm">Delete</a>
<form id="employee-edit-action-{{ $employee->id }}" action="{{ route('employees.destroy', $employee->id) }}" method="post">
    @csrf
    @method('delete')
</form>

<script>
    function deleteEmployee(id) {
        if (confirm("Are you sure you want to delete?")) {
            document.getElementById('employee-edit-action-' + id).submit();
        }
    }
</script>

   
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between align-items-center mb-3">
    <div class="text-muted">Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} results</div>
    <div>{{ $employees->links('pagination::bootstrap-4') }}</div>
</div>


</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-xmVRy3ou1AA5XwHj4lMAf2DhqD3JAx5fyzj+q5LVyUstjPLd/Pf5FcuW3j6bHQ"
        crossorigin="anonymous"></script>
</body>
</html>
