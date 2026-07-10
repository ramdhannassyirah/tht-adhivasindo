<x-layouts.dashboard>
    <div class="space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Master Products</h1>
                <p class="text-sm text-gray-500">Kelola produk dengan datagrid dan modal CRUD.</p>
            </div>
            <button id="openCreateModal"
                class="inline-flex cursor-pointer items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700">
                Tambah Produk
            </button>
        </div>

        <div class="rounded-2xl bg-white p-4 shadow-sm">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Produk</h2>
                    <p class="text-sm text-gray-500">Cari, edit, dan hapus produk dari satu halaman.</p>
                </div>
                <input id="searchInput" type="search" placeholder="Cari nama atau deskripsi..."
                    class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm outline-none ring-0 md:max-w-sm">
            </div>

            <div id="statusMessage" class="mt-4 hidden rounded-lg border border-gray-200 bg-gray-50 p-3 text-sm"></div>

            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-gray-600">Foto</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Nama</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Harga</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Stok</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Deskripsi</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody" class="divide-y divide-gray-100 bg-white">
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">Memuat data produk...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="productModal" class="fixed inset-0 z-50 hidden bg-black/40 p-4">
        <div class="mx-auto mt-10 max-w-2xl rounded-2xl bg-white shadow-xl">
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah Produk</h3>
                <button id="closeModal" type="button" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <form id="productForm" class="space-y-4 px-6 py-5" enctype="multipart/form-data">
                <input type="hidden" id="productId" name="id">

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input id="name" name="name" required
                            class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Harga</label>
                        <input id="price" name="price" type="number" step="0.01" min="0" required
                            class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm outline-none focus:border-blue-500">
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Stok</label>
                        <input id="stock" name="stock" type="number" min="0" required
                            class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Foto Produk</label>
                        <input id="image" name="image" type="file" accept="image/*"
                            class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm file:mr-3 file:rounded file:border-0 file:bg-blue-50 file:px-3 file:py-2 file:text-sm file:font-medium file:text-blue-600">
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm outline-none focus:border-blue-500"></textarea>
                </div>

                <div class="flex justify-end gap-3 border-t border-gray-200 pt-4">
                    <button id="cancelModal" type="button"
                        class="rounded-lg cursor-pointer border border-gray-200 px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-lg cursor-pointer bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const state = {
                token: localStorage.getItem('api_token') || null,
                products: [],
            };

            const modal = document.getElementById('productModal');
            const productForm = document.getElementById('productForm');
            const modalTitle = document.getElementById('modalTitle');
            const productsTableBody = document.getElementById('productsTableBody');
            const statusMessage = document.getElementById('statusMessage');
            const searchInput = document.getElementById('searchInput');
            const productIdInput = document.getElementById('productId');

            function showMessage(message, type = 'success') {
                statusMessage.className = `mt-4 rounded-lg border p-3 text-sm ${type === 'error' ? 'border-red-200 bg-red-50 text-red-700' : 'border-green-200 bg-green-50 text-green-700'}`;
                statusMessage.textContent = message;
                statusMessage.classList.remove('hidden');
            }

            function hideMessage() {
                statusMessage.classList.add('hidden');
            }

            function openModal(mode = 'create', product = null) {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                productForm.reset();
                productIdInput.value = '';

                if (mode === 'edit' && product) {
                    modalTitle.textContent = 'Edit Produk';
                    productIdInput.value = product.id;
                    document.getElementById('name').value = product.name || '';
                    document.getElementById('description').value = product.description || '';
                    document.getElementById('price').value = product.price || '';
                    document.getElementById('stock').value = product.stock || '';
                } else {
                    modalTitle.textContent = 'Tambah Produk';
                }
            }

            function closeModal() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                productForm.reset();
                productIdInput.value = '';
            }

            async function ensureAuth() {
                if (state.token) {
                    return state.token;
                }

                const response = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        email: 'admin@example.com',
                        password: 'password',
                    }),
                });

                const data = await response.json().catch(() => ({}));
                if (!response.ok) {
                    throw new Error(data.error || 'Gagal masuk sebagai admin');
                }

                state.token = data.access_token;
                localStorage.setItem('api_token', state.token);
                return state.token;
            }

            async function apiRequest(url, options = {}) {
                const token = await ensureAuth();
                const headers = {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`,
                    ...(options.headers || {}),
                };

                if (!(options.body instanceof FormData)) {
                    headers['Content-Type'] = 'application/json';
                }

                const response = await fetch(url, {
                    ...options,
                    headers,
                    body: options.body instanceof FormData ? options.body : (options.body ? JSON.stringify(options.body) : undefined),
                });

                const data = await response.json().catch(() => ({}));
                if (!response.ok) {
                    throw new Error(data.message || data.error || 'Permintaan gagal');
                }

                return data;
            }

            function formatCurrency(value) {
                const number = Number(value || 0);
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
            }

            function renderProducts(products) {
                state.products = products;
                if (!products.length) {
                    productsTableBody.innerHTML = '<tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">Tidak ada produk yang ditemukan.</td></tr>';
                    return;
                }

                productsTableBody.innerHTML = products.map((product) => `
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            ${product.image_url ? `<img src="${product.image_url}" alt="${product.name}" class="h-12 w-12 rounded-lg object-cover">` : '<span class="text-gray-400">Tidak ada foto</span>'}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">${product.name}</td>
                        <td class="px-4 py-3 text-gray-700">${formatCurrency(product.price)}</td>
                        <td class="px-4 py-3 text-gray-700">${product.stock}</td>
                        <td class="px-4 py-3 text-gray-600">${product.description || '-'}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <button type="button" data-edit="${product.id}" class="rounded-lg cursor-pointer border border-gray-200 px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-50">Edit</button>
                                <button type="button" data-delete="${product.id}" class="rounded-lg cursor-pointer border border-red-200 px-3 py-1.5 text-sm text-red-600 hover:bg-red-50">Hapus</button>
                            </div>
                        </td>
                    </tr>
                `).join('');
            }

            async function loadProducts() {
                try {
                    hideMessage();
                    const searchValue = searchInput.value.trim();
                    const response = await apiRequest(`/api/products?search=${encodeURIComponent(searchValue)}`);
                    renderProducts(response.data?.data || []);
                } catch (error) {
                    showMessage(error.message, 'error');
                    productsTableBody.innerHTML = '<tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">Gagal memuat data produk.</td></tr>';
                }
            }

            productForm.addEventListener('submit', async (event) => {
                event.preventDefault();
                const formData = new FormData(productForm);
                const productId = productIdInput.value;

                try {
                    const response = await apiRequest(productId ? `/api/products/${productId}` : '/api/products', {
                        method: productId ? 'PATCH' : 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });

                    showMessage(productId ? 'Produk berhasil diperbarui.' : 'Produk berhasil ditambahkan.');
                    closeModal();
                    await loadProducts();
                } catch (error) {
                    showMessage(error.message, 'error');
                }
            });

            document.getElementById('openCreateModal').addEventListener('click', () => openModal('create'));
            document.getElementById('closeModal').addEventListener('click', closeModal);
            document.getElementById('cancelModal').addEventListener('click', closeModal);
            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal();
                }
            });

            productsTableBody.addEventListener('click', async (event) => {
                const editButton = event.target.closest('[data-edit]');
                const deleteButton = event.target.closest('[data-delete]');

                if (editButton) {
                    const product = state.products.find((item) => String(item.id) === editButton.getAttribute('data-edit'));
                    if (product) {
                        openModal('edit', product);
                    }
                    return;
                }

                if (deleteButton) {
                    const productId = deleteButton.getAttribute('data-delete');
                    const confirmed = confirm('Hapus produk ini?');
                    if (!confirmed) {
                        return;
                    }

                    try {
                        await apiRequest(`/api/products/${productId}`, {
                            method: 'DELETE',
                        });
                        showMessage('Produk berhasil dihapus.');
                        await loadProducts();
                    } catch (error) {
                        showMessage(error.message, 'error');
                    }
                }
            });

            searchInput.addEventListener('input', () => {
                loadProducts();
            });

            document.addEventListener('DOMContentLoaded', () => {
                loadProducts();
            });
        </script>
    @endpush
</x-layouts.dashboard>