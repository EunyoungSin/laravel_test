{{-- 부모 경로 설정 --}}
@extends('layout.layout')

@section('title', 'Login')
    
@section('contents')
    @include('layout.errors')
    <form action="{{route('user.loginpost')}}" method="post">
        @csrf
        <label for="email">이메일 : </label>
        <input type="text" id="email" name="email">
        <br>
        <label for="password">비밀번호 : </label>
        <input type="text" id="password" name="password">
        <br>
        <button type="submit">로그인</button>
    </form>
@endsection