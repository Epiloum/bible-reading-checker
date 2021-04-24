@extends('layouts/basis')

@section('title', '추첨대상명단')
@section('headline', '추첨대상명단 (임원전용)')

@section('header')
    @include('layouts.header_subview')
@endsection

@section('additional_head_resource')
    <link href="/css/tickets.css" rel="stylesheet" />
@endsection

@section('contents')
    <section>
        <table>
            <colgroup>
                <col width="25px" />
                <col width="100px" />
                <col width="*" />
                <col width="60px" />
                <col width="40px" />
            </colgroup>
            <thead>
                <tr>
                    <th>no.</th>
                    <th>소속/전화뒷자리</th>
                    <th>읽은 말씀</th>
                    <th>완독일</th>
                    <th>추첨월</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($list as $v)
                <tr>
                    <td>{{ $v['no'] }}</td>
                    <td>{{ $v['division'] }} / {{ $v['mobile'] }}
                    <td>{{ $v['book'] }}</td>
                    <td>{{ $v['date'] }}</td>
                    <td>{{ $v['month'] }}월</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection

@section('layers')
    @include('layers/settings')
@endsection
