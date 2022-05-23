<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\FormPostRequests;
use App\Http\Services\Course\CourseAdminServices;
use App\Http\Services\Customer\CustomerAdminServices;
use App\Models\Course;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerAdminController extends Controller
{
    protected $courseAdminServices;
    protected $customerAdminServices;

    public function __construct(CustomerAdminServices $customerAdminServices, CourseAdminServices $courseAdminServices) {
        $this->courseAdminServices = $courseAdminServices;
        $this->customerAdminServices = $customerAdminServices;
    }

    public function create() {
        return view('admin/customer/add', [
            'title' => 'Add customer',
            'courses' => $this->courseAdminServices->getCourse(),
        ]);
    }

    public function store(FormPostRequests $request, Customer $customer) {
        $url = $this->customerAdminServices->saveImg($request);
        if ($url !== false) {
            $this->customerAdminServices->store($request, $customer, $url);
        }
        return redirect()->back();
    }

    public function index() {
        return view('admin/customer/list', [
            'title' => 'List customer',
            'customers' => $this->customerAdminServices->getCustomer(),
        ]);
    }

    public function show(Customer $customer) {
        return view('admin/customer/add', [
            'title' => 'Edit customer',
            'customer' => $customer,
            'courses' => $this->courseAdminServices->getCourse(),
        ]);
    }

    public function delete(Request $request) {
        $this->customerAdminServices->delete($request);
        return response()->json([
            'ok' => 'ok',
        ]);
    }
}
