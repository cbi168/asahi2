<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * 顯示幻燈片列表（倒序排列）
     */
    public function index()
    {
        $sliders = Slider::orderBySort()->paginate(20);

        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * 顯示新增表單
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * 處理新增邏輯（含圖片上傳）
     */
    public function store(Request $request)
    {
        // 驗證表單資料
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|file|max:5120', // 改用 file 驗證，避免 MIME type 檢查
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // 手動驗證圖片格式
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $extension = strtolower($file->getClientOriginalExtension());

            if (! in_array($extension, $allowedExtensions)) {
                return back()->withErrors(['image' => '圖片格式必須是 JPG、JPEG、PNG 或 WEBP'])->withInput();
            }

            $imagePath = $this->uploadImage($file);
            $validated['image'] = $imagePath;
        }

        // 設定預設值
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->has('is_active');

        // 建立幻燈片
        Slider::create($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', '幻燈片新增成功！');
    }

    /**
     * 顯示編輯表單
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * 處理更新邏輯（含圖片更換）
     */
    public function update(Request $request, Slider $slider)
    {
        // 驗證表單資料
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|file|max:5120', // 改用 file 驗證
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // 處理圖片更換
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $extension = strtolower($file->getClientOriginalExtension());

            if (! in_array($extension, $allowedExtensions)) {
                return back()->withErrors(['image' => '圖片格式必須是 JPG、JPEG、PNG 或 WEBP'])->withInput();
            }

            // 刪除舊圖片
            $this->deleteImage($slider->image);

            // 上傳新圖片
            $imagePath = $this->uploadImage($file);
            $validated['image'] = $imagePath;
        }

        // 設定預設值
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->has('is_active');

        // 更新幻燈片
        $slider->update($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', '幻燈片更新成功！');
    }

    /**
     * 處理刪除邏輯（含圖片刪除）
     */
    public function destroy(Slider $slider)
    {
        // 刪除圖片檔案
        $this->deleteImage($slider->image);

        // 刪除資料庫記錄
        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', '幻燈片刪除成功！');
    }

    /**
     * 切換啟用/停用狀態
     */
    public function toggleStatus(Slider $slider)
    {
        $slider->is_active = ! $slider->is_active;
        $slider->save();

        $status = $slider->is_active ? '啟用' : '停用';

        return redirect()->route('admin.sliders.index')
            ->with('success', "幻燈片已{$status}！");
    }

    /**
     * 上傳圖片並生成縮圖
     */
    private function uploadImage($file)
    {
        // 產生唯一檔名
        $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

        // 確保目錄存在
        $originalPath = public_path('uploads/sliders/original');
        $thumbnailPath = public_path('uploads/sliders/thumbnail');

        if (! file_exists($originalPath)) {
            mkdir($originalPath, 0755, true);
        }
        if (! file_exists($thumbnailPath)) {
            mkdir($thumbnailPath, 0755, true);
        }

        // 使用 Laravel 的檔案儲存方法
        $file->move($originalPath, $filename);

        // 使用 Intervention Image 處理縮圖
        try {
            // 讀取原圖
            $image = imagecreatefromstring(file_get_contents($originalPath.'/'.$filename));

            if (! $image) {
                throw new \Exception('無法讀取圖片');
            }

            // 取得原圖尺寸
            $width = imagesx($image);
            $height = imagesy($image);

            // 計算縮圖尺寸（保持 16:9 比例）
            $targetWidth = 800;
            $targetHeight = 450;

            // 建立新圖片
            $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);

            // 計算裁切區域（保持比例，居中裁切）
            $ratio = $targetWidth / $targetHeight;
            $originalRatio = $width / $height;

            if ($originalRatio > $ratio) {
                // 原圖較寬，裁切兩側
                $newHeight = $height;
                $newWidth = $height * $ratio;
                $x = ($width - $newWidth) / 2;
                $y = 0;
            } else {
                // 原圖較高，裁切上下
                $newWidth = $width;
                $newHeight = $width / $ratio;
                $x = 0;
                $y = ($height - $newHeight) / 2;
            }

            // 調整大小並裁切
            imagecopyresampled($thumbnail, $image, 0, 0, $x, $y, $targetWidth, $targetHeight, $newWidth, $newHeight);

            // 儲存縮圖（根據副檔名選擇格式）
            $extension = strtolower($file->getClientOriginalExtension());
            $thumbnailPath = $thumbnailPath.'/'.$filename;

            if ($extension == 'png') {
                imagepng($thumbnail, $thumbnailPath, 9);
            } elseif ($extension == 'webp') {
                imagewebp($thumbnail, $thumbnailPath, 80);
            } else {
                imagejpeg($thumbnail, $thumbnailPath, 90);
            }

            // 釋放記憶體
            imagedestroy($image);
            imagedestroy($thumbnail);

        } catch (\Exception $e) {
            // 如果圖片處理失敗，只儲存原圖
            \Log::error('圖片處理失敗：'.$e->getMessage());
        }

        return $filename;
    }

    /**
     * 刪除圖片（原圖和縮圖）
     */
    private function deleteImage($filename)
    {
        if (! $filename) {
            return;
        }

        $originalPath = public_path('uploads/sliders/original/'.$filename);
        $thumbnailPath = public_path('uploads/sliders/thumbnail/'.$filename);

        if (file_exists($originalPath)) {
            unlink($originalPath);
        }

        if (file_exists($thumbnailPath)) {
            unlink($thumbnailPath);
        }
    }
}
