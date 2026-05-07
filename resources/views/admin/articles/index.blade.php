@extends('layouts.app')

@section('title', '文章管理')
@section('page-title', '文章管理')
@section('breadcrumb', '文章管理')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">文章列表</h3>
        <div class="card-tools">
          <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> 新增文章
          </a>
        </div>
      </div>
      <div class="card-body">
        <!-- 篩選表單 -->
        <form method="GET" action="{{ route('admin.articles.index') }}" class="mb-3">
          <div class="row">
            <div class="col-md-4">
              <select name="category_id" class="form-select">
                <option value="">全部分類</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <input type="text" name="search" class="form-control" placeholder="搜尋標題或內容..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-secondary btn-block">
                <i class="fas fa-search"></i> 搜尋
              </button>
            </div>
          </div>
        </form>

        <!-- 文章表格 -->
        <div class="table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 50px;">ID</th>
                <th>圖片</th>
                <th>標題</th>
                <th>分類</th>
                <th>發布日期</th>
                <th>瀏覽次數</th>
                <th>狀態</th>
                <th style="width: 150px;">操作</th>
              </tr>
            </thead>
            <tbody>
              @if($articles->count() > 0)
                @foreach($articles as $article)
                  <tr>
                    <td>{{ $article->id }}</td>
                    <td>
                      @if($article->image)
                        <img src="{{ asset('uploads/articles/thumbnail/' . $article->image) }}"
                             alt="{{ $article->title }}"
                             class="img-thumbnail"
                             style="max-width: 80px; max-height: 60px;">
                      @else
                        <span class="text-muted">無圖片</span>
                      @endif
                    </td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name ?? '未分類' }}</td>
                    <td>{{ $article->publish_date->format('Y-m-d') }}</td>
                    <td>{{ $article->views }}</td>
                    <td>
                      @if($article->is_active)
                        <span class="badge badge-success">啟用</span>
                      @else
                        <span class="badge badge-secondary">停用</span>
                      @endif
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('admin.articles.edit', $article) }}"
                           class="btn btn-info btn-action"
                           title="編輯">
                          <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.articles.toggle', $article) }}"
                              method="POST"
                              class="btn-form">
                          @csrf
                          <button type="submit"
                                  class="btn {{ $article->is_active ? 'btn-warning' : 'btn-success' }} btn-action"
                                  title="{{ $article->is_active ? '停用' : '啟用' }}">
                            <i class="fas {{ $article->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                          </button>
                        </form>
                        <form action="{{ route('admin.articles.destroy', $article) }}"
                              method="POST"
                              class="btn-form"
                              onsubmit="return confirm('確定要刪除這篇文章嗎？');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-action" title="刪除">
                            <i class="fas fa-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="8" class="text-center py-4">
                    <p class="text-muted mb-0">尚無文章資料</p>
                    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-sm mt-2">
                      新增第一篇文章
                    </a>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        {{ $articles->links('pagination.simple') }}
      </div>
    </div>
  </div>
</section>
@endsection
