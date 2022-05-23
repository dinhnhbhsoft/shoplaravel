<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class MenuAdminServices {
    public function store($request, $menu) {
        $data = [
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'description' => $request->input('description') ? $request->input('description') : "",
            'content' => $request->input('content') ? substr($request->input('content'), 3,-4) : "",
            'active' => $request->input('active'),
        ];

        try {
            if($menu->getAttribute('id') !== null) {
                $menu->fill($data);
                $menu->save();
                Session::flash('success', 'You updated Menu');
            } else {
                Menu::create($data);
                Session::flash('success', 'You created Menu');
            }

        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function getAll() {
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function getParent() {
        return Menu::where('parent_id', 0)->get();
    }

    public function delete($request) {
        try {
            $id = $request->get('id');
            $menu = Menu::where('id', $id)->first();
            if($menu) {
                Menu::where('id', $id)->orwhere('parent_id', $id)->delete();
                Session::flash('success', 'You deleted Menu');
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

}
