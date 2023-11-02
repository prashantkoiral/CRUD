<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::OrderBy('id','DESC')->paginate(5);
        return view('employee.list',['employees'=>$employees]);
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'image' => 'sometimes|image|mimes:gif,png,jpeg,jpg',
    ]);

    if ($validator->passes()) {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        
        //upload image here
        if ($request->hasFile('image')) {
            $newFileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/employees'), $newFileName);

            $employee->image = 'uploads/employees/' . $newFileName; // Set the image path
        }



        $employee->save();

        $request->session()->flash('success', 'Employee added successfully.');
        return redirect()->route('employees.index');
    } else {
        return redirect()->route('employees.create')->withErrors($validator)->withInput();
    }

}
public function edit($id)
{
    $employee = Employee::findOrFail($id);
   
    return view('Employee.edit',['employee' => $employee]);    
}
public function update($id, Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'image' => 'sometimes|image|mimes:gif,png,jpeg,jpg',
    ]);

    if ($validator->passes()) {
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->route('employees.index')->with('error', 'Employee not found.');
        }
        // Delete old image if exists
        if ($request->hasFile('image') && $employee->image) {
            // Delete the old image file
            $oldImagePath = public_path($employee->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->address = $request->input('address');

        // Upload new image if provided
        if ($request->hasFile('image')) {
            $newFileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/employees'), $newFileName);
            $employee->image = 'uploads/employees/' . $newFileName;
        }

        $employee->save();

        $request->session()->flash('success', 'Employee updated successfully.');
        return redirect()->route('employees.index');
    } else {
        return redirect()->route('employees.edit', $id)->withErrors($validator)->withInput();
    }
}
public function destroy($id, Request $request)
{
    $employee = Employee::findOrFail($id);
    
    // Get the full image path
    $imagePath = public_path('/uploads/employees/' . $employee->image);

   // Delete old image if exists
   if ($request->hasFile('image') && $employee->image) {
    // Delete the old image file
    $oldImagePath = public_path($employee->image);
    if (file_exists($oldImagePath)) {
        unlink($oldImagePath);
    }
}

    // Delete the employee record
    $employee->delete();

$request->session()->flash('success','Employee Deleted successfully');
return redirect()->route('employees.index');

 
    // Add any further actions you want to take after deleting the employee
}


}
