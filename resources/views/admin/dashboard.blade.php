@extends('layouts.app')

@section('title', '儀表板 - 朝日形象網站')

@section('page-title', '儀表板')

@section('breadcrumb', '儀表板')

@section('content')
<div class="row">

    <!-- 統計卡片 -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>新增訊息</p>
            </div>
            <div class="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <a href="#" class="small-box-footer">更多資訊 <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>跳出率</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="#" class="small-box-footer">更多資訊 <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>使用者註冊</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">更多資訊 <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>
                <p>獨特訪客</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <a href="#" class="small-box-footer">更多資訊 <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>

<div class="row">

    <!-- 左側欄位 -->
    <div class="col-md-8">

        <!-- 表格範例 -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">最新資料</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>任務</th>
                            <th>進度</th>
                            <th style="width: 150px">狀態</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>更新軟體</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-danger">55%</span></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>修復資料庫錯誤</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-warning" style="width: 70%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-warning">70%</span></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>使用者介面設計</td>
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary">80%</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>

    </div>

    <!-- 右側欄位 -->
    <div class="col-md-4">

        <!-- 資訊卡片 -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">系統資訊</h3>
            </div>

            <div class="card-body">
                <div class="callout callout-info">
                    <h5>Laravel 版本</h5>
                    <p>{{ Illuminate\Foundation\Application::VERSION }}</p>
                </div>

                <div class="callout callout-warning">
                    <h5>PHP 版本</h5>
                    <p>{{ PHP_VERSION }}</p>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection