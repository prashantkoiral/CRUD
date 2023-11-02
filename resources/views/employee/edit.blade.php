<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
     <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <title>Create Employee</title>
    <style>
        .navbar-dark {
            background-color: #343a40 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <h4 class="text-light">Edit Employees</h4>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-success" href="{{ route('employees.index') }}">Back</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container mt-4">
    <form action="{{ route('employees.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Corrected line -->
        <div class="row">
    <div class="col">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
    </div>
    <div class="col">
        <img id="imagePreview" src="{{ asset($employee->image) }}" alt="Employee Image" width="100" height="100">
    </div>
</div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$employee->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$employee->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address',$employee->address) }}" required>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Update Employee</button>
    </form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-xmVRy3ou1AA5XwHj4lMAf2DhqD3JAx5fyzj+q5LVyUstjPLd/Pf5FcuW3j6bHQ"
        crossorigin="anonymous"></script>
</body>
</html>
