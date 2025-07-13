<!doctype html>
<html lang="en">
  <head>
    <title>Export Form Details</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
      th { font-weight: bold; }
      .section-heading { font-size: 0.95rem; font-weight: bold; background: #f7f7f7; }
      /* Force everything to fit on one page when printing to PDF */
      @media print {
        html, body {
          width: 100%;
          height: auto;
          margin: 0;
          padding: 0;
          overflow: visible;
        }
        body {
          -webkit-print-color-adjust: exact !important;
          print-color-adjust: exact !important;
          background: #fff !important;
          zoom: 85%; /* Slightly scale down content to fit */
        }
        .container {
          width: 100vw !important;
          max-width: 100vw !important;
          margin: 0 !important;
          padding: 5px !important;
        }
        .card {
          page-break-inside: avoid;
          break-inside: avoid;
          box-shadow: none !important;
          border: none !important;
          margin: 0 !important;
        }
        /* Further reduce padding and margins */
        .card-body, .table, .table-sm, .table-borderless, td, th {
          padding: 0.5px !important;
          margin: 0 !important;
          font-size: 9px !important;
          line-height: 1.1 !important;
        }
        .section-heading {
          font-size: 0.85rem !important;
          padding: 2px !important;
        }
        table {
          page-break-inside: avoid;
          break-inside: avoid;
        }
        /* Prevent table rows from splitting across pages */
        tr, td, th {
          page-break-inside: avoid !important;
          break-inside: avoid !important;
        }
        /* Ensure tables use minimal space */
        .table-sm td, .table-sm th {
          padding: 0.5px !important;
        }
      }
    </style>
  </head>
  <body>
    <div class="container my-1">
      <div class="card">
        <div class="card-body">
          <table class="table table-borderless table-sm">
            <tr>
              <td style="width:48%">
                <table class="table table-sm table-borderless">
                  <tr>
                    <td class="font-weight-bold">Item Name:</td>
                    <td>{{ $efa->item_name ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">HS Code:</td>
                    <td>{{ $efa->hs_code ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">HS Code Second:</td>
                    <td>{{ $efa->hs_code_second ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Invoice No:</td>
                    <td>{{ $efa->invoice_no ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Invoice Date:</td>
                    <td>{{ $efa->invoice_date ? \Illuminate\Support\Carbon::parse($efa->invoice_date)->format('Y-m-d') : ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Contract No:</td>
                    <td>{{ $efa->contract_no ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Contract Date:</td>
                    <td>{{ $efa->contract_date ? \Illuminate\Support\Carbon::parse($efa->contract_date)->format('Y-m-d') : ' ' }}</td>
                  </tr>
                </table>
              </td>
              <td style="width:52%">
                <table class="table table-sm table-borderless">
                  <tr>
                    <td class="font-weight-bold">Consignee Name:</td>
                    <td>{{ $efa->consignee_name ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Consignee Site:</td>
                    <td>{{ $efa->consignee_site ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Consignee Address:</td>
                    <td>{{ $efa->consignee_address ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">DST Country Code:</td>
                    <td>{{ $efa->dst_country_code ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">DST Country Name:</td>
                    <td>{{ $efa->dst_country_name ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">DST Country Port:</td>
                    <td>{{ $efa->dst_country_port ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Section:</td>
                    <td>{{ $efa->section ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">TT No:</td>
                    <td>{{ $efa->tt_no ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">TT Date:</td>
                    <td>{{ $efa->tt_date ? \Illuminate\Support\Carbon::parse($efa->tt_date)->format('Y-m-d') : ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Invoice Site:</td>
                    <td>{{ $efa->invoice_site ?? ' ' }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class="table table-sm table-borderless">
                  <tr>
                    <th colspan="2" class="section-heading">Quantity & Value</th>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Unit:</td>
                    <td>{{ $efa->unit ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Quantity:</td>
                    <td>{{ $efa->quantity ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Currency:</td>
                    <td>{{ $efa->currency ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Amount:</td>
                    <td>{{ isset($efa->amount) ? number_format($efa->amount, 4) : ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">CM Percentage:</td>
                    <td>{{ isset($efa->cm_percentage) ? number_format($efa->cm_percentage, 4) : ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Incoterm:</td>
                    <td>{{ $efa->incoterm ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">CM Amount:</td>
                    <td>{{ isset($efa->cm_amount) ? number_format($efa->cm_amount, 4) : ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Freight Value:</td>
                    <td>{{ isset($efa->freight_value) ? number_format($efa->freight_value, 4) : ' ' }}</td>
                  </tr>
                </table>
              </td>
              <td>
                <table class="table table-sm table-borderless">
                  <tr>
                    <th colspan="2" class="section-heading">Ex-Factory Information</th>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Exp No:</td>
                    <td>{{ $efa->exp_no ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Exp Date:</td>
                    <td>{{ $efa->exp_date ? \Illuminate\Support\Carbon::parse($efa->exp_date)->format('Y-m-d') : ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Exp Permit No:</td>
                    <td>{{ $efa->exp_permit_no ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">BL No:</td>
                    <td>{{ $efa->bl_no ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">BL Date:</td>
                    <td>{{ $efa->bl_date ? \Illuminate\Support\Carbon::parse($efa->bl_date)->format('Y-m-d') : ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Ex Factory Date:</td>
                    <td>{{ $efa->ex_factory_date ? \Illuminate\Support\Carbon::parse($efa->ex_factory_date)->format('Y-m-d') : ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Net Wet:</td>
                    <td>{{ $efa->net_wet ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Gross Wet:</td>
                    <td>{{ $efa->gross_wet ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <th colspan="2" class="section-heading">Track Record</th>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Created By:</td>
                    <td>{{ $efa->create_by ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Created At:</td>
                    <td>{{ $efa->created_at ? \Illuminate\Support\Carbon::parse($efa->created_at)->format('Y-m-d H:i:s') : ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Updated By:</td>
                    <td>{{ $efa->update_by ?? ' ' }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Updated At:</td>
                    <td>{{ $efa->updated_at ? \Illuminate\Support\Carbon::parse($efa->updated_at)->format('Y-m-d H:i:s') : ' ' }}</td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>
