<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * 顯示文章列表（含分類篩選）
     */
    public function index(Request $request)
    {
        $query = Article::with('category');

        // 分類篩選
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // 搜尋功能
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        $articles = $query->orderBy('publish_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(20);

        $categories = ArticleCategory::orderBy('sort_order', 'desc')->get();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    /**
     * 顯示新增文章表單
     */
    public function create()
    {
        $categories = ArticleCategory::orderBy('sort_order', 'desc')->get();

        return view('admin.articles.create', compact('categories'));
    }

    /**
     * 儲存新文章
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:article_categories,id',
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'publish_date' => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // 處理圖片上傳
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // 生成檔名
            $filename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            // 建立目錄（如果不存在）
            $originalPath = public_path('uploads/articles/original');
            $thumbnailPath = public_path('uploads/articles/thumbnail');
            if (! file_exists($originalPath)) {
                mkdir($originalPath, 0755, true);
            }
            if (! file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0755, true);
            }

            // 儲存原圖
            $image->move($originalPath, $filename);

            // 生成縮圖
            $this->createThumbnail($originalPath.'/'.$filename, $thumbnailPath.'/'.$filename, 800, 600);

            $validated['image'] = $filename;
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', '文章新增成功');
    }

    /**
     * 顯示編輯文章表單
     */
    public function edit(Article $article)
    {
        $categories = ArticleCategory::orderBy('sort_order', 'desc')->get();

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * 更新文章
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:article_categories,id',
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'publish_date' => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // 處理圖片更換
        if ($request->hasFile('image')) {
            // 刪除舊圖片
            if ($article->image) {
                $originalPath = public_path('uploads/articles/original/'.$article->image);
                $thumbnailPath = public_path('uploads/articles/thumbnail/'.$article->image);
                if (file_exists($originalPath)) {
                    unlink($originalPath);
                }
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath);
                }
            }

            // 上傳新圖片
            $image = $request->file('image');
            $filename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            $originalPath = public_path('uploads/articles/original');
            $thumbnailPath = public_path('uploads/articles/thumbnail');
            if (! file_exists($originalPath)) {
                mkdir($originalPath, 0755, true);
            }
            if (! file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0755, true);
            }

            // 儲存原圖
            $image->move($originalPath, $filename);

            // 生成縮圖
            $this->createThumbnail($originalPath.'/'.$filename, $thumbnailPath.'/'.$filename, 800, 600);

            $validated['image'] = $filename;
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', '文章更新成功');
    }

    /**
     * 刪除文章
     */
    public function destroy(Article $article)
    {
        // 刪除圖片
        if ($article->image) {
            $originalPath = public_path('uploads/articles/original/'.$article->image);
            $thumbnailPath = public_path('uploads/articles/thumbnail/'.$article->image);
            if (file_exists($originalPath)) {
                unlink($originalPath);
            }
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', '文章刪除成功');
    }

    /**
     * 切換文章狀態
     */
    public function toggleStatus(Article $article)
    {
        $article->is_active = ! $article->is_active;
        $article->save();

        return redirect()->route('admin.articles.index')
            ->with('success', '文章狀態更新成功');
    }

    /**
     * 建立縮圖
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
