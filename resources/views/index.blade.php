<x-layouts.app>

    <section class="bg-gray-100 py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                Selamat Datang di Toko Kami
            </h1>
            <p class="text-gray-600 ">
                Temukan produk terbaik dengan harga terjangkau
            </p>
        </div>
    </section>

    <section id="products" class="py-16">
        <div x-data="productList()" x-init="fetchProducts()" class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">
                Produk Terbaru
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <template x-if="loading">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 col-span-3">

                        <template x-for="i in 6">
                            <div class="bg-white rounded-lg shadow p-4 animate-pulse">

                                <div class="w-full h-48 bg-gray-200 rounded mb-4"></div>

                                <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>

                                <div class="h-3 bg-gray-200 rounded w-full mb-1"></div>
                                <div class="h-3 bg-gray-200 rounded w-5/6 mb-3"></div>

                                <div class="h-4 bg-gray-200 rounded w-1/3 mb-4"></div>

                                <div class="h-10 bg-gray-200 rounded w-full"></div>

                            </div>
                        </template>

                    </div>

                </template>


                <template x-for="product in products" :key="product.id">
                    <div class="bg-white rounded-lg shadow p-4">
                        <img :src="product.image_url ?? 'https://via.placeholder.com/300'"
                            class="rounded mb-4 w-full h-48 object-cover">

                        <h3 class="font-semibold text-lg" x-text="product.name"></h3>

                        <p class="text-gray-500 text-sm mb-2" x-text="product.description ?? 'Tidak ada deskripsi'"></p>

                        <p class="text-blue-600 font-bold mb-3" x-text="'Rp ' + formatRupiah(product.price)"></p>

                        <button @click="buy(product)"
                            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                            Beli
                        </button>
                    </div>
                </template>


            </div>
            <div class="flex justify-center gap-4 mt-6">
                <button @click="fetchProducts(prevPage)" :disabled="!prevPage"
                    class="px-4 py-2 bg-gray-200 cursor-pointer rounded disabled:bg-gray-400 disabled:cursor-not-allowed">
                    Prev
                </button>

                <button @click="fetchProducts(nextPage)" :disabled="!nextPage"
                    class="px-4 py-2 bg-blue-600 text-white rounded disabled:bg-gray-400 disabled:cursor-not-allowed cursor-pointer">
                    Next
                </button>
            </div>

        </div>
    </section>

    <section class="bg-blue-600 py-12 text-center text-white">
        <h2 class="text-2xl font-bold mb-4">
            Siap Belanja?
        </h2>
        <p class="mb-6">
            Dapatkan promo menarik hari ini!
        </p>
        <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold">
            Mulai Sekarang
        </a>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('productList', () => ({
                    products: [],
                    loading: false,
                    nextPage: null,
                    prevPage: null,

                    async fetchProducts(url = 'http://127.0.0.1:8000/api/products') {
                        this.loading = true;
                        try {
                            const res = await fetch(url)
                            const data = await res.json()

                            this.products = data.data.data
                            this.nextPage = data.data.next_page_url
                            this.prevPage = data.data.prev_page_url

                            console.log(data.data.next_page_url);


                        } catch (e) {
                            console.error(e)
                        } finally {
                            this.loading = false
                        }
                    },

                    formatRupiah(value) {
                        return new Intl.NumberFormat('id-ID').format(value);
                    },

                    buy(product) {
                        if (!localStorage.getItem('token')) {
                            alert('Silakan login dulu');
                            window.location.href = '/login';
                            return;
                        }

                        alert('Beli: ' + product.name);
                    }
                }));
            });
        </script>
    @endpush

</x-layouts.app>
