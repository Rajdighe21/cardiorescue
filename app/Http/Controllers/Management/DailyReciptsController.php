<?php

namespace App\Http\Controllers\Management;

use App\Models\daily_recipt;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\patient_registration;
use Illuminate\Support\Facades\Validator;

class DailyReciptsController extends Controller
{

    public function index(Request $request, $id)
    {
        $patients = patient_registration::findOrFail($id);
        $patient_details = DB::table('daily_recipts')->where('patient_id', $id)->get();
        return view('Management.DailyRecipts', compact('patients', 'patient_details'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required',
            'contact' => 'required',
            'payment_amt' => 'required',
            'due_payment' => 'required',
            'regi_date' => 'required',
            'describe_problem' => 'required',
            'payment_mode' => 'required'
        ]);

        //dd($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {

            $dailyRecipt = new daily_recipt();
            $dailyRecipt->name = $request->name;
            $dailyRecipt->patient_id = $request->patient_id;
            $dailyRecipt->age = $request->age;
            $dailyRecipt->contact = $request->contact;
            $dailyRecipt->getpayment = $request->payment_amt;
            $dailyRecipt->duepayment = $request->due_payment;
            $dailyRecipt->registration_date = $request->regi_date;
            $dailyRecipt->description = $request->describe_problem;
            $dailyRecipt->payment_mode = implode(',', $request->payment_mode);
            $dailyRecipt->save();

            return redirect()->back()->with('success', "Recipt Added Successfully !");
        }
    }

    public function dailyReciptsPdf($id)
    {
        $data = DB::table('daily_recipts')->find($id);
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');

        $amount = $data->getpayment;
        $amountInWords = $numberTransformer->toWords($amount);

        $amountInWordsWithCurrency = $amountInWords . ' Rupees';

        $pdf = PDF::loadView('pdf.dailyReciptsPdf', [
            'data' => $data,
            'amountInWords' => $amountInWordsWithCurrency
        ]);

        return $pdf->stream('MyReceipts.pdf');
    }
}
