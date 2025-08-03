<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function list()
    {
        
        $employees = User::all();
        return view('employee.list', compact('employees'));
    }

    ///ACTIVE///////////
    public function activate($id)
    {
        // Find the employee by ID
        $employee = User::find($id);

        // Check if the employee is found
        if (!$employee) {
            // Handle the case when the employee is not found (you can redirect or display an error message)
            return redirect()->back()->with('error', 'Employee not found');
        }

        // Update the status to 1
        $employee->update(['status' => 1]);

        // Redirect or perform any other action
        return redirect()->back()->with('success', 'Employee status updated');
    }
    /////Deactive////////////
    public function deactivate($id)
    {
                // Find the employee by ID
                $employee = User::find($id);

                // Check if the employee is found
                if (!$employee) {
                    // Handle the case when the employee is not found (you can redirect or display an error message)
                    return redirect()->back()->with('error', 'Employee not found');
                }
        
                // Update the status to 1
                $employee->update(['status' => 0]);
        
                // Redirect or perform any other action
                return redirect()->back()->with('success', 'Employee status updated');
    }

    ///////////////STORE/////////////////////

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'emp_id' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:255',
            'site' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password'  => 'required|string|min:8',
            'department' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            // Add more validation rules as needed
        ]);

        $employee = new User;
        $employee->emp_id = $validatedData['emp_id'];
        $employee->name = $validatedData['name'];
        $employee->designation = $validatedData['designation'];
        $employee->remarks = $validatedData['remarks'];
        $employee->site = $validatedData['site'];
        $employee->email = $validatedData['email'];
        $employee->password = $validatedData['password'];
        $employee->department = $validatedData['department'];
        $employee->phone = $validatedData['phone'];
        $employee->address = $validatedData['address'];

        // Save the employee to the database
        $employee->save();

        // You can also return a response, redirect, or perform any other actions as needed
        return redirect()->back()->with('success', 'Employee added successfully');
    }

    ///Edit/////////////////////
    public function edit($id)
    {
        // Find the employee by ID
        $employee = User::find($id);

        // Check if the employee is found
        if (!$employee) {
            // Handle the case when the employee is not found (you can redirect or display an error message)
            return redirect()->back()->with('error', 'Employee not found');
        }

        // Return the employee to the edit view
        return view('employee.edit', compact('employee'));
    }

    /////////////UPDATE/////////////////////
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'emp_id' => 'required|string|max:255|unique:users,emp_id,'.$id,
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:255',
            'site' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id.'|max:255',
            'department' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            // Add more validation rules as needed
        ]);

        $employee = User::find($id);
        $employee->emp_id = $validatedData['emp_id'];
        $employee->name = $validatedData['name'];
        $employee->designation = $validatedData['designation'];
        $employee->remarks = $validatedData['remarks'];
        $employee->site = $validatedData['site'];
        $employee->email = $validatedData['email'];
        $employee->department = $validatedData['department'];
        $employee->phone = $validatedData['phone'];
        $employee->address = $validatedData['address'];
        // Save the employee to the database
        $employee->save();

        // You can also return a response, redirect, or perform any other actions as needed
        return redirect()->back()->with('success', 'Employee updated successfully');
        
    }
    /////////////DELETE/////////////////////
    public function delete($id)
    {
        // Find the employee by ID
        $employee = User::find($id);

        // Check if the employee is found
        if (!$employee) {
            // Handle the case when the employee is not found (you can redirect or display an error message)
            return redirect()->back()->with('error', 'Employee not found');
        }

        // Delete the employee
        $employee->delete();

        // Redirect or perform any other action
        return redirect()->back()->with('success', 'Employee deleted successfully');
    }
    /////////////PERMISSIONS/////////////////////
    public function permissions($id)
    {
        // Find the employee by ID
        $employee = User::find($id);
        //$permissions = Permission::all();
        $user_permissions= UserPermission::where('user_id',$id)->get();
        //////
        
        $permissions = Permission::whereDoesntHave('UserPermission', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->get();

        // Check if the employee is found
        if (!$employee) {
            // Handle the case when the employee is not found (you can redirect or display an error message)
            return redirect()->back()->with('error', 'Employee not found');
        }

        // Return the employee to the edit view
        return view('employee.permissions', compact('employee', 'permissions', 'user_permissions'));
    }
    /////////////ADD PERMISSIONS/////////////////////
    public function addpermissions($e_id, $p_id)
    {
        $userPermission = new UserPermission();
        // Set the user_id and permission_id attributes
        $userPermission->user_id = $e_id;
        $userPermission->permission_id = $p_id;

        // Save the new record to the database
        $userPermission->save();

        // You can add additional logic or redirect back with a success message if needed
        return redirect()->back()->with('success', 'Permission added successfully');
    }
    /////////////REMOVE PERMISSIONS/////////////////////
    public function removepermissions($id)
    {
        // Find the user permission by ID
        $userPermission = UserPermission::find($id);

        // Check if the user permission is found
        if (!$userPermission) {
            // Handle the case when the user permission is not found (you can redirect or display an error message)
            return redirect()->back()->with('error', 'Permission not found');
        }

        // Delete the user permission
        $userPermission->delete();

        // Redirect or perform any other action
        return redirect()->back()->with('success', 'Permission deleted successfully');
    }
    /////////////ACTIVATE PERMISSIONS/////////////////////
    public function activatepermissions($id)
    {
        // Find the user permission by ID
        $userPermission = UserPermission::find($id);

        // Check if the user permission is found
        if (!$userPermission) {
            // Handle the case when the user permission is not found (you can redirect or display an error message)
            return redirect()->back()->with('error', 'Permission not found');
        }

        // Update the status to 1
        $userPermission->update(['status' => 1]);

        // Redirect or perform any other action
        return redirect()->back()->with('success', 'Permission status updated');
    }
    /////////////DEACTIVATE PERMISSIONS/////////////////////
    public function deactivatepermissions($id)
    {
        // Find the user permission by ID
        $userPermission = UserPermission::find($id);

        // Check if the user permission is found
        if (!$userPermission) {
            // Handle the case when the user permission is not found (you can redirect or display an error message)
            return redirect()->back()->with('error', 'Permission not found');
        }

        // Update the status to 0
        $userPermission->update(['status' => 0]);

        // Redirect or perform any other action
        return redirect()->back()->with('success', 'Permission status updated');
    }


    //! user details :
    public function userDetails()
    {
        $user = auth()->user();
        return view('employee.details', compact('user'));
    }

    public function userDetailsUpdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
            'old_password' => 'nullable|string|min:6',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'department' => $request->department,
            'site' => $request->site,
            'phone' => $request->phone,
            'address' => $request->address,
            'remarks' => $request->remarks,
        ]);

        // ✅ Update password only if entered
        if ($request->filled('old_password') && $request->filled('password')) {

            // Check if the old password matches
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->withErrors(['old_password' => 'The provided password does not match our records.']);
            }
            // Update the password
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('user.details', $user->id)->with('success', 'Profile updated successfully!');
    }

    public function userDetailsPermissions(){
        $user = auth()->user();
        $permissions = Permission::all();
        $user_permissions = UserPermission::where('user_id', $user->id)->get();

        // Check if the user is found
        if (!$user) {
            // Handle the case when the user is not found (you can redirect or display an error message)
            return redirect()->back()->with('error', 'User not found');
        }

        // return response()->json([
        //     'user' => $user,
        //     'permissions' => $permissions,
        //     'user_permissions' => $user_permissions
        // ]);

        // Return the user to the permissions view
        return view('employee.userpermissions', compact('user', 'permissions', 'user_permissions'));
    }


}
