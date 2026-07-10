<x-layouts.guest>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">

            <div class="hidden md:block">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                    class="w-full h-full object-cover">
            </div>

            <div class="p-8 md:p-12" x-data="registerForm()">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    Register
                </h2>
                <p class="text-gray-500 mb-6">
                    Buat akun baru
                </p>

                <template x-if="error">
                    <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
                        <span x-text="error"></span>
                    </div>
                </template>

                <form @submit.prevent="submit" class="space-y-4">

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Nama</label>
                        <input type="text" x-model="name"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                            placeholder="Nama lengkap" required>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Email</label>
                        <input type="email" x-model="email"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                            placeholder="email@example.com" required>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Password</label>
                        <input type="password" x-model="password"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                            required>
                    </div>


                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition flex justify-center items-center">
                        <span x-show="!loading">Register</span>
                        <span x-show="loading">Loading...</span>
                    </button>
                </form>

                <p class="text-sm text-gray-500 mt-4 text-center">
                    Sudah punya akun?
                    <a href="/login" class="text-blue-600 hover:underline">Login</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function registerForm() {
            return {
                name: '',
                email: '',
                password: '',
                loading: false,
                error: null,

                async submit() {
                    this.loading = true
                    this.error = null

                    try {
                        const res = await fetch('http://127.0.0.1:8000/api/auth/register', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                name: this.name,
                                email: this.email,
                                password: this.password,
                            })
                        })

                        const data = await res.json()

                        if (!res.ok) {
                            throw new Error(data.message || 'Register gagal')
                        }

                        if (data.access_token) {
                            localStorage.setItem('token', data.access_token)
                            localStorage.setItem('user', JSON.stringify(data.user))
                            window.location.href = '/'
                        } else {
                            window.location.href = '/login'
                        }

                    } catch (e) {
                        this.error = e.message
                    } finally {
                        this.loading = false
                    }
                }
            }
        }
    </script>

</x-layouts.guest>