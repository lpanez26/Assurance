<?php

namespace App\Http\Controllers\Admin;

use App\SupportGuide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportGuideController extends Controller {
    protected function getView()   {
        return view('admin/pages/all-support-guides', ['posts' => $this->getAllSupportGuides()]);
    }

    public function getAllSupportGuides() {
        return SupportGuide::all()->sortBy('order_id');
    }

    protected function getSupportGuide($id)  {
        return SupportGuide::where(array('id' => $id))->get()->first();
    }

    protected function addEditSupportGuide($id = null, Request $request) {
        if($request->isMethod('post')) {
            $this->validate($request, [
                'image' => 'required',
            ], [
                'image.required' => 'Image is required.',
            ]);

            if(!empty($id)) {
                $support_guide = $this->getSupportGuide($id);
                $params = ['success' => ['Support guide was edited successfully.']];
            }else {
                $support_guide = new SupportGuide();
                $support_guide->order_id = sizeof($this->getAllSupportGuides());
                $params = ['success' => ['New support guide was added successfully.']];
            }

            $support_guide->text = $request->input('text');
            $media = $request->input('image');
            if(!empty($media)) {
                $support_guide->media_id = $media;
            }else {
                $support_guide->media_id = null;
            }

            //saving to DB
            $support_guide->save();

            if(!empty($id)) {
                $params['post'] = $support_guide;
            }
            return view('admin/pages/add-edit-support-guide', $params);
        } else {
            if(!empty($id)) {
                return view('admin/pages/add-edit-support-guide', ['post' => $this->getSupportGuide($id)]);
            } else {
                return view('admin/pages/add-edit-support-guide');
            }
        }
    }

    protected function deleteSupportGuide($id)  {
        $support_guide = SupportGuide::where('id', $id)->first();
        if(!empty($support_guide)) {
            //deleting media from DB
            $support_guide->delete();
            return redirect()->route('all-support-guides')->with(['success' => 'Support guide is deleted successfully.']);
        }else {
            return redirect()->route('all-support-guides')->with(['error' => 'Error with deleting.']);
        }
    }
}
