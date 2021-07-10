<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <h4>Usuarios</h4> 
                    <table class="table" id="tbl_users">
                        <thead>
                            <tr class="text-center">
                                <th>NOMBRE</th>
                                <th>DOCUMENTO</th>
                                <th>GENERO</th>
                                <th>EDAD</th>
                                <th>TELÉFONO</th>
                                <th>EPS</th>
                                <th>ROL</th>
                                <th>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-plus"></li> Crear usuario</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)                                
                                <tr style="background-color: {{$user->color}};">
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->documento}}</td>
                                    <td>{{$user->genero}}</td>
                                    <td>{{$user->edad}}</td>
                                    <td>{{$user->telefono}}</td>
                                    <td>{{$user->eps}}</td>
                                    <td>{{$user->rol}}</td>
                                    <td>
                                        <button class="btn btn-warning" onclick="Editar('{{$user->id}}');">Editar</button>
                                        <button class="btn btn-danger ml-1" onclick="Eliminar('{{$user->id}}');">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Modal crear registro-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frm_crear">
                        @CSRF
                        <div>
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="name" required autocomplete="off">
                        </div>
                        <div>
                            <label>Documento:</label>
                            <input type="text" class="form-control" name="documento" required autocomplete="off">
                        </div>
                        <div>
                            <label>Genero:</label>
                            <select class="form-control" name="genero" required="">
                                <option selected="" disabled>Seleccione...</option>
                                <option>Femenino</option>
                                <option>Masculino</option>
                            </select>
                        </div>
                        <div>
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" required autocomplete="off">
                        </div>
                        <div>
                            <label>Telefono:</label>
                            <input type="number" class="form-control" name="telefono" required autocomplete="off">
                        </div>
                        <div>
                            <label>Fecha de nacimiento:</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" required autocomplete="off">
                        </div>
                        <div>
                            <label>EPS:</label>
                            <select class="form-control" name="eps_id" required="">
                                <option selected="" disabled>Seleccione...</option>
                                @foreach($eps as $val_eps)
                                    <option value="{{$val_eps->id}}">{{$val_eps->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>ROL:</label>
                            <select class="form-control" name="rol_id" required="">
                                <option selected="" disabled>Seleccione...</option>
                                @foreach($roles as $rol)
                                    <option value="{{$rol->id}}">{{$rol->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>Password:</label>
                            <input type="password" class="form-control" name="password" required autocomplete="off">
                        </div>
                        <div>
                            <label>Password confirmación:</label>
                            <input type="password" class="form-control" name="password_c" required autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="frm_crear" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!--Modal editar registro-->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        @CSRF
                        <div>
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="name" id="name_edi" required autocomplete="off">
                            <input type="text" class="form-control" hidden name="id_usuario_edi" id="id_usuario_edi" required autocomplete="off">
                        </div>
                        <div>
                            <label>Documento:</label>
                            <input type="text" class="form-control" name="documento" id="documento_edi" required autocomplete="off">
                        </div>
                        <div>
                            <label>Genero:</label>
                            <select class="form-control" name="genero" id="genero_edi" required="">
                                <option selected="" disabled>Seleccione...</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Masculino">Masculino</option>
                            </select>
                        </div>
                        <div>
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" id="email_edi" required autocomplete="off">
                        </div>
                        <div>
                            <label>Telefono:</label>
                            <input type="number" class="form-control" name="telefono" id="telefono_edi" required autocomplete="off">
                        </div>
                        <div>
                            <label>Fecha de nacimiento:</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento_edi" required autocomplete="off">
                        </div>
                        <div>
                            <label>EPS:</label>
                            <select class="form-control" name="eps_id" id="eps_id_edi" required="">
                                <option selected="" disabled>Seleccione...</option>
                                @foreach($eps as $val_eps)
                                    <option value="{{$val_eps->id}}">{{$val_eps->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>ROL:</label>
                            <select class="form-control" name="rol_id" id="rol_id_edi" required="">
                                <option selected="" disabled>Seleccione...</option>
                                @foreach($roles as $rol)
                                    <option value="{{$rol->id}}">{{$rol->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="frm_editar" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal eliminar registro-->
    <div class="modal fade" id="eliminarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Esta seguro que desea eliminar este usuario?
                    <form id="frm_eliminar">
                        @CSRF
                        <div>
                            <input type="text" class="form-control" hidden name="id_usuario_del" id="id_usuario_del" required autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="frm_eliminar" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    function Editar(id_usuario){
        $('#id_usuario_edi').val(id_usuario);
        parametros = {
            "_token": "{{ csrf_token() }}",
            "id_usuario" : $('#id_usuario_edi').val(),
        };
        $.ajax({
            url: "getUsuario",
            data: parametros,
            type: "POST",
            success(data){
                $('#name_edi').val(data[0].name);
                $('#documento_edi').val(data[0].documento);
                $('#email_edi').val(data[0].email);
                $('#telefono_edi').val(data[0].telefono);
                $('#fecha_nacimiento_edi').val(data[0].fecha_nacimiento);

                $("#genero_edi option[value="+ data[0].genero +"]").attr("selected",true);
                $("#eps_id_edi option[value="+ data[0].id_eps +"]").attr("selected",true);
                $("#rol_id_edi option[value="+ data[0].id_rol +"]").attr("selected",true);
            },
            error(){
                alertify.danger('No fue posible actualizar la información');
            }
        });
        $('#editarModal').modal('show');
        actualiza();
    }
    function Eliminar(id_usuario){
        $('#id_usuario_del').val(id_usuario);
        $('#eliminarModal').modal('show');
    }
    $("#frm_crear").submit(function(event){
        var formData = new FormData(this);
        event.preventDefault();
        $.ajax({
            url: "addUser",
            type: "POST",
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,
            success(data){
                if (data == 1){
                    alertify.success('Se creo el registro satisfactoriamente.');
                    $('#exampleModal').modal('hide');
                    actualiza();
                }else{
                    alertify.warning(data);
                }
            },
            error(){
            }
        });
    });
    $("#frm_editar").submit(function(event){
        var formData = new FormData(this);
        event.preventDefault();
        $.ajax({
            url: "ediUser",
            type: "POST",
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,
            success(data){
                if (data == 1){
                    alertify.success('Se edito el registro satisfactoriamente.');
                    actualiza();
                    $('#editarModal').modal('hide');
                }else{
                    alertify.warning(data);
                }
            },
            error(){

            }
        });
    });
    $("#frm_eliminar").submit(function(event){
        var formData = new FormData(this);
        event.preventDefault();
        $.ajax({
            url: "delUser",
            type: "POST",
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,
            success(data){
                if (data == 1){
                    alertify.success('Se elimino el registro satisfactoriamente.');
                    actualiza();
                    $('#eliminarModal').modal('hide');
                }else{
                    alertify.warning(data);
                }
            },
            error(){

            }
        });
    });
    function actualiza(){
        $.ajax({
            url: "actualiza",
            type: "GET",
            success(data){
                console.log(data);
                $('#tbl_users tbody').empty(); 
                recuento = '';
                for (var i = 0;i< data.length;i++) {
                    recuento += '<tr style="background-color: '+data[i].color+';">'+
                                    '<td>'+data[i].name+'</td>'+
                                    '<td>'+data[i].documento+'</td>'+
                                    '<td>'+data[i].genero+'</td>'+
                                    '<td>'+data[i].edad+'</td>'+
                                    '<td>'+data[i].telefono+'</td>'+
                                    '<td>'+data[i].eps+'</td>'+
                                    '<td>'+data[i].rol+'</td>'+
                                    '<td>'+
                                        '<button class="btn btn-warning" onclick="Editar('+data[i].id+');">Editar</button>'+
                                        '<button class="btn btn-danger ml-1" onclick="Eliminar('+data[i].id+');">Eliminar</button>'+
                                    '</td>'+
                                '</tr>';
                }
                $('#tbl_users tbody').append(recuento); 
            },
            error(){
                alertify.warning('No fue posible actualizar la información');
            }
        });
    }
</script>
