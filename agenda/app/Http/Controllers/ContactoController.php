<?php

namespace Agenda\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use Agenda\Http\Requests;
use Agenda\ContactoModel;
use Agenda\Http\Requests\ContactoFormRequest;
use DB;

class ContactoController extends Controller {
    
    public function __construct() {}
    
    public function index(Request $request) {

        $searchText = trim($request->get('searchText'));
        $contacto = DB::table('contacto')
                        ->where('cntNombre','like','%'.$searchText.'%')
                        ->join('estatus', 'contacto.stsId', '=', 'estatus.stsId')
                        ->orderBy('cntId','desc')
                        ->paginate(10);
            
        return view('contacto/index', ["contacto" => $contacto, "searchText" => $searchText]);
    }

    public function create() {
        $estatus = DB::table('estatus')->get();
        return view("contacto.create", ["estatus" => $estatus]);
    }

    public function store(ContactoFormRequest $request) {
        $contacto = new ContactoModel();
        $contacto->stsId = $request->get('stsId');
        $contacto->cntNombre = $request->get('cntNombre');
        $contacto->cntApellidoPaterno = $request->get('cntApellidoPaterno');
        $contacto->cntApellidoMaterno = $request->get('cntApellidoMaterno');

        if (Input::hasFile('cntFotografia')) {
            $file=Input::file('cntFotografia');
            $file->move(public_path()."/upload/contacto/", $file->getClientOriginalName());
            $contacto->cntFotografia = $file->getClientOriginalName();
        }

        $contacto->save();

        return Redirect::to('contacto');
    }

    public function show($cntId) {
        return view("agenda.show");
    }

    public function edit($cntId) {
        $estatus = DB::table('estatus')->get();
        return view("contacto.edit",["contacto"=>ContactoModel::findOrFail($cntId)], ["estatus" => $estatus]);
    }

    public function update(ContactoFormRequest $request, $cntId) {
        $contacto = ContactoModel::findOrFail($cntId);
        $contacto->stsId = $request->get('stsId');
        $contacto->cntNombre = $request->get('cntNombre');
        $contacto->cntApellidoPaterno = $request->get('cntApellidoPaterno');
        $contacto->cntApellidoMaterno = $request->get('cntApellidoMaterno');

        if (Input::hasFile('cntFotografia')) {
            $file = Input::file('cntFotografia');
            $file->move(public_path()."/upload/contacto/", $file->getClientOriginalName());
            $contacto->cntFotografia = $file->getClientOriginalName();
        }

        $contacto->update();

        return Redirect::to('contacto');
    }

    public function destroy($cntId) {
        $contacto = ContactoModel::findOrFail($cntId);
        $contacto->delete();

        return Redirect::to('/contacto/');
    }


}
