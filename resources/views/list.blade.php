@extends('layout.layout')

@section('title', 'List')
    
@section('contents')
    @include('layout.errors')
        <button onclick="location.href='{{route('board.write')}}'">작성하기</button>
        <table>
            <tr>
                <th>제목</th>
                <th>작성자</th>
                <th>내용</th>
            </tr>
            @forelse ( $list as $item )
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->write_user_id}}</td>
                    <td>{{$item->content}}</td>
                </tr>
            @empty
                <tr>
                    <td>자료 없음</td>
                </tr>
            @endforelse
        </table>
@endsection