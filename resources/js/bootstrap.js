import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


// Uncomment below to use Laravel Echo with Pusher (Optional)
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Enable Pusher logging for development (Optional)

window.Pusher = Pusher;

// Get the token from a meta tag or directly from the server

const token = localStorage.getItem('token');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    authEndpoint: "/broadcasting/auth",
    bearerToken: `${token}`,
    auth: {
        headers: {
            Authorization: `Bearer ${token}`, // Include the Bearer token
        },
    },
});
