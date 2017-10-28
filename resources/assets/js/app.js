/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vue.prototype.authorize = function(handler) {
        return handler(window.App.user);
    }
    /**
     * Next, we will create a fresh Vue application instance and attach it to
     * the page. Then, you may begin adding components to this application
     * or customize the JavaScript scaffolding to fit your unique needs.
     */

Vue.component('example', require('./components/Example.vue'));
Vue.component('replies', require('./components/Replies.vue'));
Vue.component('posts', require('./components/Posts.vue'));
Vue.component('post', require('./components/Post.vue'));
Vue.component('post-create', require('./components/PostCreate.vue'));
Vue.component('new-message', require('./components/NewMessage.vue'));
Vue.component('profile-info', require('./components/ProfileInfo.vue'));
Vue.component('flash', require('./components/Flash.vue'));
Vue.component('follow', require('./components/Follow.vue'));
Vue.component('username-link', require('./components/UsernameLink.vue'));
Vue.component('user-info-popup', require('./components/UserInfoPopup.vue'));






Vue.prototype.$eventHub = new Vue(); // Global event bus
new Vue({
    el: '#app',
});

window.flash = function(message, type) {
    Vue.prototype.$eventHub.$emit('flash', message, type);
}

$('.test').on('click', function(e) {
    console.log(e.target.classList[0]);
    if (e.target.classList[0] == "modal-prevent") {
        e.stopPropagation();
    }
});


$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});