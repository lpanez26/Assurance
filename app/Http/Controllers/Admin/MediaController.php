<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Media;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    protected function getView()   {
        return view('admin/pages/media', ['media' => $this->getMedia()]);
    }

    protected function getMedia() {
        return Media::all()->sortByDesc('created_at');
    }

    protected function getFilteredMedia($where_arr) {
        return Media::all()->whereIn('type', $where_arr)->sortByDesc('created_at');
    }

    protected function openMedia(Request $request) {
        if(empty($request->input('type')))  {
            echo json_encode(array('success' => view('admin/partials/media-tile', ['media' => $this->getMedia(), 'popup' => true])->render()));
        }else {
            if($request->input('type') == 'file')   {
                $where_arr = ['pdf', 'doc', 'docx', 'rtf', 'zip', 'rar'];
            }else if($request->input('type') == 'image')   {
                $where_arr = ['jpeg', 'png', 'jpg', 'svg', 'gif'];
            }
            echo json_encode(array('success' => view('admin/partials/media-tile', ['media' => $this->getFilteredMedia($where_arr), 'popup' => true])->render()));
        }
        die();
    }

    protected function checkIfMediaWithSameName($name)   {
        return Media::where(array('name' => $name))->get()->first();
    }

    protected function getMediaNameWithoutExtension($name)   {
        return preg_replace('/\\.[^.\\s]{3,4}$/', '', $name);
    }

    protected function uploadMedia(Request $request)   {
        if(!empty($request->file('images')))    {
            $allowed = array('jpeg', 'png', 'jpg', 'svg', 'gif', 'pdf', 'doc', 'docx', 'rtf', 'zip', 'rar', 'JPEG', 'PNG', 'JPG', 'SVG', 'GIF', 'DOC', 'DOCX', 'RTF', 'ZIP', 'RAR');
            foreach($request->file('images') as $file)  {
                //checking for right file format
                if(!in_array(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION), $allowed)) {
                    return redirect()->route('media')->with(['error' => 'Files can be only with jpeg, png, jpg, svg, gif, pdf, doc, docx, rtf, zip or rar formats.']);
                }
                //checking if error in file
                if($file->getError()) {
                    return redirect()->route('media')->with(['error' => 'There is error with one or more of the files, please try with other.']);
                }
            }

            foreach($request->file('images') as $file)  {
                $filename = $this->transliterate($file->getClientOriginalName());
                //checking if there is filename with the same name in the DB, if there is add timestamp to the name
                if($this->checkIfMediaWithSameName($filename))  {
                    $filename = $this->getMediaNameWithoutExtension($filename).'-'.time().'.'.pathinfo($filename, PATHINFO_EXTENSION);
                }

                $media = new Media();
                $media->name = $filename;
                $media->alt = $this->getMediaNameWithoutExtension(ucfirst(str_replace('-', ' ', $filename)));
                $media->type = pathinfo($filename, PATHINFO_EXTENSION);
                //saving to DB
                $media->save();
                //moving image to UPLOADS folder
                move_uploaded_file($file->getPathName(), UPLOADS . $filename);
            }
            return redirect()->route('media')->with(['success' => 'All images have been uploaded.']);
        }
        return redirect()->route('media')->with(['error' => 'Please select one or more images to upload.']);
    }

    protected function deleteMedia($id) {
        $media = Media::where('id', $id)->first();
        if(!empty($media))  {
            //deleting image from uploads folder
            unlink(UPLOADS . $media->name);
            //deleting media from DB
            $media->delete();
            return redirect()->route('media')->with(['success' => 'Image have been deleted successfully.']);
        }else {
            return redirect()->route('media')->with(['error' => 'Wrong parameters passed.']);
        }
    }

    protected function updateAlts(Request $request) {
        $looping_query = "";
        foreach ($request->input('alts_object') as $key => $value) {
            $looping_query.=" WHEN '".$key."' THEN '".$value."'";
        }
        DB::statement("UPDATE `media` SET `alt` = CASE `id` " . $looping_query . " ELSE `alt` END");
        echo json_encode(array('success' => 'Image alts have been updated successfully.'));
        die();
    }
}
