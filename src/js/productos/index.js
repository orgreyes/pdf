
import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast } from "../funciones";

// !mandamos a llamar todos los botones, formulario y del archivo de vistas
const formulario = document.querySelector('form');
const btnBuscar = document.getElementById('btnBuscar');
const tablaProducto = document.getElementById('tablaProducto');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('divTabla');

//!Esto es para ocultar el bootn de modificar, cancelar y la tabla
btnModificar.disabled = true
btnModificar.parentElement.style.display = 'none'
btnCancelar.disabled = true
btnCancelar.parentElement.style.display = 'none'



const guardar = async (evento) => {
    evento.preventDefault();

    if (!validarFormulario(formulario,['producto_id'])){
        Swal.fire({
            title: 'Campos incompletos',
            text: 'Debe llenar todos los campos del formulario',
            icon: 'warning',
            showCancelButton: false,
            confirmCancelButtonColor: '#d33',
            confirmButtonText: 'OK',
        });

        return;
    }

    const body = new FormData(formulario)
    body.delete('producto_id')
    const url ='/pdf/API/productos/guardar';
    const config = {
        method : 'POST',
        body
    }

    try {
        const respuesta = await fetch(url,config);
        const data = await respuesta.json();

         console.log(data);

        const {codigo, mensaje, detalle} = data;
        
        switch (codigo) {
            case 1:
                formulario.reset();
                buscar();
                break;

            case 0:
                console.log(detalle);
                break;

            default:
                break;
        }

        Swal.fire({
            title:'Guardando Exitoso',
            text: 'Los datos se han guardado correctamente',
            icon: 'success',
            showCancelButton: false,
            confirmCancelButtonColor: '#3085d6',
            confirmButtonText: 'OK',
        });

    } catch (error) {
        console.log(error);
    }

};



const eliminar = async (id) => {
    const result = await Swal.fire({
        icon: 'question',
        title: 'Eliminar producto',
        text: '¿Desea eliminar este producto?',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (result.isConfirmed) {
        const body = new FormData();
        body.append('producto_id', id);

        const url = `/pdf/API/productos/eliminar`;
        const config = {
            method: 'POST',
            body,
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log(data);
            const { codigo, mensaje, detalle } = data;

            let icon='info'
            switch (codigo) {
                case 1:
                    buscar();
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado Exitosamente',
                        text: mensaje,
                        confirmButtonText: 'OK'
                    });
                    break;
                case 0:
                    console.log(detalle);
                    break;
                default:
                    break;
            }

        } catch (error) {
            console.log(error);
        }
    }
};



//!Aca esta la funcion de Buscar.
const buscar = async () => {
    let producto_nombre = formulario.producto_nombre.value;
    const url =`/pdf/API/productos/buscar?producto_nombre=${producto_nombre}`;
    const config = {
        method : 'GET',
    }

    try{
        const respuesta = await fetch(url,config)
        const data = await respuesta.json();

        console.log(console.log(tablaProducto.tBodies[0].innerHTML = ''));
        console.log(data);
        

        //!Para crear tablas de forma automatica.
        const fragment=document.createDocumentFragment();

        if(data.length > 0){
            let contador = 1;
            data.forEach(producto => {

                //!Aca se crean los elementos
                const tr = document.createElement('tr');
                const td1 = document.createElement('td');
                const td2 = document.createElement('td');
                const td3 = document.createElement('td');
                const td4 = document.createElement('td');
                const td5 = document.createElement('td');
                const buttonModificar = document.createElement('button');
                const buttonEliminar = document.createElement('button');

                //!Aca se agrega estilos usando Boostrap
                buttonModificar.classList.add('btn', 'btn-warning');
                buttonEliminar.classList.add('btn', 'btn-danger');
                buttonModificar.textContent = 'Modificar';
                buttonEliminar.textContent = 'Eliminar';

                //!Aca se agrega interactividad a los botnes de modificar y eliminar.
                buttonModificar.addEventListener('click', () =>  colocarDatos(producto))
                buttonEliminar.addEventListener('click', () => eliminar(producto.producto_id))
                
                td1.innerText = contador;
                td2.innerText = producto.producto_nombre
                td3.innerText = producto.producto_precio

                //!DOM
                td4.appendChild(buttonModificar);
                td5.appendChild(buttonEliminar);
                tr.appendChild(td1)
                tr.appendChild(td2)
                tr.appendChild(td3)
                tr.appendChild(td4)
                tr.appendChild(td5)

                fragment.appendChild(tr);
                contador++;

            })
        }else{
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.innerText = 'No existe Registros';
            td.colSpan = 5
            tr.appendChild(td)
            fragment.appendChild(tr);

        };

        tablaProducto.tBodies[0].appendChild(fragment)

    }catch (error){
        console.log(error)
    }
};


formulario.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
