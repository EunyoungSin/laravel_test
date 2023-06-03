<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boards', function (Blueprint $table) {
            // id(pk), title, content, created_at, updated_at, deleted_at, delete_flg, write_user_id
            $table->id();
            $table->string('title', 100); // 보통은 50글자 이내로 설정함.
            $table->string('content', 1000); // 컬럼 수정하면 기존 값이 날아가는 경우가 생길 수도 있으니 넉넉하게 잡아줘야함.
            // 자원이 지원하는 한도 내에서 유저가 생각하는 적정치의 2배(2000). 1000자로 설정해두고 500자 이내로 입력해주세요.라고 띄우기도 함.
            $table->timestamps(); // created_at, updated_at 자동생성
            $table->softDeletes(); // deleted_at 자동생성. 엘로퀀트 모델 사용시 삭제일자 기록해줌.
            $table->char('delete_flg', 1)->default('0');
            $table->bigInteger('write_user_id'); // users 테이블의 id 컬럼 타입과 맞춰서.
            // $table->foreign('write_user_id')->references('id')->on('users')->onDelete('cascade'); // FK 설정방법1
            // $table->foreign('write_user_id')->references('id')->constrained('users', 'id')->onDelete('cascade'); // FK 설정방법2
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
