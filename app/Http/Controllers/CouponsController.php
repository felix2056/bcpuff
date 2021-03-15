<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Coupon;

class CouponsController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons', compact('coupons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'discount' => 'required|numeric',
            'limit' => 'required|numeric'
        ]);

        if ($request->discount < 1) {
            return redirect()->back()->with(['error' => 'Discount must be greater than 0 percent!'])->withInput();
        }

        if ($request->limit < 1) {
            return redirect()->back()->with(['error' => 'Limit must be greater than 0!'])->withInput();
        }

        $code = $this->generateRandomCode(8);

        $coupon = new Coupon();

        $coupon->code = $code;
        $coupon->discount = $request->discount;
        $coupon->uses = 0;
        $coupon->status = 1;
        $coupon->limit = $request->limit;

        $coupon->save();

        return redirect()->back()->with(['success' => 'New Coupon Created: ' . $code]);
    }

    public function destroy(Request $request)
    {
        $coupon = Coupon::find($request->coupon_id);

        if (!$coupon) {
            return response('Coupon Does Not Exist!', 404);
        }

        $coupon->delete();

        return response('Successfully Deleted Coupon!');
    }

    private function generateRandomCode($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
