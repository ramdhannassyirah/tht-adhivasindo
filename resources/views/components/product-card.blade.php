<div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">

    <div class="overflow-hidden">
        <img :src="product.image_url ?? 'https://via.placeholder.com/300'"
            class="w-full h-48 object-cover hover:scale-105 transition duration-300">
    </div>

    <div class="p-4 flex flex-col flex-1">

        <h3 class="font-semibold text-lg text-gray-800 mb-1 line-clamp-1"
            x-text="product.name"></h3>

        <p class="text-gray-500 text-sm mb-3 line-clamp-2"
            x-text="product.description ?? 'Tidak ada deskripsi'"></p>

        <div class="mt-auto">
            <p class="text-blue-600 font-bold text-lg mb-3"
                x-text="'Rp ' + formatRupiah(product.price)"></p>

            <button @click="buy(product)"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Beli Sekarang
            </button>
        </div>
    </div>
</div>