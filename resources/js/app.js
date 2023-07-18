// Views
import Navbar from "./components/global/Navbar";
import Footer from "./components/global/Footer";
import Sidebar from "./components/global/Sidebar";
import Container from "./components/Container";
import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import PasswordReset from "./components/auth/PasswordReset";
import PasswordUpdate from "./components/auth/PasswordUpdate";

require("./bootstrap");

window.Vue = require("vue").default;
Vue.component('tabla-producto-component', require('./components/productos/tablaProductos.vue').default);
Vue.component('create-producto-component', require('./components/productos/create.vue').default);
Vue.component('edit-producto-component', require('./components/productos/edit.vue').default);
Vue.component('show-producto-component', require('./components/productos/show.vue').default);
const app = new Vue({
    el: "#app",
    components: {
        Container,
        Navbar,
        Sidebar,
        Footer,
        Login,
        Register,
        PasswordReset,
        PasswordUpdate,
    }
});
