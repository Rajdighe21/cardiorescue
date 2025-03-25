
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        .receipt-container {
            width: 80%;
            max-width: 700px;
            margin: 40px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            font-size: 16px;
        }

        /* Header Section */
        .receipt-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #6ec1e4;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .receipt-logo img {
            max-height: 80px;
            width: auto;
        }

        .company-name {
            font-size: 26px;
            font-weight: 600;
            color: #2e2e2e;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .receipt-info {
            text-align: right;
            color: #777;
        }

        .receipt-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        /* Patient and Payment Info */
        .receipt-details {
            margin-bottom: 25px;
            padding: 10px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .receipt-details table {
            width: 100%;
            font-size: 16px;
            border-collapse: collapse;
        }

        .receipt-details table td {
            padding: 10px 15px;
            vertical-align: middle;
            text-align: left;
            border-bottom: 1px solid #f1f1f1;
        }

        .receipt-details table td:first-child {
            font-weight: bold;
            color: #333;
            width: 45%;
        }

        .receipt-details table td:last-child {
            color: #666;
        }

        /* Payment Summary Section */
        .total-section {
            font-size: 18px;
            color: #272525;
            padding-top: 20px;
            border-top: 2px solid #d6d6d6;
            margin-top: 25px;
        }

        .total-section p {
            margin: 10px 0;
            font-weight: 500;
        }

        .total-section .total-amount {
            font-size: 20px;
            color: #313030;
        }

        .total-section .remaining {
            color: #f44336;
        }

        /* Signature Section */
        .signature-section {
            margin-top: 40px;
            text-align: center;
            border-top: 2px solid #f1f1f1;
            padding-top: 20px;
        }

        .signature-section p {
            margin: 0;
            font-size: 16px;
            font-style: italic;
            color: #333;
        }

        /* Footer Section */
        .receipt-footer {
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
            color: #888;
            line-height: 1.5;
        }

        .receipt-footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .receipt-container {
                padding: 25px;
            }

            .company-name {
                font-size: 22px;
            }

            .receipt-info p {
                font-size: 12px;
            }

            .total-section p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- Header with Photo, Company Name, Receipt No, and Date -->
        <div class="receipt-header">
            <div class="receipt-logo">
             <img src="{{ asset('images/logo.webp') }}" alt="Your Company Logo" width="60" style="height:60px">
            </div>
            <div class="company-name">Cardio Rescue</div>
            <div class="receipt-info">
                <p>Registration No: CR0000{{$data->patient_id}}</p>
                <p>Date: {{ \Carbon\Carbon::parse($data->registration_date)->format('d M Y') }}</p>
            </div>
        </div>

        <!-- Patient Info -->
        <div class="receipt-details">
            <table>
                <tr>
                    <td>Patient Name:</td>
                    <td>{{$data->name}}</td>
                </tr>
                <tr>
                    <td>Description :</td>
                    <td>{{$data->description}}</td>
                </tr>
            </table>
        </div>

        <!-- Payment Info -->
        <div class="receipt-details">
            <table>

                <tr>
                    <td>Amount Paid:</td>
                    <td>{{$data->getpayment}} /Rs. </td>
                </tr>
                <tr>
                    <td>Amount in Words:</td>
                    <td>{{ Str::ucfirst($amountInWords) }} Only </td>
                </tr>
                <tr>
                    <td>Amount Due:</td>
                    <td>{{$data->duepayment}} /Rs. </td>
                </tr>
                <tr>
                    <td>Payment Mode:</td>
                    <td>By {{$data->payment_mode}}</td>
                </tr>
            </table>
        </div>

        <!-- Total and Payment Status -->
        <div class="total-section">
            <p>Total Amount Paid: <span class="total-amount">{{$data->getpayment}} /Rs.</span></p>
        </div>

        <!-- Authorized Signature -->
        <div class="signature-section">
            <p>Authorized Signature: _________________________</p>
        </div>

        <!-- Footer -->
        <div class="receipt-footer">
            <p>Thank you for your payment!</p>
            <p>For More Information visit <a href="http://www.cardiorescue.in" target="_blank">www.cardiorescue.in</a></p>
        </div>
    </div>
</body>
</html>
