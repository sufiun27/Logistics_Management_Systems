@extends('template.index')

@section('content')
<div class="card">
  <div class="card-header"><a href="{{route('exportFormApparel.exportFormApparel')}}" class="btn btn-success btn-sm">Back</a></div>
    <x-message/>
  <div class="card-body">
         <form action="{{route('exportFormApparel.exportFormApparelUpdate',$efa->id)}}" method="POST"> {{--TODO -----------------------------------------------------------------------------}}
           @csrf
            <div class="row"> {{---- row 1 start--}}
                <div class="col-6">{{---- col1 start--}}

                    <div class="form-group row">
                          <label for="item_name" class="col-sm-3 text-end control-label col-form-label">Item Name:</label>
                      <div class="col-sm-9"> 
                          <input type="text" required name="item_name" class="form-control" id="item_name" placeholder="item Name" value="{{ $efa->item_name }}" /> 
                      </div> 
                    </div>

                    <div class="form-group row">
                        <label for="hs_code" class="col-sm-3 text-end control-label col-form-label">HS Code:</label>
                    <div class="col-sm-9"> 
                        <input type="text" required name="hs_code" class="form-control" id="hs_code" placeholder="HS Code" value="{{ $efa->hs_code }}" /> 
                    </div> 
                  </div>

                  <div class="form-group row">
                        <label for="hs_code_second" class="col-sm-3 text-end control-label col-form-label">HS Code Second:</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="hs_code_second" class="form-control" id="hs_code_second" placeholder="HS Code_second" value="{{ $efa->hs_code_second }}" /> 
                        </div> 
                   </div>

                   <div class="form-group row">
                    <label for="invoice_no" class="col-sm-3 text-end control-label col-form-label">Invoice No:</label>
                    <div class="col-sm-9"> 
                        <input type="text" required name="invoice_no" class="form-control" id="invoice_no" placeholder="invoice_no" value="{{ $efa->invoice_no }}" /> 
                    </div> 
                   </div>

                   <div class="form-group row">
                    <label for="invoice_date" class="col-sm-3 text-end control-label col-form-label">Invoice Date:</label>
                    <div class="col-sm-9"> 
                        <input type="date" required name="invoice_date" class="form-control" id="invoice_date" placeholder="invoice_date" value="{{ $efa->invoice_date}}" /> 
                    </div> 
                   </div>

                   <div class="form-group row">
                    <label for="contract_no" class="col-sm-3 text-end control-label col-form-label">Contract No:</label>
                    <div class="col-sm-9"> 
                        <input type="text" required name="contract_no" class="form-control" id="contract_no" placeholder="contract_no" value="{{ $efa->contract_no }}" /> 
                    </div> 
                   </div>

                   <div class="form-group row">
                    <label for="contract_date" class="col-sm-3 text-end control-label col-form-label">Contract Date:</label>
                    <div class="col-sm-9"> 
                        <input type="date" required name="contract_date" class="form-control" id="contract_date" placeholder="contract_date" value="{{ $efa->contract_date }}" /> 
                    </div> 
                   </div>
                      
                </div>{{---- col1 end--}}

                <div class="col-6"> {{---- col2 start--}}
                   
                    <div class="form-group row">
                        <label for="coptions" class="col-sm-3 text-end control-label col-form-label">Consignee Name:</label>
                        <div class="col-sm-9"> 
                            <select id="options" required name="consignee_name" class="form-control">
                                <option value="">Select Consignee Name</option>
                                @foreach($consignee as $consignee)
                                <option value="{{$consignee->consignee_name}}" @if($consignee->consignee_name==$efa->consignee_name) selected @endif >{{$consignee->consignee_name}}</option>
                                @endforeach
                            </select>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="consignee_site" class="col-sm-3 text-end control-label col-form-label">Consignee site:</label>
                        <div class="col-sm-9"> 
                            <div id="result"><input readonly type="text" name="consignee_site" class="form-control" placeholder="{{$efa->consignee_site}}" value="{{$efa->consignee_site}}"/></div>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="consignee_address" class="col-sm-3 text-end control-label col-form-label">Consignee Address:</label>
                        <div class="col-sm-9"> 
                            <div id="address">
                                <input readonly type="text" name="consignee_address" 
                                class="form-control"  value="{{$efa->consignee_address}}" />
                            </div> 
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="dst_country_name" class="col-sm-3 text-end control-label col-form-label">Destination Country:</label>
                        <div class="col-sm-9">
                            <select id="dst_country_name" required name="dst_country_name" class="form-control">
                                <option value="" disabled selected>Select Destination Country</option>
                                @foreach($destcountry as $destcountry)
                                    <option value="{{ $destcountry->country_name }}" {{ $destcountry->country_name == $efa->dst_country_name ? 'selected' : '' }}>
                                        {{ $destcountry->country_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    

                       <div class="form-group row">
                        <label for="port" class="col-sm-3 text-end control-label col-form-label">Port</label>
                        <div class="col-sm-9"> 
                            <div id="dst_port"><input readonly type="text" name="dst_country_port" class="form-control" value="{{$efa->dst_country_port}}"/></div>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="local_transport" class="col-sm-3 text-end control-label col-form-label">Local Transport:</label>
                        <div class="col-sm-9"> 
                            <select id="local_transport" required name="local_transport" class="form-control">
                                <option value="">Select Local Transport</option>
                                @foreach($transport as $transport)
                                <option value="{{$transport->port}}" @if($transport->port==$efa->local_transport) selected @endif>{{$transport->port}}</option>
                                @endforeach
                            </select>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="section" class="col-sm-3 text-end control-label col-form-label">Section</label>
                        <div class="col-sm-9"> 
                            <input readonly  name="section" id="section" type="text" class="form-control" value="Private" placeholder="Private"/>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="tt_no" class="col-sm-3 text-end control-label col-form-label">TT No </label>
                        <div class="col-sm-9"> 
                            <input name="tt_no" required id="tt_no" type="text" class="form-control" value="{{ $efa->tt_no }}" placeholder="Put TT No"/>
                            
                        </div> 
                       </div>
                       
                       

                       <div class="form-group row">
                        <label for="site" class="col-sm-3 text-end control-label col-form-label">Site </label>
                        <div class="col-sm-9">
                            <div id="tt_validation"><input readonly type="text" name="site" class="form-control" value="{{$efa->site}}" /></div>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="tt_date" class="col-sm-3 text-end control-label col-form-label">TT date </label>
                        <div class="col-sm-9"> 
                            <input name="tt_date" required id="tt_date" type="date" class="form-control" value="{{ $efa->tt_date }}" placeholder="Put TT date"/>
                        </div> 
                       </div>



                </div>{{---- col2 end--}}

            </div>{{---- row 1 end--}}

            <div class="row">{{---- row 2 start--}}
                <div class="col-6">{{---- col1 start--}}
                    <h4>Quantity & Value Entry</h4>
                    <hr>

                    <div class="form-group row">
                        <label for="unit" class="col-sm-3 text-end control-label col-form-label">Unit:</label>
                        <div class="col-sm-9"> 
                            <select id="unit" required name="unit" class="form-control">
                                <option value="PCS" @if($efa->unit == 'PCS') selected @endif>PCS</option>
                                <option value="SET" @if($efa->unit == 'SET') selected @endif>SET</option>
                            </select>
                            
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="quantity" class="col-sm-3 text-end control-label col-form-label">Quantity </label>
                        <div class="col-sm-9"> 
                            <input required name="quantity" id="quantity" type="number" class="form-control" value="{{ $efa->quantity }}" placeholder="Quantity"/>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="currency" class="col-sm-3 text-end control-label col-form-label">Currency:</label>
                        <div class="col-sm-9"> 
                            <select required id="currency" name="currency" class="form-control">
                                <option value="USDollers"  @if($efa->currency== 'USDollers') selected @endif>USDollers</option>
                                <option value="EUros" @if($efa->currency== 'EUros') selected @endif>EUros</option>
                                <option value="Pound" @if($efa->currency== 'Pound') selected @endif>Pound</option>
                            </select>
                        </div> 
                       </div>

                       

                       <div class="form-group row">
                        <label for="amount" class="col-sm-3 text-end control-label col-form-label">amount </label>
                        <div class="col-sm-9"> 
                            <input required name="amount" id="amount" type="number" class="form-control"  placeholder="Previous: {{ $efa->amount }}"/>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="cm_percentage" class="col-sm-3 text-end control-label col-form-label">CM Percentage</label>
                        <div class="col-sm-9"> 
                            <input required name="cm_percentage" id="cm_percentage" type="number" class="form-control"  placeholder="Previous: {{$efa->cm_percentage}}%"/>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="incoterm" class="col-sm-3 text-end control-label col-form-label">Incoterm:</label>
                        <div class="col-sm-9"> 
                            <select id="incoterm" required name="incoterm" class="form-control">
                                <option value="">Select Incoterm</option>
                                <option value="FOB">FOB</option>
                                <option value="CPT">CPT</option>
                                <option value="CFR">CFR</option>
                                <option value="DDP">DDP</option>
                                <option value="FCA">FCA</option>
                                <option value="CIF">CIF</option>
                                <option value="DAP">DAP</option>
                                <option value="EXW">EXW</option>
                                <option value="CnF">CnF</option>
                            </select>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="cm_amount" class="col-sm-3 text-end control-label col-form-label">CM Amount: </label>
                        <div class="col-sm-9"> 
                            
                            <div id="incoterm_calculation">Calculate Automatically</div>
                        </div> 
                       </div>

                       <div id="freight_value"></div>

                       

                       
                </div>{{---- col1 end--}}
                <div class="col-6">{{---- col2 start--}}
                    <h4>Ex-Factory Information Entry</h4>
                    <hr>

                    <div class="form-group row">
                        <label for="exp_no" class="col-sm-3 text-end control-label col-form-label">Exp No: </label>
                        <div class="col-sm-9"> 
                            <input name="exp_no" id="exp_no" type="number" class="form-control" value="{{ $efa->exp_no }}" placeholder="Exp No"/>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="exp_date" class="col-sm-3 text-end control-label col-form-label">Exp Date: </label>
                        <div class="col-sm-9"> 
                            <input name="exp_date" id="exp_date" type="date" class="form-control" value="{{ $efa->exp_date }}" placeholder="Exp Date"/>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="exp_permit_no" class="col-sm-3 text-end control-label col-form-label">Exp Permit No: </label>
                        <div class="col-sm-9"> 
                            <input name="exp_permit_no" id="exp_permit_no" type="text" class="form-control" value="{{ $efa->exp_permit_no }}" placeholder="Exp Permit No"/>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="bl_no" class="col-sm-3 text-end control-label col-form-label">B/L No: </label>
                        <div class="col-sm-9"> 
                            <input name="bl_no" id="bl_no" type="text" class="form-control" value="{{ $efa->bl_no }}" placeholder="B/L No"/>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="bl_date" class="col-sm-3 text-end control-label col-form-label">B/L Date: </label>
                        <div class="col-sm-9"> 
                            <input name="bl_date" id="bl_date" type="date" class="form-control" value="{{ $efa->bl_date }}" placeholder="B/L Date"/>
                        </div> 
                       </div>

                       <div class="form-group row">
                        <label for="ex_factory_date" class="col-sm-3 text-end control-label col-form-label">EX-Factory Date: </label>
                        <div class="col-sm-9"> 
                            <input name="ex_factory_date" id=ex_factory_date" type="date" class="form-control" value="{{ $efa->ex_factory_date }}" placeholder="EX-Factory Date"/>
                        </div> 
                       </div>


                </div>{{---- col2 end--}}
            </div> {{--   ///row 2 end--}}

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      
 

    
    
    </div>{{--   ///body --}}
</div>  {{--   ///card --}}

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
$(document).ready(function() {
//Consignee////////////////////////////////////////////////
    // Event listener for the select element
    $('#options').on('change', function() {
        // Get the selected option value
        var selectedOption = $(this).val();

        // Display the selected option on the page - $('#result').text('Selected option: ' + selectedOption);
        //i want to pass this value to the controller though ajax post methos and display the result in the div below
        $.ajax({
            url: "{{route('exportFormApparel.addExportFormApparelConsigneeSite')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "selectedOption": selectedOption
            },
            success: function(response) {
                //remove previous data
                $('#result').trigger("reset");
                $('#result').html(response);
            },
        });//end of ajax
       
    });//first document for site


    
    $(document).on('change', '.site' , function() {
        var site =$(this).val();
        //alert(site);
        //$('#address').text('site: ' + site);
        $.ajax({
            url: "{{route('exportFormApparel.addExportFormApparelConsigneeAddress')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "site": site
            },
            success: function(response) {
                //remove previous data
                $('#address').trigger("reset");
                $('#address').html(response);
            },
        });//end of ajax
        
     });
//Consignee end////////////////////////////////////////////////

//Destination////////////////////////////////////////////////
$('#dst_country_name').on('change', function() {
        // Get the selected option value
        var dstCountryName = $(this).val();

        // Display the selected option on the page - $('#result').text('Selected option: ' + selectedOption);
        //i want to pass this value to the controller though ajax post methos and display the result in the div below
        $.ajax({
            url: "{{route('exportFormApparel.addExportFormApparelDstCountryName')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "dstCountryName": dstCountryName
            },
            success: function(response) {
                //remove previous data
                $('#dst_port').trigger("reset");
                $('#dst_port').html(response);
            },
        });//end of ajax
       
    });//first document for site
//End Destination////////////////////////////////////////////////


//TT No////////////////////////////////////////////////
$('#tt_no').on('input', function() {
        // Get the selected option value
        var tt_no = $(this).val();
       // $('#tt_validation').text('TT Information: ' + tt_no);
        // Display the selected option on the page - $('#result').text('Selected option: ' + selectedOption);
        //i want to pass this value to the controller though ajax post methos and display the result in the div below
        $.ajax({
            url: "{{route('exportFormApparel.addExportFormApparelTtNo')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "tt_no": tt_no
            },
            success: function(response) {
                //remove previous data
                $('#tt_validation').trigger("reset");
                $('#tt_validation').html(response);
            },
        });//end of ajax
       
    });//first document for site
//End TT No////////////////////////////////////////////////


//incoterm////////////////////////////////////////////////
var cm_percentage, amount, incoterm;

$('#cm_percentage').on('input', function() {
    // Get the selected option value
    cm_percentage = $(this).val();
    updateIncotermCalculation();
});

$('#amount').on('input', function() {
    // Get the selected option value
    amount = $(this).val();
    updateIncotermCalculation();
});

$('#incoterm').on('change', function() {
    // Get the selected option value
    incoterm = $(this).val();
    $('#freight_value').html('');
    updateIncotermCalculation();
});

function updateIncotermCalculation() {
    // Check if values are not null or undefined
    if (cm_percentage != null && amount != null && incoterm != null) {
        $('#incoterm_calculationt').trigger("reset");
        if(incoterm == 'FOB' || incoterm == 'CFR' || incoterm == 'FCA' || incoterm == 'EXW' )
        {   
            var incoterm_calculation = ( amount / 100) * cm_percentage;
            var output='<input readonly name="cm_amount" id="cm_amount" type="text" class="form-control" value="' + incoterm_calculation + '" placeholder="' + incoterm_calculation + '"/>';
            $('#incoterm_calculationt').trigger("reset");
            $('#freight_value').trigger("reset");
            $('#incoterm_calculation').html(output);

        }
        else if(incoterm == 'CPT' || incoterm == 'CIF' || incoterm == 'DAP' || incoterm == 'DDP')
        {
            var incoterm_calculation = ( amount / 100) * cm_percentage;
            var output='<input readonly name="cm_amount" id="cm_amount" type="text" class="form-control" value="' + incoterm_calculation + '" placeholder="' + incoterm_calculation + '"/>';
            var output1 =
            '<div class="form-group row">' +
            '<label for="freight_value" class="col-sm-3 text-end control-label col-form-label">Freight Value: </label>' +
            '<div class="col-sm-9">' +
            '<input name="freight_value" id="freight_value" type="text" class="form-control" placeholder="Freight Value"/>' +
            '</div>' +
            '</div>';
            $('#incoterm_calculationt').trigger("reset");
            $('#incoterm_calculation').html(output);
            $('#freight_value').trigger("reset");
            $('#freight_value').html(output1);
        }
    }
}

///incoterm end////////////////////////////////////////////////


}); //end of document ready


</script>


@endsection

