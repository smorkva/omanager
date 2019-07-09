@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Мои заказы</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Покупатель</th>
                                <th>Сумма</th>
                                <th>Дата</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->Client->name }}</td>
                                <td class="text-right">{{ sprintf("%01.2f", $order->summ) }}</td>
                                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                <td><a class="btn btn-info text-white" href="{{ route('order.show', $order->id) }}">Смотреть</a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">Пока закаов нет</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('order.create') }}" class="btn btn-primary">Новый</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
