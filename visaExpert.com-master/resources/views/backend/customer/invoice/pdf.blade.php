<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .my-design {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <span>{{ config('app.name') }}</span>
                            </td>

                            <td>
                                User ID #: <b>{{ $invoice->customer->unique_id }}</b><br />
                                Created: {{ $invoice->created_at->format('d M Y') }}<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                Sylhet, Bangladesh.
                            </td>
                            <td class="my-design">
                                Payment Status:<br />
                                {{ $invoice->status }}
                            </td>
                            <td class="my-design">
                                Total (BDT):<br />
                                {{ $invoice->total_amount }}
                            </td>
                            <td class="my-design">
                                {{ $invoice->customer->name }}<br />
                                {{ $invoice->customer->phone }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Item</td>
                <td>Qty</td>
                <td>Price</td>
                <td>Amount</td>
            </tr>
            @foreach ($invoice->items as $item)
                <tr class="item">
                    <td>{{ $item->item }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{  $item->qty .'X'. $item->amount / $item->qty  }} </td>
                    <td>{{ $item->amount }}</td>
                </tr>
            @endforeach

            <tr class="total">
                <td></td>
                <td></td>
                <td></td>

                <td>Total(BDT): {{ $invoice->total_amount }}</td>
            </tr>
        </table> 

        <p class="" style="font-size: 11px; line-height: 10px;">
            <Strong> Note:</Strong> Customer must check the file/task before receiving because after delivery the task
            authority will not take any responsibility and risk. The invoice will be valueless after 3 days from the
            issuing date and customer must collect the work before expiry the invoice.
        </p>
    </div>
</body>

</html>
