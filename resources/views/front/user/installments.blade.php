@extends('front.layouts.master')

@section('title')
    Installments | {{ $gs->title }}
@endsection

@section('content')
    <section class="breadcrums">

        <div class="container" style="max-width: 1223px;">

            <h2>Installments</h2>

        </div>

    </section>
    <section>
        @if (count($purchases) > 0)
            <table>
                <tr class="tr-head">
                    <th>Sr#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
                @foreach ($purchases as $key => $purchase)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $purchase->user->first_name." ".$purchase->user->last_name }}</td>
                        <td>{{ $purchase->price }}</td>
                        <td>{{ date('d M,Y', strtotime($purchase->due_date)) }}</td>
                        <td>{{ $purchase->status }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <h3>No Installmets Found</h3>
        @endif

    </section>
@endsection
