<?php namespace App\Http\Controllers;

use App\Exceptions\SaleSiteException;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use League\Flysystem\Exception;
use League\Flysystem\FileExistsException;

class BrandsController extends Controller {

	public static $brandImagePath, $brandImagePublicPath;

	/**
	 * BrandsController constructor.
	 */
	public function __construct()
	{
        self::$brandImagePublicPath = '/images/brands/';
        self::$brandImagePath = base_path() . '/public' . self::$brandImagePublicPath;

	}

    private static function findImages($fileName)
    {
        return \glob(self::$brandImagePath . $fileName . '.*');
    }

    private static function checkUniqeName($brandName)
    {
        $file = array('name' => $brandName);
        $rules = array('name' => 'unique:brands'); //mimes:jpeg,bmp,png and for max size max:10000
        $validator = \Validator::make($file, $rules);

        if ($validator->fails())
        {
            throw new Exception('brand name already exists');
        }
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$brands = \App\Models\Brand::all();

		return view('brands.index')->with(compact('brands'))
                                   ->with('brandImagePublicPath', self::$brandImagePublicPath)
                                   ->with('brandImagePath', self::$brandImagePath);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('brands.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store()
    {
        $brandName = \Input::get('name');

        try
        {
            self::checkUniqeName($brandName);
            self::storeImage();
        }
        catch(Exception $e)
        {
            return \Redirect::back()->withInput()->withErrors(new MessageBag(array($e->getMessage())));
        }

        $brand = new \App\Models\Brand(array(
            'name' => $brandName
        ));
        $brand->save();

        \Session::flash('success', 'Upload successfully');
        return \Redirect::to('/Brand/create');
    }
	public function storeImage()
	{
		$brandName = \Input::get('name');
		$fileName = $this->getFileName($brandName);
        $fileImage = \Input::file('image');

		$file = array('image' => $fileImage);
		$rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
		$validator = \Validator::make($file, $rules);


		if ($validator->fails())
		{
            //Image not set
			throw new Exception('Image has not been set');
		}
		else
		{
			if ($fileImage->isValid())
			{
                //avoiding dup images on brand
				if (count(self::findImages($fileName)) > 0)
				{
                    foreach(self::findImages($fileName) as $existingImage)
                    {
                        \File::delete($existingImage);
                    }
				}

                $ext = \Input::file('image')->getClientOriginalExtension();
                $fileImage->move(
                    self::$brandImagePath, $fileName . '.' . $ext
				);
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $brand = \App\Models\Brand::findOrFail($id);

        return view('brands.edit')->with(compact('brand'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $brand = \App\Models\Brand::findOrFail($id);


        $brandNewName = \Input::get('name');
        try{
            self::checkUniqeName($brandNewName);
        }
        //brand already exists, then only modify image.
        catch(SaleSiteException $e)
        {
            try{
                self::storeImage();
            }
            catch(Exception $e)
            {
                return \Redirect::back()->withInput()->withErrors(new MessageBag(['replacing Image has not been set']));
            }

            \Session::flash('success', 'Brand image successfully updated!');
            return redirect()->back();
        }

        // changing existing image name
        $existingImage = $this->findImages($this->getFileName($brand->name))[0];
        $ext = pathinfo($existingImage, PATHINFO_EXTENSION);
        rename($existingImage, self::$brandImagePath . $brandNewName . '.' . $ext);

        //saving to DB
        $brand->name = $brandNewName;
        $brand->save();
        \Session::flash('success', 'Brand successfully updated!');
        return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    /**
     * @param $brandName
     * @return mixed
     */
    public function getFileName($brandName)
    {
        return str_replace(' ', '', $brandName);
    }

}
