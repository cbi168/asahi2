@extends('layouts.app')

@section('title', '商品管理')

@section('page-title', '商品管理')
@section('breadcrumb', '商品管理')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">商品列表</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> 新增商品
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 80px;">圖片</th>
                            <th>商品名稱</th>
                            <th>價格</th>
                            <th>排序</th>
                            <th>狀態</th>
                            <th>建立日期</th>
                            <th style="width: 150px;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('uploads/products/thumbnail/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="img-thumbnail"
                                             style="max-width: 60px; max-height: 60px;">
                                    @else
                                        <span class="text-muted">無圖片</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td class="text-success font-weight-bold">{{ $product->formatted_price }}</td>
                                <td>{{ $product->sort_order }}</td>
                                <td>
                                    @if($product->is_active)
                                        <span class="badge badge-success">啟用</span>
                                    @else
                                        <span class="badge badge-secondary">停用</span>
                                    @endif
                                </td>
                                <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="btn btn-info btn-action"
                                           title="編輯">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.toggle', $product) }}"
                                              method="POST"
                                              class="btn-form">
                                            @csrf
                                            <button type="submit"
                                                    class="btn {{ $product->is_active ? 'btn-warning' : 'btn-success' }} btn-action"
                                                    title="{{ $product->is_active ? '停用' : '啟用' }}">
                                                <i class="fas {{ $product->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.products.destroy', $product) }}"
                                              method="POST"
                                              class="btn-form"
                                              onsubmit="return confirm('確定要刪除此商品嗎？');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-action" title="刪除">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted mb-0">尚無商品資料</p>
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm mt-2">
                                        新增第一個商品
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $products->links('pagination.simple') }}
            </div>
        </div>
    </div>
</section>
@endsection
