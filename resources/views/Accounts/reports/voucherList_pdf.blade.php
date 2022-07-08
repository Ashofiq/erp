<html>
<head>
    <title>Voucher Report</title>
    <style>
    body { margin: 0; font-size: 14px; font-family: "Arrial Narrow";}

        @media print {
            *{
                font-family: "Times New Roman" !important;
            }
            .header, .header-space,
            .footer, .footer-space {
            }
            .wrapper{
                margin-top: 50px;
            }
            .header {
                position: fixed;
                top: 14px;
            }
            .footer {
                position: fixed;

                bottom: 7px;
            }
            .footer p{
                margin: 0px 0px !important;
            }
            p{
                margin: 1px 0px;
                font-size: 15px;
                font-weight: 700;
                font-family: Khaled;
            }
            .wrapper p{

                font-size: 18px;
                font-weight: 700;
                font-family: Khaled;
            }
            .single p{
                font-size: 15px !important;
                margin: 0px 0px !important;
            }
            .single {
                min-height:20px;
                overflow: hidden;
            }
            .row{
                overflow: hidden;
            }
            .margin-t{
                height: 273px;
                width: 100%;
            }
        }

    table {

    }

    td {
      border-top: none;
      border: 1px solid black;
    }
    .table th {
        border: 1px solid black;
    }

    table {
      width: 98%;
      border-collapse: collapse;
    }
    </style>
</head>
<body>
<section class="content">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <table align="center">
        <thead>
            <tr><th class="text-center" colspan="5"><font size="6"><b>{{$company->name}}</b><font></th></tr>
            <tr><th class="text-center" colspan="5"><font size="3"><b>Voucher Report</b><font></th></tr>
            <tr><th align="right"  colspan="5"><b>Date Range:&nbsp;{{ Helper::dateEnToBn($fromDate) }} to {{ Helper::dateEnToBn($toDate) }}</b></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
    <table class="table card-table table-vcenter table-bordered">
            <thead>
                <tr>
                    <th scope="col">Voucher No</th>
                    <th scope="col">Date</th>
                    <th scope="col">Account Name	</th>
                    <th scope="col">Narration</th>
                    <th scope="col">Debit</th>
                    <th scope="col">Credit</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $totalDebit = 0; 
                    $totalCredit = 0; 
                ?>
                @foreach($vouchers as $voucher)

                    @foreach($voucher->details as $key => $row)
                        <tr>
                            <td width="10%">
                            <b>{{ $voucher->vourcher_no  }}</b>
                            </td>
                            <td width="10%">
                                {{ Helper::dateEnToBn($voucher->date) }}
                            </td>
                            <td width="20%">{{ $row->accHead }}</td>
                            <td width="30%">{{ $voucher->narration }}</td>
                            <td width="10%" align="right"> {{ $row->dAmount }}</td>
                            <td width="10%" align="right"> {{ $row->cAmount  }}</td>
                        </tr>

                        <?php 
                            $totalDebit += $row->dAmount; 
                            $totalCredit += $row->cAmount; 
                        ?>
                    @endforeach
                @endforeach

                        <tr>
                            <td colspan="4" align="right">
                                <b>Total: </b>
                            </td>
                            
                            <td width="10%" align="right"> <b>{{ $totalDebit }}</b></td>
                            <td width="10%" align="right"> <b>{{ $totalCredit  }}</b></td>
                        </tr>
            </tbody>
        </table>
    </div>
   </div>

</div>
</section>
</body>
</html>
