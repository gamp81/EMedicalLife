<template>
    <main class="main">
       
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card mt-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2><i class="fa fa-align-justify"></i> Categorías</h2>
                    <div class="btn-toolbar mb-2 mb-md-0"><div class="btn-group mr-2">
                        <button class="btn btn-success" @click="abrirModal('categoria', 'registrar')"><i class="el-icon-circle-plus"></i>Nuevo</button>
                    </div></div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12 col-12">
                            <div class="input-group">
                                
                                <div class="mr-1 ">
                                     <select id="bloque" class="form-control" v-model="criterio">
                                    <option v-for="item in options" :key="item.id" :value="item.value" >{{item.label }}</option>
                                    </select>
                                    
                                </div>                                                    
                                <div class="mr-1  ">
                                    <input class="form-control" placeholder="Texto a buscar" v-model="buscar">
                                </div>
                                <div>
                                    <button class="btn btn-primary"  @click="listarCategoria(1, buscar, criterio)">Buscar</button>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                <td>
                                    <a href="#" @click="abrirModal('categoria','actualizar',categoria)" class="btn btn-warning btn-sm" role="button" aria-disabled="true" title="editar">
                                        <i class="fas fa-edit"></i></a>
                                    <template v-if="categoria.condicion">
                                        <button type="button" @click="desactivarCategoria(categoria.id)" class="btn btn-danger btn-sm" title="editar">
                                            <i class='fa-solid fa-trash-can'></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" @click="activarCategoria(categoria.id)" class="btn btn-info btn-sm">
                                          <i class='fa fa-check'></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="categoria.nombre"></td>
                                <td v-text="categoria.descripcion"></td>
                                <td>
                                    <div v-if="categoria.condicion">
                                        <span class="badge badge-success"
                                            >Activo</span
                                        >
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-danger"
                                            >Desactivado</span
                                        >
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li
                                class="page-item"
                                v-if="pagination.current_page > 1"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click.prevent="
                                        cambiarPagina(
                                            pagination.current_page - 1,
                                            buscar,
                                            criterio
                                        )
                                    "
                                    >Ant</a
                                >
                            </li>
                            <li
                                class="page-item"
                                v-for="page in pagesNumber"
                                :key="page"
                                :class="[page == isActived ? 'active' : '']"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click.prevent="
                                        cambiarPagina(page, buscar, criterio)
                                    "
                                    v-text="page"
                                ></a>
                            </li>

                            <li
                                class="page-item"
                                v-if="
                                    pagination.current_page <
                                        pagination.last_page
                                "
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click.prevent="
                                        cambiarPagina(
                                            pagination.current_page + 1,
                                            buscar,
                                            criterio
                                        )
                                    "
                                    >Sig</a
                                >
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div
            class="modal fade"
            tabindex="-1"
            :class="{ mostrar: modal }"
            role="dialog"
            aria-labelledby="myModalLabel"
            style="display: none;"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-primary modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button
                            type="button"
                            class="close"
                            @click="cerrarModal()"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form
                            action
                            method="post"
                            enctype="multipart/form-data"
                            class="form-horizontal"
                        >
                            <div class="form-group row">
                                <label class="col-md-3 text-center form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" v-model="nombre"  placeholder="Nombre categoria" required>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-center form-control-label" for="email-input">Descripción</label>
                                <div class="col-md-9">
                                     <input type="text" class="form-control" v-model="descripcion"  placeholder="Ingrese descripción" required>
                                </div>
                            </div>
                            <div
                                v-show="errorCategoria"
                                class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div
                                        v-for="error in errorMostrarMsjCategoria"
                                        :key="error"
                                        v-text="error"
                                    ></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click="cerrarModal()"
                        >
                            Cerrar
                        </button>
                        <button
                            type="button"
                            v-if="tipoAccion == 1"
                            class="btn btn-primary"
                            @click="registrarCategoria()"
                        >
                            Guardar
                        </button>
                        <button
                            type="button"
                            v-if="tipoAccion == 2"
                            class="btn btn-primary"
                            @click="actualizarCategoria()"
                        >
                            Actualizar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </main>
</template>

