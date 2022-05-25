<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\FormPostRequests;
use App\Http\Services\Menu\MenuAdminServices;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuAdminController extends Controller
{
    protected $menuAdminServices;

    public function __construct(MenuAdminServices $menuAdminServices)
    {
        $this->menuAdminServices = $menuAdminServices;
    }

    public function create()
    {
        return view('admin.menu.add', [
            'title' => 'add menu',
            'menus' => $this->menuAdminServices->getParent()
        ]);
    }

    public function store(FormPostRequests $request, Menu $menu)
    {
        $this->menuAdminServices->store($request, $menu);
        return redirect()->back();
    }

    public function index()
    {
        return view('admin.menu.list', [
            'title' => 'list menu',
            'menus' => $this->menuAdminServices->getAll(),
        ]);
    }

    public function show(Menu $menu)
    {
        return view('admin/menu/add', [
            'title' => 'edit menu',
            'menu' => $menu,
            'menus' => $this->menuAdminServices->getParent()
        ]);
    }

    public function delete(Request $request)
    {
        $this->menuAdminServices->delete($request);
        return response()->json([
            'ok' => 'ok',
        ]);
    }
}
