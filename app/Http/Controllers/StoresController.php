<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class StoresController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$stores = \App\Models\Store::all();

		return view('model-views.index')->with(array('modelName' => 'stores', 'models' => $stores, 'modelDetails' => 'stores.details'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('model-views.create')->with(array('modelName' => 'stores'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$store = new \App\Models\store(\Input::all());
		$this->validateAndSave($store);

		\Session::flash('success', 'Uploaded successfully');
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
		$store = \App\Models\Store::findOrFail($id);

		return view('model-views.edit')->with(array('modelName' => 'stores', 'model' => $store));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$store = \App\Models\Store::find($id);
		$store->fill(\Input::all());

		$this->validateAndSave($store, $id);

		\Session::flash('success', 'Edited successfully');
		return \Redirect::back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$store = \App\Models\Store::findOrFail($id);
		$store->delete();

		\Session::flash('success', 'Store successfully deleted!');
		return \Redirect::back();
	}

	/**
	 * @param $store
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function validateAndSave($store, $idToIgnore = null)
	{
//validate
		$file = array('address' => $store->address, 'phone' => $store->phone);
		$rules = array('address' => 'required|unique:stores,address,'.$idToIgnore, 'phone' => 'min:9'); //mimes:jpeg,bmp,png and for max size max:10000
		$validator = \Validator::make($file, $rules);

		if ($validator->fails()) {
			return \Redirect::back()->withInput()->withErrors($validator);
		} elseif ((empty($store->name)) and is_null($store->brand)) {
			return \Redirect::back()->withInput()->withErrors(new MessageBag(['store must have a name or associated brand']));
		}

		//try save
		try {
			$store->save();
		} catch (\Exception $e) {
			return \Redirect::back()->withInput()->withErrors(new MessageBag(array($e->getMessage())));
		}
	}

}
