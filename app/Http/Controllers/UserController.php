<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    $validator = Validator::make($request->all(), [
        'emp_id' => 'required|string|max:255|unique:users',
        'name' => 'required|string|max:255',
        'designation' => 'required|string|max:255',
        'remarks' => 'nullable|string|max:255',
        'site' => 'required|string|max:255',
        'factory' => 'required|string|exists:factories,factory_name',
        'email' => 'required|email|unique:users|max:255',
        'password'  => 'required|string|min:8',
        'department' => 'required|string|max:255',
        'phone' => 'nullable|string|max:255',
        'address' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $validatedData = $validator->validated();

    $employee = new User;
    $employee->fill($validatedData);
    $employee->password = Hash::make($validatedData['password']);
    $employee->save();

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
            'factory' => 'required|string|exists:factories,factory_name',
             'password' => 'nullable|string|min:8|confirmed', // Uncomment if you
            // Add more validation rules as needed
        ]);

        $employee = User::find($id);
        $employee->emp_id = $validatedData['emp_id'];
        $employee->name = $validatedData['name'];
        $employee->designation = $validatedData['designation'];
        $employee->remarks = $validatedData['remarks'];
        $employee->site = $validatedData['site'];
        $employee->factory = $validatedData['factory'];
        $employee->email = $validatedData['email'];
        $employee->department = $validatedData['department'];
        $employee->phone = $validatedData['phone'];
        $employee->address = $validatedData['address'];
        // Update password only if provided
        if (!empty($validatedData['password'])) {
            $employee->password = Hash::make($validatedData['password']);
        }
            // If password is not provided, keep the existing password
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
        if (!$employee) {
            // Handle the case when the employee is not found (you can redirect or display an error message)
            return redirect()->back()->with('error', 'Employee not found');
        }
        //$permissions = Permission::all();
        $user_permissions= UserPermission::where('user_id',$id)->get();

        $userPermissionIds = $user_permissions->pluck('permission_id')->toArray();

        //////

        $permissions = Permission::whereNotIn('id', $userPermissionIds)
        ->orderBy('description', 'asc')
        ->get();

       // return $permissions;

        // Check if the employee is found


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

    public function detailsUpdate($id)
    {
        $user = User::find($id);
        return view('employee.detailsUpdate', compact('user'));
    }

public function detailsUpdateStore(Request $request, $id)
{
    try {
        // Find the user or fail
        $user = User::findOrFail($id);

        // Validate request
        $request->validate([
            'emp_id' => 'required|string|max:255|unique:users,emp_id,' . $id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'site' => 'nullable|string|max:255',
            'factory' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed', // optional password validation
        ]);

        // Update user info
        $user->update($request->only([
            'emp_id',
            'name',
            'email',
            'designation',
            'department',
            'site',
            'factory',
            'phone',
            'address',
            'remarks',
        ]));

        // Update password if provided
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        // Return JSON response
        // return response()->json([
        //     'message' => 'Profile updated successfully!',
        //     'user' => $user,
        // ]);

       // OR, for web redirect:
        return redirect()
            ->route('user.detailsUpdateAny', $user->id)
            ->with('success', 'Profile updated successfully!');

    } catch (\Exception $e) {
        // Handle errors
        // return response()->json([
        //     'message' => 'Failed to update profile.',
        //     'error' => $e->getMessage(),
        // ], 500);

        return redirect()
            ->route('user.detailsUpdateAny', $user->id)
            ->with('error', 'Failed to update profile: ' . $e->getMessage());

        // OR, for web redirect:
        // return redirect()->back()->with('error', 'Failed to update profile: ' . $e->getMessage());
    }
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
