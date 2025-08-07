<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;

class TransportController extends Controller
{
    public function transport()
    {
        $transports = Transport::paginate(10); // Paginate the results to show 10 per page
        return view('transport.transport', compact('transports'));
    }
    public function addTransport()
    {
        return view('transport.addTransport');
    }
    public function storeTransport(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:transports',
            'address' => 'required',
            'port' => 'required',
        ]);
        $transport = new Transport();
        $transport->name = $request->name;
        $transport->address = $request->address;
        $transport->port = $request->port;
        $transport->save();
        return redirect()->back()->with('success', 'Transport added successfully');
    }
    public function editTransport($id)
    {
        $transport = Transport::find($id);
        return view('transport.editTransport', compact('transport'));
    }
    public function updateTransport(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:transports,name,' . $id,
            'address' => 'required',
            'port' => 'required',
        ]);
        $transport = Transport::find($id);
        $transport->name = $request->name;
        $transport->address = $request->address;
        $transport->port = $request->port;
        $transport->save();
        return redirect()->back()->with('success', 'Transport updated successfully');
    }
    public function deleteTransport($id)
    {
        $transport = Transport::find($id);
        $transport->delete();
        return redirect()->route('transport.transport')->with('success', 'Transport deleted successfully');
    }

}
