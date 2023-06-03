@extends('layout.layout')

@section('title', 'Write')
    
@section('contents')
    @include('layout.errors')
        <a href="{{route('board.index')}}">돌아가기</a>
        <form action="{{route('board.store')}}" method="post">
            @csrf
            <label for="title">제목</label>
            <input type="text" name="title" id="title">
            <br>
            <label for="content">내용</label>
            <textarea name="content" id="content"></textarea>
            <br>
            <button type="submit">작성</button>
        </form>
@endsection