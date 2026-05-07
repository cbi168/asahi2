<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * 顯示商品列表
     *
     * @return View
     */
    public function index()
    {
        $products = Product::orderBy('sort_order', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * 顯示新增商品表單
     *
     * @return View
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * 儲存新商品
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'price' => 'required|numeric|between:0,99999999.99',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->has('is_active');

        // 處理圖片上傳
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // 生成檔案名稱
            $filename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            // 建立目錄（如果不存在）
            $originalPath = public_path('uploads/products/original');
            $thumbnailPath = public_path('uploads/products/thumbnail');
            if (! file_exists($originalPath)) {
                mkdir($originalPath, 0755, true);
            }
            if (! file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0755, true);
            }

            // 儲存原圖
            $image->move($originalPath, $filename);

            // 生成縮圖 (600x600)
            $this->createThumbnail($originalPath.'/'.$filename, $thumbnailPath.'/'.$filename, 600, 600);

            $validated['image'] = $filename;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', '商品新增成功');
    }

    /**
     * 顯示編輯商品表單
     *
     * @return View
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * 更新商品
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'price' => 'required|numeric|between:0,99999999.99',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? $product->sort_order;
        $validated['is_active'] = $request->has('is_active');

        // 處理圖片更換
        if ($request->hasFile('image')) {
            // 刪除舊圖片
            if ($product->image) {
                $oldImagePath = public_path('uploads/products/');
                if (file_exists($oldImagePath.'original/'.$product->image)) {
                    unlink($oldImagePath.'original/'.$product->image);
                }
                if (file_exists($oldImagePath.'thumbnail/'.$product->image)) {
                    unlink($oldImagePath.'thumbnail/'.$product->image);
                }
            }

            // 上傳新圖片
            $image = $request->file('image');

            // 生成檔案名稱
            $filename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            $originalPath = public_path('uploads/products/original');
            $thumbnailPath = public_path('uploads/products/thumbnail');
            if (! file_exists($originalPath)) {
                mkdir($originalPath, 0755, true);
            }
            if (! file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0755, true);
            }

            // 儲存原圖
            $image->move($originalPath, $filename);

            // 生成縮圖 (600x600)
            $this->createThumbnail($originalPath.'/'.$filename, $thumbnailPath.'/'.$filename, 600, 600);

            $validated['image'] = $filename;
        }

        $product->update($validated);

        return back()
            ->with('success', '商品更新成功');
    }

    /**
     * 刪除商品
     *
     * @return RedirectResponse
     */
    public function destroy(Product $product)
    {
        // 刪除圖片
        if ($product->image) {
            $imagePath = public_path('uploads/products/');
            if (file_exists($imagePath.'original/'.$product->image)) {
                unlink($imagePath.'original/'.$product->image);
            }
            if (file_exists($imagePath.'thumbnail/'.$product->image)) {
                unlink($imagePath.'thumbnail/'.$product->image);
            }
        }

        $product->delete();

        return back()
            ->with('success', '商品刪除成功');
    }

    /**
     * 切換商品狀態
     *
     * @return RedirectResponse
     */
    public function toggleStatus(Product $product)
    {
        $product->is_active = ! $product->is_active;
        $product->save();

        return back()
            ->with('success', '商品狀態更新成功');
    }

    /**
     * 建立縮圖
     *
     * @param  string  $sourcePath  來源圖片路徑
     * @param  string  $destPath  目標圖片路徑
     * @param  int  $width  縮圖寬度
     * @param  int  $height  縮圖高度
     * @return bool
     */
    private function createThumbnail($sourcePath, $destPath, $width, $height)
    {
        // 取得原始圖片資訊
        $imageInfo = getimagesize($sourcePath);
        if ($imageInfo === false) {
            return false;
        }

        [$srcWidth, $srcHeight, $imageType] = $imageInfo;

        // 計算裁切位置（居中裁切）
        $srcRatio = $srcWidth / $srcHeight;
        $destRatio = $width / $height;

        if ($srcRatio > $destRatio) {
            // 原圖較寬，裁切左右
            $cropWidth = $srcHeight * $destRatio;
            $cropHeight = $srcHeight;
            $cropX = ($srcWidth - $cropWidth) / 2;
            $cropY = 0;
        } else {
            // 原圖較高，裁切上下
            $cropWidth = $srcWidth;
            $cropHeight = $srcWidth / $destRatio;
            $cropX = 0;
            $cropY = ($srcHeight - $cropHeight) / 2;
        }

        // 建立目標圖片
        $destImage = imagecreatetruecolor($width, $height);

        // 根據圖片類型建立源圖片
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $srcImage = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $srcImage = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $srcImage = imagecreatefromgif($sourcePath);
                break;
            case IMAGETYPE_WEBP:
                $srcImage = imagecreatefromwebp($sourcePath);
                break;
            default:
                return false;
        }

        // 裁切並縮放
        imagecopyresampled(
            $destImage,
            $srcImage,
            0, 0,
            $cropX, $cropY,
            $width, $height,
            $cropWidth, $cropHeight
        );

        // 儲存縮圖
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($destImage, $destPath, 90);
                break;
            case IMAGETYPE_PNG:
                imagepng($destImage, $destPath, 9);
                break;
            case IMAGETYPE_GIF:
                imagegif($destImage, $destPath);
                break;
            case IMAGETYPE_WEBP:
                imagewebp($destImage, $destPath, 90);
                break;
        }

        // 釋放記憶體
        imagedestroy($srcImage);
        imagedestroy($destImage);

        return true;
    }
}
