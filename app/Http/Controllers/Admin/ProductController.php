<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Lang;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'page' => 'products',
            'products' => Product::all(),
        ];
        return view('admin.contents.product.index', $data);
    }

    /**
     * Upload file.
     */
    private function upload(FormRequest $request)
    {
        $success = false;
        $waterMark = public_path('assets/public/img/logo.png');
        $targetDirThumbnail = 'storage/uploads/thumbnails';
        $targetDirOriginal = 'uploads/originals';
        if ($request->file('image')) :
            $image = $request->file('image');
            $fileExtension = $image->extension();
            $newFileName = time() . '_' . Str::random(30);

            if (Storage::disk('uploads')->putFileAs($targetDirOriginal, $image, $newFileName . '.' . $fileExtension)) :
                $img = Image::make($image->getRealPath())->encode('webp', 75);
                ($request->get('compress')) ? $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                }) : false;
                ($request->get('watermark')) ? $img->insert($waterMark, 'bottom-left', 10, 10) : false;
                $img->save(public_path('/storage/uploads/thumbnails/' . $newFileName . '.webp'), 90);
                $success = true;
            endif;
        endif;

        return [
            'isSuccess'   => $success,
            'thumbnail' => $targetDirThumbnail . '/' . $newFileName . '.webp',
            'original'  => 'storage/' .  $targetDirOriginal . '/' .  $newFileName . $fileExtension
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page' => 'products',
            'categories' => Category::all(),
        ];
        return view('admin.contents.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $uploadresult = $this->upload($request);
        if ($uploadresult['isSuccess']) {
            Product::create([
                'name' => $request->get('name'),
                'slug' => $request->get('slug'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'image' => $uploadresult['thumbnail'],
                'original' => $uploadresult['original'],
                'category_id' => $request->get('category'),
                'user_id' => '1',
            ]);
        }
        return redirect('product')
            ->withSuccess(Lang::get('product.alert.success.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data = [
            'page' => 'products',
            'product' => $product,
            'categories' => Category::all(),
        ];
        return view('admin.contents.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $uploadresult = $this->upload($request);
        if ($uploadresult['isSuccess']) {
            $product->update([
                'name' => $request->get('name'),
                'slug' => $request->get('slug'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'image' => $uploadresult['thumbnail'],
                'original' => $uploadresult['original'],
                'category_id' => $request->get('category'),
                'user_id' => '1',
            ]);
        }
        return redirect('product')
            ->withSuccess(Lang::get('product.alert.success.edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $storage = Storage::disk('uploads');
        $thumbnail = str_replace('storage/', '', $product->image);
        $original = str_replace('storage/', '', $product->original);
        if ($storage->exists($thumbnail) && $storage->exists($original)) :
            $storage->delete($thumbnail);
            $storage->delete($original);
        endif;
        $product->delete();
        return redirect('product')
            ->withSuccess(Lang::get('product.alert.success.delete'));
    }
}
