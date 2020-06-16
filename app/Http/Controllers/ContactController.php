<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Mostrar todos los Contactos
        if($request) {
            $search = trim($request->get('search'));
            $contacts = Contact::where('name', 'LIKE', '%'.$search.'%')
                ->orderBy('name', 'asc')
                ->paginate(6);

            return view('contacts.get', compact('contacts', 'search'));
        } else {
            $contacts = Contact::orderBy('name', 'ASC')->paginate(6);

            return view('contacts.get', compact('contacts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Ver la Vista de Crear
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Crear un Contacto nuevo
        $contact = Contact::create([
            'name' => $request['name'],
            'lastName' => $request['lastName'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'note' => $request['note']
        ]);
        return redirect('contactos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Mostrar detalles de un Contacto
        $contact = Contact::findOrFail($id);

        return view('contacts.details', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Ver la Vista de Actualizar
        $contact = Contact::findOrFail($id);

        return view('contacts.update', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Actualizar los datos de un Contacto
        $contact = Contact::findOrFail($id);
        $contact->name = $request->name;
        $contact->lastName = $request->lastName;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->address = $request->address;
        $contact->note = $request->note;
        $contact->save();

        return redirect('contactos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminar un Contacto
        $contact = Contact::find($id);
        $contact->delete();

        return redirect('contactos');
    }
}