<script>
import swal from 'sweetalert';
export default {
    data() {
        return {
            input: '',
            //para select
            options: [{
          value: 'Nombre',
          label: 'Nombre'
        }, {
          value: 'Descripcion',
          label: 'Descripcion'
        }],
        value: '',
            //fin select
            categoria_id: 0,
            nombre: "",
            descripcion: "",
            arrayCategoria: [],
            modal: 0,
            tituloModal: "",
            tipoAccion: 0,
            errorCategoria: 0,
            errorMostrarMsjCategoria: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            criterio: "Nombre",
            buscar: ""
        };
    },
    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        guardar() {
        this.$message({
          message: 'Categoria Guardado con éxito.',
          type: 'success'
        })
        },
        editar() {
        this.$message({
          message: 'Categoria Actualizado con éxito.',
          type: 'success'
        })
        },
        listarCategoria(page, buscar, criterio) {
            let me = this;
            var url =
                "/categoria/lista?page=" +
                page +
                "&buscar=" +
                buscar +
                "&criterio=" +
                criterio;
            axios
                .get(url)
                .then(function(response) {
                    var respuesta = response.data;
                    me.arrayCategoria = respuesta.categorias.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        cambiarPagina(page, buscar, criterio) {
            let me = this;
            me.pagination.current_page = page;
            me.listarCategoria(page, buscar, criterio);
        },
        registrarCategoria() {
            //validando campos categoria
            if (this.validarCategoria()) {
                return;
            }

            let me = this;

            axios
                .post("/categoria/registrar", {
                    nombre: this.nombre,
                    descripcion: this.descripcion
                })
                .then(function(response) {
                    me.cerrarModal();
                    me.listarCategoria(1, "", "nombre");
                    me.guardar();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        actualizarCategoria() {
            //validando campos categoria
            if (this.validarCategoria()) {
                return;
            }

            let me = this;
            axios
                .put("/categoria/actualizar", {
                    nombre: this.nombre,
                    descripcion: this.descripcion,
                    id: this.categoria_id
                })
                .then(function(response) {
                    me.cerrarModal();
                    me.listarCategoria(1, "", "nombre");
                    me.editar();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        desactivarCategoria(id) {
            swal({
                title: "Estas seguro de desactivar esta categoria?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    let me = this;
                    axios
                        .put("/categoria/desactivar", {
                            id: id
                        })
                        .then(function(response) {
                            me.listarCategoria(1, "", "nombre");
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                    swal("La categoria NO sigue activa!!", {
                    icon: "success",
                    });
                } else {
                    swal("La categoria sigue activa!");
                }
                });
            
        },
        activarCategoria(id) {
            swal({
                title: "Estas seguro de activar esta categoria?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                
            }).then((willDelete) => {
                if (willDelete) {
                    let me = this;
                    axios
                        .put("/categoria/activar", {
                            id: id
                        })
                        .then(function(response) {
                            me.listarCategoria(1, "", "nombre");
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                    swal("La categoria esta activa ahora!!", {
                    icon: "success",
                    });
                } else {
                    swal("La categoria sigue activa!");
                }
                });
            // .then(result => {
            //     if (result.value) {
            //         let me = this;
            //         axios
            //             .put("/categoria/activar", {
            //                 id: id
            //             })
            //             .then(function(response) {
            //                 swal(
            //                     "Activado!",
            //                     "El registro ha sido desactivado con éxito.",
            //                     "success"
            //                 );
            //                 me.listarCategoria(1, "", "nombre");
            //             })
            //             .catch(function(error) {
            //                 console.log(error);
            //             });
            //     }
            // });
        },
        validarCategoria() {
            this.errorCategoria = 0;
            this.errorMostrarMsjCategoria = [];

            if (!this.nombre)
                this.errorMostrarMsjCategoria.push(
                    "El nombre de la categoría no puede estar vacío."
                );

            if (this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

            return this.errorCategoria;
        },
        cerrarModal() {
            this.modal = 0;
            this.tituloModal = "";
            this.nombre = "";
            this.descripcion = "";
        },
        abrirModal(modelo, accion, data = []) {
            switch (modelo) {
                case "categoria": {
                    switch (accion) {
                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Registrar Categoría";
                            this.nombre = "";
                            this.descripcion = "";
                            this.tipoAccion = 1;
                            break;
                        }
                        case "actualizar": {
                            this.modal = 1;
                            this.tituloModal = "Actualizar categoria";
                            this.tipoAccion = 2;
                            this.categoria_id = data["id"];
                            this.nombre = data["nombre"];
                            this.descripcion = data["descripcion"];

                            break;
                        }
                    }
                }
            }
        }
    },
    mounted() {
        this.listarCategoria(1, this.buscar, this.criterio);
    }
};
</script>
<style>
.modal-content {
    width: 100% !important;
    border-radius: 6px;
    margin-top: 30px;
    position: absolute !important;
}
.mostrar {
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #3c29297a !important;
}
.div-error {
    display: flex;
    justify-content: center;
}
.text-error {
    color: red !important;
    font-weight: bold;
}
</style>
