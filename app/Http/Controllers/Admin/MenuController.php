<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\MenuElement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    protected function getView()   {
        return view('admin/pages/all-menus', ['posts' => $this->getAllMenus()]);
    }

    protected function editMenu($id)   {
        return view('admin/pages/edit-menu', ['posts' => $this->getMenuElementForMenu($id), 'menu' => $this->getMenuById($id)]);
    }

    protected function getAllMenus() {
        return Menu::all();
    }

    protected function getMenuById($id) {
        return Menu::where(array('id' => $id))->get()->first();
    }

    protected function getMenuElementForMenu($id) {
        return MenuElement::where(array('menu_id' => $id))->get()->sortBy('order_id');
    }

    protected function addEditMenuElement($id = null, Request $request) {
        if($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required',
                'type' => 'required',
                'url' => 'required'
            ], [
                'title.required' => 'Title is required.',
                'type.required' => 'Type is required.',
                'url.required' => 'URL is required.',
            ]);

            if(!empty($id)) {
                $menu_element = $this->getMenuElement($id);
                $params = ['success' => ['Menu element was edited successfully.']];
            }else {
                $menu_element = new MenuElement();
                $menu_element->order_id = sizeof($this->getMenuElementForMenu($request->input('menu_id')));
                $params = ['success' => ['New menu element was added successfully.']];
            }
            $params['posts'] = $this->getAllMenus();

            $menu_element->name = $request->input('title');
            $menu_element->type = $request->input('type');
            $menu_element->url = $request->input('url');
            $menu_element->id_attribute = $request->input('id-attribute');
            $menu_element->class_attribute = $request->input('class-attribute');
            $menu_element->menu_id = $request->input('menu_id');
            $media_id = $request->input('image');
            if(!empty($media_id))   {
                $menu_element->media_id = $request->input('image');
            }else {
                $menu_element->media_id = null;
            }
            $new_window = $request->input('new-window');
            if(isset($new_window)) {
                $menu_element->new_window = true;
            }else {
                $menu_element->new_window = false;
            }
            $mobile_visible = $request->input('mobile-visible');
            if(isset($mobile_visible)) {
                $menu_element->mobile_visible = true;
            }else {
                $menu_element->mobile_visible = false;
            }
            $desktop_visible = $request->input('desktop-visible');
            if(isset($desktop_visible)) {
                $menu_element->desktop_visible = true;
            }else {
                $menu_element->desktop_visible = false;
            }
            //saving to DB
            $menu_element->save();

            if(!empty($id)) {
                $params['post'] = $this->getMenuElement($id);
            }
            return view('admin/pages/add-edit-menu-element', $params);
        }else {
            if(!empty($id)) {
                return view('admin/pages/add-edit-menu-element', ['post' => $this->getMenuElement($id), 'posts' => $this->getAllMenus()]);
            }else {
                return view('admin/pages/add-edit-menu-element', ['posts' => $this->getAllMenus()]);
            }
        }
    }

    function getMenuElement($id)  {
        return MenuElement::where(array('id' => $id))->get()->first();
    }

    protected function deleteMenuElement($id)  {
        $menu_element = MenuElement::where('id', $id)->first();
        $menu_id = $menu_element->menu->id;
        if(!empty($menu_element))  {
            //deleting media from DB
            $menu_element->delete();
            return redirect()->route('edit-menu', ['id' => $menu_id])->with(['success' => 'Menu element is deleted successfully.']);
        }else {
            return redirect()->route('edit-menu', ['id' => $menu_id])->with(['error' => 'Error with deleting.']);
        }
    }

    protected function changeUrlOption(Request $request)    {
        echo json_encode(array('success' => view('admin/partials/menu-element-'.$request->input('type').'-option')->render()));
        die();
    }
}
