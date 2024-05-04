<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="card ">
      
      <div class="card-header">
        <div class="card-title">
          <h5>Export Form </h5>
        </div>
      </div>
      
      
      
  <div class="card-body">
  


    <table class="table  table-sm">
      <tr>
          <td>
              <!-- First td -->
              <table class="table  table-sm">
                  <tr>
                      <td class="fw-bold">Item Name:</td>
                      <td>{{$efa->item_name}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">HS Code:</td>
                      <td>{{$efa->hs_code}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">Invoice No:</td>
                      <td>{{$efa->invoice_no}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">Invoice Date:</td>
                      <td>{{$efa->invoice_date}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">Contract No:</td>
                      <td>{{$efa->contract_no}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">Contract Date:</td>
                      <td>{{$efa->contract_date}}</td>
                  </tr>
              </table>
          </td>
  
          <td >
              <!-- Second td -->
              <table class="table table-sm">
                  <!-- Previous details -->
                  <tr>
                      <td class="fw-bold">Consignee Name:</td>
                      <td>{{$efa->consignee_name}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">Consignee Site:</td>
                      <td>{{$efa->consignee_site}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">Consignee Address:</td>
                      <td>{{$efa->consignee_address}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">DST Country:</td>
                      <td>{{$efa->dst_country_name}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">DST Country Port:</td>
                      <td>{{$efa->dst_country_port}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">Section:</td>
                      <td>{{$efa->section}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">TT No:</td>
                      <td>{{$efa->tt_no}}</td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Local Transport:</td>
                    <td>{{$efa->local_transport}}</td>
                </tr>
                  <tr>
                      <td class="fw-bold">Site:</td>
                      <td>{{$efa->site}}</td>
                  </tr>
                  <tr>
                      <td class="fw-bold">TT Date:</td>
                      <td>{{$efa->tt_date}}</td>
                  </tr>
                  <!-- Add more details as needed -->
              </table>
          </td>
      </tr>

      <tr>
        <td> {{--first--}}
          <table class="table table-sm">
            <th colspan="2">Quantity & Value</th>
            
            <!-- Previous details -->
            <tr>
              <td >Unit:</td>
              <td >{{$efa->unit}}</td>
            </tr>
            <tr>
              <td >Quantity:</td>
              <td >{{$efa->quantity}}</td>
            </tr>
            <tr>
              <td >Currency:</td>
              <td >{{$efa->currency}}</td>
            </tr>
            <tr>
              <td >Amount:</td>
              <td >{{$efa->amount}}</td>
            </tr>
            <tr>
              <td >CM Percentage:</td>
              <td >{{$efa->cm_percentage}}</td>
            </tr>
            <tr>
              <td >Incoterm:</td>
              <td >{{$efa->incoterm}}</td>
            </tr>
            <tr>
              <td >CM Amount:</td>
              <td >{{$efa->cm_amount}}</td>
            </tr>
            <tr>
              <td >Freight Value:</td>
              <td >{{$efa->freight_value}}</td>
            </tr>
            <!-- Add more details as needed -->
          </table>
        </td>

        <td>{{--second--}}
          <table class="table table-sm">
            <th colspan="2">Ex-Factory Information</th>
            <tr>
              <td >Exp No:</td>
              <td >{{$efa->exp_no}}</td>
            </tr>
            <tr>
              <td >Exp Date:</td>
              <td >{{$efa->exp_date}}</td>
            </tr>
            <tr>
              <td >Exp Permit No:</td>
              <td >{{$efa->exp_permit_no}}</td>
            </tr>
            <tr>
              <td >BL No:</td>
              <td >{{$efa->bl_no}}</td>
            </tr>
            <tr>
              <td >BL Date:</td>
              <td >{{$efa->bl_date}}</td>
            </tr>
            <tr>
              <td >Ex Factory Date:</td>
              <td >{{$efa->ex_factory_date}}</td>
            </tr>
            <tr>
              <th colspan="2">Track Record</th> <!-- Adding a horizontal line -->
            </tr>
            <tr>
              <td >Created By:</td>
              <td >{{$efa->create_by}}</td>
            </tr>
            <tr>
              <td >Created At:</td>
              <td >{{$efa->created_at}}</td>
            </tr>
            <tr>
              <td >Updated By:</td>
              <td >{{$efa->update_by}}</td>
            </tr>
            <tr>
              <td >Updated At:</td>
              <td >{{$efa->updated_at}}</td>
            </tr>
          </table>
        </td>
      </tr>
  </table>
  
      <!-- Add more sections and styling as needed -->
  
  </div>
  </div>
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>