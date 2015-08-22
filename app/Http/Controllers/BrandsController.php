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
	public function publicIndex()
	{
		$brands = \App\Models\Brand::all();
        $newBrands = new \stdClass();
        $i =0;

        foreach($brands as $brand){
            $newBrands->name[$i] = $brand->name;

            $pos = strpos($this->findImages($this->getFileName($brand->name))[0], "/images");
            $url = substr($this->findImages($this->getFileName($brand->name))[0], $pos);

            $newBrands->image[$i] = $url;
            $i++;
        }

//        var_dump($newBrands->image);
//        exit();
		return view('brands')->with(['newBrands'=> $newBrands->image, 'name'=> $newBrands->name]);
	}

    public function index()
	{
		$brands = \App\Models\Brand::all();

		return view('model-views.index')->with(array('modelName' => 'brands', 'models' => $brands))
                                   ->with('modelDetails' , 'brands.details')
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
		return view('model-views.create')->with(array('modelName' => 'brands'));
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
        return \Redirect::to('/Brands/create');
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
                $this->deleteExistingImagesByFileName($fileName);

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

        return view('model-views.edit')->with(array('modelName' => 'brands', 'model' => $brand));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $shouldStoreImage = true;
        $brand = \App\Models\Brand::findOrFail($id);

        $brandNewName = \Input::get('name');
        if($brandNewName != $brand->name)
        {
            try{
                self::checkUniqeName($brandNewName);
            }
            catch(Exception $e) {
                //brand already exists
                return \Redirect::back()->withInput()->withErrors(new MessageBag([$e->getMessage()]));
            }

            if(is_null(\Input::file('image'))){
                // changing existing image name
                $existingImage = $this->findImages($this->getFileName($brand->name))[0];
                $ext = pathinfo($existingImage, PATHINFO_EXTENSION);
                rename($existingImage, self::$brandImagePath . $brandNewName . '.' . $ext);
                $shouldStoreImage = false;
            }
            else{
                $this->deleteExistingImagesByFileName($this->getFileName($brand->name));
            }

            //saving to DB
            $brand->name = $brandNewName;
            $brand->save();
        }

        try{
            if($shouldStoreImage){
                self::storeImage();
            }
        }
        catch(Exception $e)
        {
            return \Redirect::back()->withInput()->withErrors(new MessageBag(['replacing Image has not been set']));
        }

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
        $brand = \App\Models\Brand::findOrFail($id);
        $brand->delete();

        \Session::flash('success', 'Brand successfully deleted!');
        return \Redirect::back();
	}

    /**
     * @param $brandName
     * @return mixed
     */
    public function getFileName($brandName)
    {
        return str_replace(' ', '', $brandName);
    }

    /**
     * @param $fileName
     */
    public function deleteExistingImagesByFileName($fileName)
    {
        if (count(self::findImages($fileName)) > 0) {
            foreach (self::findImages($fileName) as $existingImage) {
                \File::delete($existingImage);
            }
        }
    }

}
