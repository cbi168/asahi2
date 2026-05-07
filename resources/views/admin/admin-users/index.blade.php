@extends('layouts.app')

@section('title', '後台用戶管理')
@section('page-title', '後台用戶管理')
@section('breadcrumb', '後台用戶管理')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">管理員列表</h3>
        <div class="card-tools">
          <a href="{{ route('admin.admin-users.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> 新增管理員
          </a>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <!-- 管理員表格 -->
        <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 50px;">ID</th>
                <th>姓名</th>
                <th>Email</th>
                <th style="width: 100px;">角色</th>
                <th style="width: 100px;">狀態</th>
                <th style="width: 180px;">建立時間</th>
                <th style="width: 250px;">操作</th>
              </tr>
            </thead>
            <tbody>
              @forelse($adminUsers as $adminUser)
                <tr>
                  <td>{{ $adminUser->id }}</td>
                  <td>{{ $adminUser->name }}</td>
                  <td>{{ $adminUser->email }}</td>
                  <td>
                    <span class="badge badge-primary">
                      {{ $adminUser->role === 'admin' ? '管理員' : '用戶' }}
                    </span>
                  </td>
                  <td>
                    @if($adminUser->is_active)
                      <span class="badge badge-success">啟用</span>
                    @else
                      <span class="badge badge-danger">停用</span>
                    @endif
                  </td>
                  <td>{{ $adminUser->created_at->format('Y-m-d H:i') }}</td>
                  <td>
                    @if($adminUser->id !== auth()->id())
                      <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('admin.admin-users.edit', $adminUser) }}"
                           class="btn btn-info btn-action"
                           title="編輯">
                          <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.admin-users.toggle-status', $adminUser) }}"
                              method="POST"
                              class="btn-form"
                              onsubmit="return confirm('確定要{{ $adminUser->is_active ? '停用' : '啟用' }}這個管理員嗎？');">
                          @csrf
                          <button type="submit"
                                  class="btn {{ $adminUser->is_active ? 'btn-warning' : 'btn-success' }} btn-action"
                                  title="{{ $adminUser->is_active ? '停用' : '啟用' }}">
                            <i class="fas {{ $adminUser->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                          </button>
                        </form>
                        <form action="{{ route('admin.admin-users.destroy', $adminUser) }}"
                              method="POST"
                              class="btn-form"
                              onsubmit="return confirm('確定要刪除這個管理員嗎？此操作無法復原。');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-action" title="刪除">
                            <i class="fas fa-trash"></i>
                          </button>
                        </form>
                      </div>
                    @else
                      <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('admin.admin-users.edit', $adminUser) }}"
                           class="btn btn-info btn-action"
                           title="編輯">
                          <i class="fas fa-edit"></i>
                        </a>
                        <span class="btn btn-secondary" disabled>
                          <i class="fas fa-user-shield"></i> 當前用戶
                        </span>
                      </div>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center py-4">
                    <p class="text-muted mb-0">尚無管理員</p>
                    <a href="{{ route('admin.admin-users.create') }}" class="btn btn-primary btn-sm mt-2">
                      新增第一個管理員
                    </a>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        {{ $adminUsers->links('pagination.simple') }}
      </div>
    </div>
  </div>
</section>
@endsection
