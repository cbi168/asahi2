<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * 影片管理 Controller
 *
 * 處理後台影片的 CRUD 操作
 */
class VideoController extends Controller
{
    /**
     * 顯示影片列表
     *
     * @return View
     */
    public function index()
    {
        $videos = Video::orderBySortOrder()->get();

        return view('admin.videos.index', compact('videos'));
    }

    /**
     * 顯示新增影片表單
     *
     * @return View
     */
    public function create()
    {
        return view('admin.videos.form');
    }

    /**
     * 儲存新影片
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // 解析 YouTube URL
        $videoId = Video::parseYoutubeId($validated['youtube_url']);
        if (! $videoId) {
            return back()
                ->withInput()
                ->withErrors(['youtube_url' => '無效的 YouTube 網址']);
        }

        // 準備影片資料
        $videoData = [
            'title' => $validated['title'],
            'youtube_url' => $validated['youtube_url'],
            'video_id' => $videoId,
            'thumbnail' => Video::getThumbnailUrl($videoId),
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $validated['is_active'] ?? true,
        ];

        Video::create($videoData);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', '影片新增成功');
    }

    /**
     * 顯示編輯影片表單
     *
     * @return View
     */
    public function edit(Video $video)
    {
        return view('admin.videos.form', compact('video'));
    }

    /**
     * 更新影片
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // 解析 YouTube URL
        $videoId = Video::parseYoutubeId($validated['youtube_url']);
        if (! $videoId) {
            return back()
                ->withInput()
                ->withErrors(['youtube_url' => '無效的 YouTube 網址']);
        }

        // 準備影片資料
        $videoData = [
            'title' => $validated['title'],
            'youtube_url' => $validated['youtube_url'],
            'video_id' => $videoId,
            'thumbnail' => Video::getThumbnailUrl($videoId),
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $validated['is_active'] ?? true,
        ];

        $video->update($videoData);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', '影片更新成功');
    }

    /**
     * 刪除影片
     *
     * @return RedirectResponse
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()
            ->route('admin.videos.index')
            ->with('success', '影片刪除成功');
    }

    /**
     * 切換影片狀態
     *
     * @return JsonResponse
     */
    public function toggleStatus(Video $video)
    {
        $video->update([
            'is_active' => ! $video->is_active,
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $video->is_active,
            'message' => $video->is_active ? '影片已啟用' : '影片已停用',
        ]);
    }
}
