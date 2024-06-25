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
            if (!Schema::hasTable('carts')) {
                Schema::create('carts', function (Blueprint $table) {
                    $table->id();
                    $table->timestamps();
                });
            }

            if (!Schema::hasTable('cart_post')) {
                Schema::create('cart_post', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('cart_id');
                    $table->unsignedBigInteger('post_id');
                    $table->unsignedBigInteger('user_id');
                    $table->unsignedBigInteger('product_id'); 
                    $table->integer('quantity')->default(1);
                    $table->timestamps();

                    $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
                    $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
            }
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('cart_post');

        }
    };