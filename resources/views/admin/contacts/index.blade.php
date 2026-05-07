@extends('layouts.app')

@section('title', '聯絡訊息管理')
@section('page-title', '聯絡訊息管理')
@section('breadcrumb', '聯絡訊息管理')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">聯絡訊息列表</h3>
        <div class="card-tools">
          <span class="badge badge-info">共 {{ $contacts->total() }} 則訊息</span>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <!-- 訊息表格 -->
        <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 50px;">ID</th>
                <th style="width: 150px;">姓名</th>
                <th>Email</th>
                <th>主旨</th>
                <th style="width: 100px;">狀態</th>
                <th style="width: 180px;">建立時間</th>
                <th style="width: 200px;">操作</th>
              </tr>
            </thead>
            <tbody>
              @forelse($contacts as $contact)
                <tr class="{{ !$contact->is_read ? 'table-warning' : '' }}">
                  <td>{{ $contact->id }}</td>
                  <td>
                    {{ $contact->name }}
                    @if(!$contact->is_read)
                      <span class="badge badge-danger ml-1">未讀</span>
                    @endif
                  </td>
                  <td>{{ $contact->email }}</td>
                  <td>{{ $contact->subject ?? '無主旨' }}</td>
                  <td>
                    @if($contact->is_read)
                      <span class="badge badge-success">已讀</span>
                    @else
                      <span class="badge badge-warning">未讀</span>
                    @endif
                  </td>
                  <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group">
                      <a href="{{ route('admin.contacts.show', $contact) }}"
                         class="btn btn-info btn-action"
                         title="查看詳情">
                        <i class="fas fa-eye"></i>
                      </a>
                      <form action="{{ route('admin.contacts.toggle-read', $contact) }}"
                            method="POST"
                            class="btn-form">
                        @csrf
                        <button type="submit"
                                class="btn {{ $contact->is_read ? 'btn-warning' : 'btn-success' }} btn-action"
                                title="{{ $contact->is_read ? '標記為未讀' : '標記為已讀' }}">
                          <i class="fas fa-{{ $contact->is_read ? 'envelope' : 'envelope-open' }}"></i>
                        </button>
                      </form>
                      <form action="{{ route('admin.contacts.destroy', $contact) }}"
                            method="POST"
                            class="btn-form"
                            onsubmit="return confirm('確定要刪除這則訊息嗎？');">
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
                    <p class="text-muted mb-0">尚無聯絡訊息</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        {{ $contacts->links('pagination.simple') }}
      </div>
    </div>
  </div>
</section>
@endsection
