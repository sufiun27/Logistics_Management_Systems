<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportFormApparel;
use App\Models\consignee;
use App\Models\DestCountry;
use App\Models\TtInformation;
use App\Models\Transport;
use App\Models\Export;
use App\DataTables\ExportFormApparelDataTable;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;


class ExportFormApparelController extends Controller
{
    
    public function exportFormApparel(ExportFormApparelDataTable $dataTable, Request $request){
        $export=Export::all();
        $site=$request->site;
        if (isset($request->start_date)&&isset($request->end_date)) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
             $start_date = \Carbon\Carbon::parse($start_date)->startOfDay()->format('Y-m-d H:i:s');
             $end_date = \Carbon\Carbon::parse($end_date)->endOfDay()->format('Y-m-d H:i:s');
 
          return $dataTable->with(['start_date' => $start_date, 'end_date' => $end_date, 'site' => $site])
          ->render('exportFormApparel.exportFormApparel',compact('export'));
        }else{
            return $dataTable->with([
                'site' => $site, 
            ])->render('exportFormApparel.exportFormApparel', compact('export'));
        }

    }

    //exportFormApparelDetails
    public function exportFormApparelDetails($id){
        $efa = ExportFormApparel::find($id);
        return view('exportFormApparel.exportFormApparelDetails',compact('efa'));
    }
    //exportFormApparelDetailsPdf
    public function exportFormApparelDetailsPdf($id){
        $efa = ExportFormApparel::find($id);
        $pdf = PDF::loadView('exportFormApparel.exportFormApparelDetailsPdf',compact('efa'));
        return $pdf->stream();
    }

    public function addExportFormApparel(){
        $consignee = Consignee::select('consignee_name')
                                    ->groupBy('consignee_name')
                                    ->get();

        $destcountry = DestCountry::select('country_name')
                                    ->groupBy('country_name')
                                    ->get();
        $transport=Transport::all();
        return view('exportFormApparel.addExportFormApparel',compact('consignee','destcountry','transport'));
    }
    

    public function addExportFormApparelConsigneeSite(Request $request){
        $consignee_name = $request->input('selectedOption');
        $consignee_site = consignee::where('consignee_name',$consignee_name)->get();
        
        $output = ' <select id="consignee_site" name="consignee_site" class="form-control site">';
            $output .= '<option value="">Select Site</option>';
        foreach($consignee_site as $row){
            $output .= '<option value="'.$row->consignee_site.'">'.$row->consignee_site.'</option>';
        }
         $output .= '</select>';

        echo $output;
    }

    public function addExportFormApparelConsigneeAddess(Request $request){
         $consignee_site = $request->input('site');
        
         $consignee = consignee::where('consignee_site',$consignee_site)->first();
          $output = '<input readonly type="text" name="consignee_address" 
         class="form-control"  value="'.$consignee->consignee_address.'" />';
        
         //$output='hi';
       // echo  $consignee->consignee_address;
        //echo $consignee_site;
        echo $output;
    }
    //exportFormApparel.addExportFormApparelDstCountryName

    public function addExportFormApparelDstCountryName(Request $request){
        $country_name = $request->input('dstCountryName');
        $dst = DestCountry::where('country_name', $country_name)->get();
    
        $output = '<select id="dst_country_port" name="dst_country_port" class="form-control port">';
        $output .= '<option value="">Select Port : Code</option>';
    
        foreach ($dst as $row) {
            $output .= '<option value="' . $row->port . '">' . $row->port . ' : ' . $row->country_code . '</option>';
        }
    
        $output .= '</select>';
    
        echo $output;
    }
    
    public function addExportFormApparelTtNo(Request $request){
        $tt_no = $request->input('tt_no');
        $tt = TtInformation::where('tt_no', $tt_no)->first();

        $output = '<input readonly type="text" name="site" class="form-control" value="'.$tt->tt_site.'" />';
        $output .= '<div class="text-primary">Total Amount:'.$tt->tt_amount.' Balance : '.$tt->tt_amount - $tt->tt_used_amount . '</div>';
        echo $output;
    }


    public function storeExportFormApparel(Request $request){
       // dd($request->all());
        $request->validate([
            'item_name' => 'required|string',
            'hs_code' => 'required|string',
            'hs_code_second' => 'nullable|string',

            'invoice_no' => 'required|string|unique:export_form_apparels,invoice_no',
            'invoice_date' => 'required|date',
            'contract_no' => 'required|string',
            'contract_date' => 'required|date',
            'consignee_name' => 'required|string',
            'consignee_site' => 'required|string',
            'consignee_address' => 'required|string',
            'dst_country_name' => 'required|string',
            'dst_country_port' => 'required|string|exists:dest_countries,port',

            'local_transport'=>'required|string',
            'section' => 'required|string',
            'tt_no' => 'required|string|exists:tt_information,tt_no',
            'site' => 'required|string',
            'tt_date' => 'required|date',
            'unit' => 'required|string',
            'quantity' => 'required|integer',
            'currency' => 'required|string',
            'amount' => 'required|numeric',
            'cm_percentage' => 'required|numeric',
            'incoterm' => 'required|string',
            'cm_amount' => 'required|numeric',
            'freight_value' => 'nullable|numeric',

            'exp_no' => 'nullable|string',
            'exp_date' => 'nullable|date',
            'exp_permit_no' => 'nullable|string',
            'bl_no' => 'nullable|string',
            'bl_date' => 'nullable|date',
            'ex_factory_date' => 'nullable|date',
           
            
        ]);
        
        $tt = TtInformation::where('tt_no', $request->input('tt_no'))->first();
        if($tt){

            if($tt->tt_amount - $tt->tt_used_amount < $request->input('cm_amount')){
                return redirect()->back()->with('error', 'CM Amount is greater than available balance.');
            }else{
                $tt->tt_used_amount = $tt->tt_used_amount + $request->input('cm_amount');
                $tt->save();
            }
        } else {
            return redirect()->back()->with('error', 'TT No not found.');
        }

        $exportFormApparel = new ExportFormApparel();
        $exportFormApparel->item_name = $request->input('item_name');
        $exportFormApparel->hs_code = $request->input('hs_code');
        $exportFormApparel->hs_code_second = $request->input('hs_code_second');

        $exportFormApparel->invoice_no = $request->input('invoice_no');
        $exportFormApparel->invoice_date = $request->input('invoice_date');
        $exportFormApparel->contract_no = $request->input('contract_no');
        $exportFormApparel->contract_date = $request->input('contract_date');
        $exportFormApparel->consignee_name = $request->input('consignee_name');
        $exportFormApparel->consignee_site = $request->input('consignee_site');
        $exportFormApparel->consignee_address = $request->input('consignee_address');
        $exportFormApparel->dst_country_name = $request->input('dst_country_name');
        $exportFormApparel->dst_country_port = $request->input('dst_country_port');

        $exportFormApparel->section = $request->input('section');
        $exportFormApparel->tt_no = $request->input('tt_no');

        $exportFormApparel->local_transport = $request->input('local_transport');
        $exportFormApparel->site = $request->input('site');
        $exportFormApparel->tt_date = $request->input('tt_date');
        $exportFormApparel->unit = $request->input('unit');
        $exportFormApparel->quantity = $request->input('quantity');
        $exportFormApparel->currency = $request->input('currency');
        $exportFormApparel->amount = $request->input('amount');
        $exportFormApparel->cm_percentage = $request->input('cm_percentage');
        $exportFormApparel->incoterm = $request->input('incoterm');
        $exportFormApparel->cm_amount = $request->input('cm_amount');
        $exportFormApparel->freight_value = $request->input('freight_value');

        $exportFormApparel->exp_no = $request->input('exp_no');
        $exportFormApparel->exp_date = $request->input('exp_date');
        $exportFormApparel->exp_permit_no = $request->input('exp_permit_no');
        $exportFormApparel->bl_no = $request->input('bl_no');
        $exportFormApparel->bl_date = $request->input('bl_date');
        $exportFormApparel->ex_factory_date = $request->input('ex_factory_date');
        $exportFormApparel->create_by = auth()->user()->emp_id;
        
        $exportFormApparel->save();

        // Optionally, you can redirect or return a response here.
        return redirect()->back()->with('success', 'Export form for apparel has been successfully created.');
        
    }


    public function exportFormApparelExFactory($id){
        $efa = ExportFormApparel::find($id);
        return view('exportFormApparel.exportFormApparelExFactory',compact('efa'));
    }
    
    public function exportFormApparelExFactoryUpdate(Request $request, $id){
        $request->validate([
            'exp_no' => 'required|string',
            'exp_date' => 'required|date',
            'exp_permit_no' => 'required|string',
            'bl_no' => 'required|string',
            'bl_date' => 'required|date',
            'ex_factory_date' => 'required|date',
        ]);

        $efa = ExportFormApparel::find($id);

        $efa->exp_no = $request->input('exp_no');
        $efa->exp_date = $request->input('exp_date');
        $efa->exp_permit_no = $request->input('exp_permit_no');
        $efa->bl_no = $request->input('bl_no');
        $efa->bl_date = $request->input('bl_date');
        $efa->ex_factory_date = $request->input('ex_factory_date');
        $efa->update_by = auth()->user()->emp_id;
        $efa->save();

        return redirect()->back()->with('success', 'Ex Factory successfully updated.');
    }

    //exportFormApparelEdit
    public function exportFormApparelEdit($id){
        $efa = ExportFormApparel::find($id);
        $consignee = Consignee::select('consignee_name')
                                    ->groupBy('consignee_name')
                                    ->get();

        $destcountry = DestCountry::select('country_name')
                                    ->groupBy('country_name')
                                    ->get();
         $transport=Transport::all();
        return view('exportFormApparel.exportFormApparelEdit',compact('efa','consignee','destcountry','transport'));
    }

    public function exportFormApparelUpdate(Request $request, $id){
        $request->validate([
            'item_name' => 'required|string',
            'hs_code' => 'required|string',
            'hs_code_second' => 'nullable|string',

            'invoice_no' => 'required|string|unique:export_form_apparels,invoice_no,'.$id,
            'invoice_date' => 'required|date',
            'contract_no' => 'required|string',
            'contract_date' => 'required|date',
            'consignee_name' => 'required|string',
            'consignee_site' => 'required|string',
            'consignee_address' => 'required|string',
            'dst_country_name' => 'required|string',
            'dst_country_port' => 'required|string|exists:dest_countries,port',

            'section' => 'required|string',
            'tt_no' => 'required|string|exists:tt_information,tt_no',
            'local_transport'=>'required|string',
            'site' => 'required|string',
            'tt_date' => 'required|date',
            'unit' => 'required|string',
            'quantity' => 'required|integer',
            'currency' => 'required|string',
            'amount' => 'required|numeric',
            'cm_percentage' => 'required|numeric',
            'incoterm' => 'required|string',
            'cm_amount' => 'required|numeric',
            'freight_value' => 'nullable|numeric',

            'exp_no' => 'nullable|string',
            'exp_date' => 'nullable|date',
            'exp_permit_no' => 'nullable|string',
            'bl_no' => 'nullable|string',
            'bl_date' => 'nullable|date',
            'ex_factory_date' => 'nullable|date',
           
            
        ]);

        $efa = ExportFormApparel::find($id);
        $tt = TtInformation::where('tt_no', $request->input('tt_no'))->first();
        if($tt){
            if($tt->tt_no != $efa->tt_no){
                $oldtt = TtInformation::where('tt_no', $efa->tt_no)->first();
                if($oldtt){
                    $oldtt->tt_used_amount = $oldtt->tt_used_amount - $efa->cm_amount;
                    $oldtt->save();
                }else{
                    return redirect()->back()->with('error', 'Old TT No not found.');
                }
            }else{
                $tt->tt_used_amount = $tt->tt_used_amount - $efa->cm_amount;
                $tt->save();
            }
            
            if($tt->tt_amount - $tt->tt_used_amount < $request->input('cm_amount')){
                return redirect()->back()->with('error', 'CM Amount is greater than available balance.');
            }else{
                $tt->tt_used_amount = $tt->tt_used_amount + $request->input('cm_amount');
                $tt->save();
            }
        } else {
            return redirect()->back()->with('error', 'TT No not found.');
        }

        $exportFormApparel = ExportFormApparel::find($id);
        $exportFormApparel->item_name = $request->input('item_name');
        $exportFormApparel->hs_code = $request->input('hs_code');
        $exportFormApparel->hs_code_second = $request->input('hs_code_second');

        $exportFormApparel->invoice_no = $request->input('invoice_no');
        $exportFormApparel->invoice_date = $request->input('invoice_date');
        $exportFormApparel->contract_no = $request->input('contract_no');
        $exportFormApparel->contract_date = $request->input('contract_date');
        $exportFormApparel->consignee_name = $request->input('consignee_name');
        $exportFormApparel->consignee_site = $request->input('consignee_site');
        $exportFormApparel->consignee_address = $request->input('consignee_address');
        $exportFormApparel->dst_country_name = $request->input('dst_country_name');
        $exportFormApparel->dst_country_port = $request->input('dst_country_port');

        $exportFormApparel->section = $request->input('section');
        $exportFormApparel->tt_no = $request->input('tt_no');
        
        $exportFormApparel->local_transport = $request->input('local_transport');
        $exportFormApparel->site = $request->input('site');
        $exportFormApparel->tt_date = $request->input('tt_date');
        $exportFormApparel->unit = $request->input('unit');
        $exportFormApparel->quantity = $request->input('quantity');
        $exportFormApparel->currency = $request->input('currency');
        $exportFormApparel->amount = $request->input('amount');
        $exportFormApparel->cm_percentage = $request->input('cm_percentage');
        $exportFormApparel->incoterm = $request->input('incoterm');
        $exportFormApparel->cm_amount = $request->input('cm_amount');
        $exportFormApparel->freight_value = $request->input('freight_value');

        $exportFormApparel->exp_no = $request->input('exp_no');
        $exportFormApparel->exp_date = $request->input('exp_date');
        $exportFormApparel->exp_permit_no = $request->input('exp_permit_no');
        $exportFormApparel->bl_no = $request->input('bl_no');
        $exportFormApparel->bl_date = $request->input('bl_date');
        $exportFormApparel->ex_factory_date = $request->input('ex_factory_date');
        $exportFormApparel->update_by = auth()->user()->emp_id;
        
        $exportFormApparel->save();

        // Optionally, you can redirect or return a response here.
        return redirect()->back()->with('success', 'Export form for apparel has been successfully Updated.');
        

    }
    //exportFormApparelDelete
    public function exportFormApparelDelete($id){

        $efa = ExportFormApparel::find($id);

        $tt = TtInformation::where('tt_no', $efa->tt_no)->first();
        if($tt){
                $tt->tt_used_amount = $tt->tt_used_amount - $efa->cm_amount;
                $tt->save();
        } else {
            return redirect()->back()->with('error', 'TT No not found.');
        }

        $efa->delete();
        return redirect()->route('exportFormApparel.exportFormApparel')->with('success', 'Export form for apparel has been successfully Deleted.');
    }





}