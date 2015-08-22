<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Center;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use League\Flysystem\Exception;

class CentersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$centers = \App\Models\Center::all();

		return view('model-views.index')->with(array('modelName' => 'centers', 'models' => $centers, 'modelDetails' => 'centers.details'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function create()
    {
        return view('model-views.create')->with(array('modelName' => 'centers'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $center = new \App\Models\Center(\Input::all());

        //validate
        $file = array('name' => $center->name, 'address' => $center->address);
        $rules = array('name' => 'unique:centers|required', 'address' => 'unique:centers|required'); //mimes:jpeg,bmp,png and for max size max:10000
        $validator = \Validator::make($file, $rules);

        if ($validator->fails())
        {
            return \Redirect::back()->withInput()->withErrors($validator);
        }

        //try save
        try{
            $center->save();
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withInput()->withErrors(new MessageBag(array($e->getMessage())));
        }

        \Session::flash('success', 'Upload successfully');
        return \Redirect::back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$center = \App\Models\Center::findOrFail($id);

		return view('model-views.edit')->with(array('modelName' => 'centers', 'model' => $center));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $rules = array(
            'name'       => 'required',
            'address'      => 'required',
            'phone_number' => 'min:9'
        );
        $validator = \Validator::make(\Input::all(), $rules);

        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } else {
            // store
            $center = \App\Models\Center::find($id);
            $center->name       = \Input::get('name');
            $center->address      = \Input::get('address');
            $center->phone_number = \Input::get('phone_number');
            $center->save();

            // redirect
            \Session::flash('success', 'Successfully updated center!');
            return \Redirect::back();
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $center = \App\Models\Center::findOrFail($id);
        $center->delete();

        \Session::flash('success', 'Center successfully deleted!');
        return \Redirect::back();
	}

}
