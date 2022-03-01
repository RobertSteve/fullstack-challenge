<template>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img 
                    class="mx-auto h-24 w-auto" 
                    src="https://scontent.flim13-1.fna.fbcdn.net/v/t1.6435-1/197426563_805036880386154_3547908156571545669_n.jpg?stp=dst-jpg_s200x200&_nc_cat=1&ccb=1-5&_nc_sid=1eb0c7&_nc_eui2=AeFwP3Ryp_UlFYbVziU-1Dpuhwl4MYEd7eaHCXgxgR3t5jM7CXuJ61Quc6VVEN65ayU&_nc_ohc=fnTGyI6GJCAAX-macwS&_nc_ht=scontent.flim13-1.fna&oh=00_AT98_zl2SdHXdGVKflAqasBegkEEJp0EEZ3JXWxbQdm7gg&oe=623DF655" 
                    alt="">
                <h2 class="mt-6 text-center txt-3xl font-extrabold text-gray-900">Inicia sesión</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    O
                    <router-link
                        class="font-medium text-indigo-600 hover:text-indigo-500"
                        to="/register">
                        registrate
                    </router-link>
                </p>
            </div>
            <form 
                @submit="login"
                methods="post"
                class="mt-8 space-y-6">
                <div>
                    <label 
                        :class="[errors ? 'text-red-700' : '']"
                        class="block mb-2 text-sm font-medium text-gray-900">Correo Electrónico</label>
                    <div class="relative">
                        <div 
                            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                        </div>
                        <input 
                            v-model="email" 
                            type="text" 
                            :class="[errors ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 ' : '']"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" 
                            placeholder="Ingrese su correo electrónico"
                            required>
                    </div>
                </div>
                <div>
                    <label 
                        :class="[errors ? 'text-red-700' : '']"
                        class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input 
                            v-model="password" 
                            type="password" 
                            :class="[errors ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 ' : '']"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" 
                            placeholder="Ingrese su contraseña"
                            required>
                    </div>
                </div>
                <p 
                    v-if="errors" 
                    class="mt-2 text-sm text-red-600">
                    <span class="font-medium">Oops!</span> {{errors}}
                </p>
                <div>
                    <button 
                        :disabled="disabledLogin"
                        type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg 
                                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" 
                                xmlns="http://www.w3.org/2000/svg" 
                                viewBox="0 0 20 20" 
                                fill="currentColor" 
                                aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Inicia Sesión
                    </button>
                </div>
            </form>
        </div> 
    </div>
</template>
<script>
    export default {
        name: 'Login',
        data() {
            return {
                email: null,
                password: null,
                errors: null,
                disabledLogin: false
            }
        },
        methods: {
            login(event) {
                event.preventDefault();
                this.disabledLogin = true;
                let data = {
                    email: this.email,
                    password: this.password,
                    device: 'w'
                };
                axios.post("/api/login", data).then((result) => {
                    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + result.data.data.token;
                    localStorage.setItem("token", result.data.data.token);  
                    this.$store.commit('SET_TOKEN', result.data.data.token);
                    this.$router.push('dashboard');
                }).catch((error) => {
                    this.errors = error.response.data.errors.message[0];
                    this.disabledLogin = false;
                });
            }
        },
        created() {
            let token = localStorage.getItem("token");
            if (token) {
                this.$router.push('/dashboard');
            }
        }
    }
</script>