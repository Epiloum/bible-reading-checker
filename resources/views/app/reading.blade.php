@extends('layouts/basis')

@section('title', '성경읽기표')
@section('headline', '성경읽기표')

@section('additional_head_resource')
    <link href="/css/reading.css" rel="stylesheet" />
@endsection

@section('header')
    @include('layouts.header_superview', [
        'css' => 'reading.css'
    ])
@endsection


@section('contents')
    <section>
        <h2>구약성경</h2>
        <blockquote>모세가 그 피를 가지고 백성에게 뿌리며 이르되 이는 여호와께서 이 모든 말씀에 대하여 너희와 세우신 언약의 피니라 (출애굽기 24:8)</blockquote>
        <table>
            @foreach ($books['구약'] as $id => $title)
                <tr id="book{{ $id }}">
                    <th>{{ $title }}</th>
                    <td>
                        @foreach ($chapters[$id] as $chapter => $v)
                            <button data-chapter="{{ $v['chapter_id'] }}" @if($v['chk_read']) data-read="y" @else data-read="n" @endif >{{ $chapter }}</button>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
    <section>
        <h2>신약성경</h2>
        <blockquote>그들의 잘못을 지적하여 말씀하시되 주께서 이르시되 볼지어다 날이 이르리니 내가 이스라엘 집과 유다 집과 더불어 새 언약을 맺으리라 (히브리서 8:8)</blockquote>
        <table>
            @foreach ($books['신약'] as $id => $title)
                <tr id="book{{ $id }}">
                    <th>{{ $title }}</th>
                    <td>
                        @foreach ($chapters[$id] as $chapter => $v)
                            <button data-chapter="{{ $v['chapter_id'] }}" @if($v['chk_read']) data-read="y" @else data-read="n" @endif >{{ $chapter }}</button>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection

@section('layers')
    @include('layers/settings')
@endsection
