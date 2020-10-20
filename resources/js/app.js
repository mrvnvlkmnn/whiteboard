/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import 'alpinejs';
require('./bootstrap');



$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap4',
    });
});
