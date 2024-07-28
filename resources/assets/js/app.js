require('./bootstrap');

import Echo from 'laravel-echo';
import 'toastr/toastr.scss';
import toastr from 'toastr';

window.toastr = require('toastr');
toastr.options = {
    "positionClass": "toast-bottom-right"
};
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: pusherKey,
    cluster: pusherCluster,
    encrypted: true,
    auth: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    },
});
