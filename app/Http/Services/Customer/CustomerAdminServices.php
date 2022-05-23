<?php

namespace App\Http\Services\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CustomerAdminServices {
    public function saveImg($request) {
        if ($request->hasFile('avatar')) {
            try {
                $name = $request->file('avatar')->getClientOriginalName();
                $pathFull = 'avatars/';

                $request->file('avatar')->storeAs(
                    'public/' . $pathFull, $name
                );

                return 'public/storage/' . $pathFull . $name;
            } catch (\Exception $error) {
                return false;
            }
        }
        else {
            return "";
        }
    }

    public function store($request, $customer, $url) {
        $data = $request->input();
        $course_ids = $request->input('courses');

        try {
            if($customer->getAttribute('id') !== null) {
                if($url !== "") {
                    File::delete($customer->avatar);
                    $data = array_merge($data, ['avatar' => $url]);
                }
                $customer->courses()->detach();
                $customer->courses()->attach($course_ids);

                $customer->fill($data);
                $customer->save();
                Session::flash('success', 'You edited Customer');

            } else {
                $data = array_merge($data, ['avatar' => $url]);
                Customer::create($data);
                Session::flash('success', 'You created Customer');

                $new_customer = Customer::orderbyDesc('id')->paginate(1)[0];
                $new_customer->courses()->attach($course_ids);
            }

        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function getCustomer() {
        return Customer::orderbyDesc('id')->paginate(20);
    }

    public function delete($request) {
        try {
            $id = $request->get('id');
            $customer = Customer::where('id', $id)->first();
            if($customer) {
                File::delete($customer->avatar);
                $customer->delete();
                Session::flash('success', 'You deleted');
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }


}
