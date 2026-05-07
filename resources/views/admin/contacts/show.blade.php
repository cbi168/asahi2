@extends('layouts.app')

@section('title', '聯絡訊息詳情')
@section('page-title', '聯絡訊息詳情')
@section('breadcrumb', '聯絡訊息管理')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">訊息詳情 #{{ $contact->id }}</h3>
        <div class="card-tools">
          <a href="{{ route('admin.contacts.index') }}" class="btn btn-default btn-sm">
            <i class="fas fa-arrow-left"></i> 返回列表
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <th style="width: 150px;">姓名</th>
                  <td>{{ $contact->name }}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>
                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                  </td>
                </tr>
                <tr>
                  <th>電話</th>
                  <td>{{ $contact->phone ?? '未提供' }}</td>
                </tr>
                <tr>
                  <th>主旨</th>
                  <td>{{ $contact->subject ?? '無主旨' }}</td>
                </tr>
                <tr>
                  <th>訊息內容</th>
                  <td>
                    <div style="white-space: pre-wrap; word-wrap: break-word;">
                      {{ $contact->message }}
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>IP 位址</th>
                  <td>{{ $contact->ip_address ?? '未記錄' }}</td>
                </tr>
                <tr>
                  <th>狀態</th>
                  <td>
                    @if($contact->is_read)
                      <span class="badge badge-success">已讀</span>
                    @else
                      <span class="badge badge-warning">未讀</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>建立時間</th>
                  <td>{{ $contact->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12">
            <div class="btn-group">
              <a href="{{ route('admin.contacts.index') }}" class="btn btn-default">
                <i class="fas fa-arrow-left"></i> 返回列表
              </a>
              <form method="POST"
                    action="{{ route('admin.contacts.toggle-read', $contact) }}"
                    style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-warning">
                  <i class="fas fa-{{ $contact->is_read ? 'envelope' : 'envelope-open' }}"></i>
                  {{ $contact->is_read ? '標記為未讀' : '標記為已讀' }}
                </button>
              </form>
              <form method="POST"
                    action="{{ route('admin.contacts.destroy', $contact) }}"
                    style="display: inline;"
                    onsubmit="return confirm('確定要刪除這則訊息嗎？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                  <i class="fas fa-trash"></i> 刪除訊息
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
